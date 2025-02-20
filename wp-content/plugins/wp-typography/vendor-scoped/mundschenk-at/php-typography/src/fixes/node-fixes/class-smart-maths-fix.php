<?php

/**
 *  This file is part of PHP-Typography.
 *
 *  Copyright 2017-2019 Peter Putzer.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License along
 *  with this program; if not, write to the Free Software Foundation, Inc.,
 *  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 *  ***
 *
 *  @package mundschenk-at/php-typography
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace PHP_Typography\Fixes\Node_Fixes;

use PHP_Typography\DOM;
use PHP_Typography\Settings;
use PHP_Typography\U;
/**
 * Applies smart math (if enabled).
 *
 * @author Peter Putzer <github@mundschenk.at>
 *
 * @since 5.0.0
 */
class Smart_Maths_Fix extends \PHP_Typography\Fixes\Node_Fixes\Abstract_Node_Fix
{
    // Lookbehind assertion: preceded by beginning of string or space.
    const INITIAL_LOOKBEHIND = '(?<=\\s|\\A)';
    // Needs u modifier.
    // Lookahead assertion: followed by end of string, space, or certain allowed punctuation marks.
    const FINAL_LOOKAHEAD = '(?=\\s|\\Z|\\)|\\]|\\.|\\,|\\?|\\;|\\:|\'|\\"|\\!)';
    // Needs u modifier.
    // Common date components.
    const DAY_2_DIGITS = '(?:0[1-9]|[12][0-9]|3[01])';
    const DAY_1_OR_2_DIGITS = '(?:0?[1-9]|[12][0-9]|3[01])';
    const MONTH_2_DIGITS = '(?:0[1-9]|1[0-2])';
    const MONTH_1_OR_2_DIGITS = '(?:0?[1-9]|1[0-2])';
    const YEAR_2_DIGITS = '[0-9]{2}';
    const YEAR_4_DIGITS = '[12][0-9]{3}';
    const YEAR_2_OR_4_DIGITS = '(?:' . self::YEAR_2_DIGITS . '|' . self::YEAR_4_DIGITS . ')';
    // Maths components.
    const DECIMAL_SEPARATOR = '[\\.,]';
    const DECIMAL_NUMBER = '[0-9]+(?:' . self::DECIMAL_SEPARATOR . '[0-9]+)?';
    // First, let's find math equations.
    const MATH_EQUATION = '/
		' . self::INITIAL_LOOKBEHIND . '
		[\\.,\'\\"\\¿\\¡' . \PHP_Typography\U::ELLIPSIS . \PHP_Typography\U::SINGLE_QUOTE_OPEN . \PHP_Typography\U::DOUBLE_QUOTE_OPEN . \PHP_Typography\U::GUILLEMET_OPEN . \PHP_Typography\U::GUILLEMET_CLOSE . \PHP_Typography\U::SINGLE_LOW_9_QUOTE . \PHP_Typography\U::DOUBLE_LOW_9_QUOTE . ']*
														# allowed preceding punctuation
		[\\-\\(' . \PHP_Typography\U::MINUS . ']*                         # optionally preceded by dash, minus sign or open parenthesis
		' . self::DECIMAL_NUMBER . '                    # must begin with a number, optional decimal values after first integer
		(                                               # followed by a math symbol and a number
			[\\/\\*x\\-+=\\^' . \PHP_Typography\U::MINUS . \PHP_Typography\U::MULTIPLICATION . \PHP_Typography\U::DIVISION . ']
														# allowed math symbols
			[\\-\\(' . \PHP_Typography\U::MINUS . ']*                     # optionally preceded by dash, minus sign or open parenthesis
			' . self::DECIMAL_NUMBER . '                # must begin with a number, optional decimal values after first integer
			[\\-\\(\\)' . \PHP_Typography\U::MINUS . ']*                   # optionally followed by dash, minus sign or parenthesis
		)+
		[\\.,;:\'\\"\\?\\!' . \PHP_Typography\U::ELLIPSIS . \PHP_Typography\U::SINGLE_QUOTE_CLOSE . \PHP_Typography\U::DOUBLE_QUOTE_CLOSE . \PHP_Typography\U::GUILLEMET_OPEN . \PHP_Typography\U::GUILLEMET_CLOSE . ']*
														# allowed trailing punctuation
		(?=\\Z|\\s)                                       # lookahead assertion: followed by end of string or space
	/Sxu';
    // Revert 4-4 to plain minus-hyphen so as to not mess with ranges of numbers (i.e. pp. 46-50).
    const REVERT_RANGE = '/
		' . self::INITIAL_LOOKBEHIND . '

		(\\d+)' . \PHP_Typography\U::MINUS . '(\\d+)

		' . self::FINAL_LOOKAHEAD . '                   # lookahead assertion: most punctuation marks are allowd
		(?!' . self::DECIMAL_SEPARATOR . '[0-9]+)                                    # negative lookahead assertion: but not decimal numbers
	/Sxu';
    // Revert fractions to basic slash.
    const REVERT_FRACTION = "/\n\t\t(?<=\\s|\\A|\\'|\"|" . \PHP_Typography\U::NO_BREAK_SPACE . ')
		(
			\\d+
		)
		' . \PHP_Typography\U::DIVISION . '
		(
			\\d+
			(?:st|nd|rd|th)?
		)
		' . self::FINAL_LOOKAHEAD . '
	/Sxu';
    // MM-DD-YYYY, or DD-MM-YYYY, or YYYY-MM-DD.
    const REVERT_DASHED_DATE = '/
		' . self::INITIAL_LOOKBEHIND . '
		(?|
			# DD-MM-YYYY and MM-DD-YYYY
			(?|
				(' . self::MONTH_1_OR_2_DIGITS . ')' . \PHP_Typography\U::MINUS . '(' . self::DAY_1_OR_2_DIGITS . ')
			|
				(' . self::DAY_1_OR_2_DIGITS . ')' . \PHP_Typography\U::MINUS . '(' . self::MONTH_1_OR_2_DIGITS . ')
			)
			' . \PHP_Typography\U::MINUS . '(' . self::YEAR_4_DIGITS . ')
		|
			# YYYY-MM-DD
			(' . self::YEAR_4_DIGITS . ')' . \PHP_Typography\U::MINUS . '(' . self::MONTH_1_OR_2_DIGITS . ')' . \PHP_Typography\U::MINUS . '(' . self::DAY_1_OR_2_DIGITS . ')
		)
		' . self::FINAL_LOOKAHEAD . '
	/Sxu';
    // YYYY-MM or YYYY-DDD next.
    const REVERT_DATE_YYYY_MM = '/
		' . self::INITIAL_LOOKBEHIND . '
		(
			' . self::YEAR_4_DIGITS . '
		)
		' . \PHP_Typography\U::MINUS . '
		(
			' . self::MONTH_2_DIGITS . '
			|
			# Day from 001-366.
			(?:0[0-9][1-9]|[12][0-9]{2}|3[0-5][0-9]|36[0-6])
		)
		' . self::FINAL_LOOKAHEAD . '
	/Sxu';
    // 2-digit slashed day and month in any order (DD/MM or MM/DD).
    // Both DD and MM are captured.
    const SLASHED_DAY_MONTH = '
		(?|
			(' . self::MONTH_1_OR_2_DIGITS . ')' . \PHP_Typography\U::DIVISION . '(' . self::DAY_1_OR_2_DIGITS . ')
		|
			(' . self::DAY_1_OR_2_DIGITS . ')' . \PHP_Typography\U::DIVISION . '(' . self::MONTH_1_OR_2_DIGITS . ')
		)';
    // Needs xu modifiers.
    // MM/DD/YY, or DD/MM/YY, or YY/MM/DD, or YY/DD/MM, or
    // MM/DD/YYYY, or DD/MM/YYYY, or YYYY/MM/DD, or YYYY/DD/MM.
    const REVERT_SLASHED_DATE = '/
		' . self::INITIAL_LOOKBEHIND . '

		(?|
			(?:' . self::SLASHED_DAY_MONTH . ')' . \PHP_Typography\U::DIVISION . '(' . self::YEAR_2_OR_4_DIGITS . ' )
		|
			(' . self::YEAR_2_OR_4_DIGITS . ')' . \PHP_Typography\U::DIVISION . '(?:' . self::SLASHED_DAY_MONTH . ' )
		)

		' . self::FINAL_LOOKAHEAD . '
	/Sxu';
    const REVERT_MATCHES = [
        // Revert 4-4 to plain minus-hyphen so as to not mess with ranges of numbers (i.e. pp. 46-50).
        self::REVERT_RANGE,
        // Revert fractions to basic slash.
        // We'll leave styling fractions to smart_fractions.
        self::REVERT_FRACTION,
        // Revert date back to original formats.
        // MM-DD-YYYY, DD-MM-YYYY, YYYY-MM-DD.
        self::REVERT_DASHED_DATE,
        // YYYY-MM or YYYY-DDD next.
        self::REVERT_DATE_YYYY_MM,
        // DD/MM/YY, DD/MM/YYYY, MM/DD/YY, MM/DD/YYYY,
        // YY/MM/DD, YYYY/MM/DD, YY/DD/MM, YYYY/DD/MM.
        self::REVERT_SLASHED_DATE,
    ];
    const REVERT_REPLACEMENTS = ['$1-$2', '$1/$2', '$1-$2-$3', '$1-$2', '$1/$2/$3'];
    /**
     * Apply the fix to a given textnode.
     *
     * @param \DOMText $textnode Required.
     * @param Settings $settings Required.
     * @param bool     $is_title Optional. Default false.
     */
    public function apply(\DOMText $textnode, \PHP_Typography\Settings $settings, $is_title = \false)
    {
        if (empty($settings[\PHP_Typography\Settings::SMART_MATH])) {
            return;
        }
        // Cache textnode content.
        $node_data = $textnode->data;
        // First, let's find math equations.
        $node_data = \preg_replace_callback(self::MATH_EQUATION, function (array $matches) {
            return \str_replace(['-', '/', 'x', '*'], [
                \PHP_Typography\U::MINUS,
                // @codeCoverageIgnoreStart
                \PHP_Typography\U::DIVISION,
                \PHP_Typography\U::MULTIPLICATION,
                \PHP_Typography\U::MULTIPLICATION,
            ], $matches[0]);
        }, $node_data);
        // Revert some non-desired changes and restore textnode content.
        $textnode->data = \preg_replace(self::REVERT_MATCHES, self::REVERT_REPLACEMENTS, $node_data);
    }
}
