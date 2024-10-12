<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

use Composer\AutoloadWPTypography\ClassLoader as ClassLoaderWPTypography;


class ComposerStaticInitWPTypography
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WP_Typography\\Vendor\\Masterminds\\' => 33,
            'WP_Typography\\Vendor\\Dice\\' => 26,
        ),
        'D' => 
        array (
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WP_Typography\\Vendor\\Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'WP_Typography\\Vendor\\Dice\\' => 
        array (
            0 => __DIR__ . '/..' . '/level-2/dice',
        ),
    );

    public static $classMap = array (
        'Mundschenk_WP_Requirements' => __DIR__ . '/..' . '/mundschenk-at/check-wp-requirements/class-mundschenk-wp-requirements.php',
        'PHP_Typography\\DOM' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-dom.php',
        'PHP_Typography\\Fixes\\Default_Registry' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/class-default-registry.php',
        'PHP_Typography\\Fixes\\Node_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/class-node-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Abstract_Node_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-abstract-node-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Classes_Dependent_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-classes-dependent-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Dash_Spacing_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-dash-spacing-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Dewidow_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-dewidow-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\French_Punctuation_Spacing_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-french-punctuation-spacing-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Numbered_Abbreviation_Spacing_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-numbered-abbreviation-spacing-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Process_Words_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-process-words-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Simple_Regex_Replacement_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-simple-regex-replacement-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Simple_Style_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-simple-style-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Single_Character_Word_Spacing_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-single-character-word-spacing-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Area_Units_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-area-units-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Dashes_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-dashes-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Diacritics_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-diacritics-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Ellipses_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-ellipses-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Exponents_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-exponents-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Fractions_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-fractions-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Marks_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-marks-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Maths_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-maths-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Ordinal_Suffix_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-ordinal-suffix-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Smart_Quotes_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-smart-quotes-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Space_Collapse_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-space-collapse-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Style_Ampersands_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-style-ampersands-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Style_Caps_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-style-caps-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Style_Hanging_Punctuation_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-style-hanging-punctuation-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Style_Initial_Quotes_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-style-initial-quotes-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Style_Numbers_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-style-numbers-fix.php',
        'PHP_Typography\\Fixes\\Node_Fixes\\Unit_Spacing_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/node-fixes/class-unit-spacing-fix.php',
        'PHP_Typography\\Fixes\\Registry' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/class-registry.php',
        'PHP_Typography\\Fixes\\Token_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/class-token-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Abstract_Token_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-abstract-token-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Hyphenate_Compounds_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-hyphenate-compounds-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Hyphenate_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-hyphenate-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Smart_Dashes_Hyphen_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-smart-dashes-hyphen-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Wrap_Emails_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-wrap-emails-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Wrap_Hard_Hyphens_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-wrap-hard-hyphens-fix.php',
        'PHP_Typography\\Fixes\\Token_Fixes\\Wrap_URLs_Fix' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/fixes/token-fixes/class-wrap-urls-fix.php',
        'PHP_Typography\\Hyphenator' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-hyphenator.php',
        'PHP_Typography\\Hyphenator\\Cache' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/hyphenator/class-cache.php',
        'PHP_Typography\\Hyphenator\\Trie_Node' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/hyphenator/class-trie-node.php',
        'PHP_Typography\\PHP_Typography' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-php-typography.php',
        'PHP_Typography\\RE' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-re.php',
        'PHP_Typography\\Settings' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-settings.php',
        'PHP_Typography\\Settings\\Dash_Style' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/settings/class-dash-style.php',
        'PHP_Typography\\Settings\\Dashes' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/settings/class-dashes.php',
        'PHP_Typography\\Settings\\Quote_Style' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/settings/class-quote-style.php',
        'PHP_Typography\\Settings\\Quotes' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/settings/class-quotes.php',
        'PHP_Typography\\Settings\\Simple_Dashes' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/settings/class-simple-dashes.php',
        'PHP_Typography\\Settings\\Simple_Quotes' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/settings/class-simple-quotes.php',
        'PHP_Typography\\Strings' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-strings.php',
        'PHP_Typography\\Text_Parser' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-text-parser.php',
        'PHP_Typography\\Text_Parser\\Token' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/text-parser/class-token.php',
        'PHP_Typography\\U' => __DIR__ . '/..' . '/mundschenk-at/php-typography/src/class-u.php',
        'WP_Typography' => __DIR__ . '/../..' . '/includes/class-wp-typography.php',
        'WP_Typography\\Components\\Admin_Interface' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-admin-interface.php',
        'WP_Typography\\Components\\Block_Editor' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-block-editor.php',
        'WP_Typography\\Components\\Common' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-common.php',
        'WP_Typography\\Components\\Multilingual_Support' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-multilingual-support.php',
        'WP_Typography\\Components\\Plugin_Component' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-plugin-component.php',
        'WP_Typography\\Components\\Public_Interface' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-public-interface.php',
        'WP_Typography\\Components\\REST_API' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-rest-api.php',
        'WP_Typography\\Components\\Setup' => __DIR__ . '/../..' . '/includes/wp-typography/components/class-setup.php',
        'WP_Typography\\Data_Storage\\Cache' => __DIR__ . '/../..' . '/includes/wp-typography/data-storage/class-cache.php',
        'WP_Typography\\Data_Storage\\Options' => __DIR__ . '/../..' . '/includes/wp-typography/data-storage/class-options.php',
        'WP_Typography\\Data_Storage\\Transients' => __DIR__ . '/../..' . '/includes/wp-typography/data-storage/class-transients.php',
        'WP_Typography\\Implementation' => __DIR__ . '/../..' . '/includes/wp-typography/class-implementation.php',
        'WP_Typography\\Integration\\ACF_Integration' => __DIR__ . '/../..' . '/includes/wp-typography/integration/class-acf-integration.php',
        'WP_Typography\\Integration\\Container' => __DIR__ . '/../..' . '/includes/wp-typography/integration/class-container.php',
        'WP_Typography\\Integration\\Plugin_Integration' => __DIR__ . '/../..' . '/includes/wp-typography/integration/class-plugin-integration.php',
        'WP_Typography\\Integration\\WooCommerce_Integration' => __DIR__ . '/../..' . '/includes/wp-typography/integration/class-woocommerce-integration.php',
        'WP_Typography\\Plugin_Controller' => __DIR__ . '/../..' . '/includes/wp-typography/class-plugin-controller.php',
        'WP_Typography\\Settings\\Abstract_Locale_Settings' => __DIR__ . '/../..' . '/includes/wp-typography/settings/class-abstract-locale-settings.php',
        'WP_Typography\\Settings\\Basic_Locale_Settings' => __DIR__ . '/../..' . '/includes/wp-typography/settings/class-basic-locale-settings.php',
        'WP_Typography\\Settings\\Locale_Settings' => __DIR__ . '/../..' . '/includes/wp-typography/settings/class-locale-settings.php',
        'WP_Typography\\Settings\\Plugin_Configuration' => __DIR__ . '/../..' . '/includes/wp-typography/settings/class-plugin-configuration.php',
        'WP_Typography\\Settings\\Tools' => __DIR__ . '/../..' . '/includes/wp-typography/settings/class-tools.php',
        'WP_Typography\\Typography\\Custom_Node_Fix' => __DIR__ . '/../..' . '/includes/wp-typography/typography/class-custom-node-fix.php',
        'WP_Typography\\Typography\\Custom_Registry' => __DIR__ . '/../..' . '/includes/wp-typography/typography/class-custom-registry.php',
        'WP_Typography\\Typography\\Custom_Token_Fix' => __DIR__ . '/../..' . '/includes/wp-typography/typography/class-custom-token-fix.php',
        'WP_Typography\\UI\\Sections' => __DIR__ . '/../..' . '/includes/wp-typography/ui/class-sections.php',
        'WP_Typography\\UI\\Tabs' => __DIR__ . '/../..' . '/includes/wp-typography/ui/class-tabs.php',
        'WP_Typography\\Vendor\\Dice\\Dice' => __DIR__ . '/..' . '/level-2/dice/Dice.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Elements' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Elements.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Entities' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Entities.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Exception' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Exception.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\InstructionProcessor' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/InstructionProcessor.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\CharacterReference' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/CharacterReference.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\DOMTreeBuilder' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/DOMTreeBuilder.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\EventHandler' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/EventHandler.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\FileInputStream' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/FileInputStream.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\InputStream' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/InputStream.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\ParseError' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/ParseError.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\Scanner' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/Scanner.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\StringInputStream' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/StringInputStream.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\Tokenizer' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/Tokenizer.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\TreeBuildingRules' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/TreeBuildingRules.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Parser\\UTF8Utils' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/UTF8Utils.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Serializer\\HTML5Entities' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/HTML5Entities.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Serializer\\OutputRules' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/OutputRules.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Serializer\\RulesInterface' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/RulesInterface.php',
        'WP_Typography\\Vendor\\Masterminds\\HTML5\\Serializer\\Traverser' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/Traverser.php',
        'WP_Typography\\Vendor\\Mundschenk\\Data_Storage\\Abstract_Cache' => __DIR__ . '/..' . '/mundschenk-at/wp-data-storage/src/class-abstract-cache.php',
        'WP_Typography\\Vendor\\Mundschenk\\Data_Storage\\Cache' => __DIR__ . '/..' . '/mundschenk-at/wp-data-storage/src/class-cache.php',
        'WP_Typography\\Vendor\\Mundschenk\\Data_Storage\\Network_Options' => __DIR__ . '/..' . '/mundschenk-at/wp-data-storage/src/class-network-options.php',
        'WP_Typography\\Vendor\\Mundschenk\\Data_Storage\\Options' => __DIR__ . '/..' . '/mundschenk-at/wp-data-storage/src/class-options.php',
        'WP_Typography\\Vendor\\Mundschenk\\Data_Storage\\Site_Transients' => __DIR__ . '/..' . '/mundschenk-at/wp-data-storage/src/class-site-transients.php',
        'WP_Typography\\Vendor\\Mundschenk\\Data_Storage\\Transients' => __DIR__ . '/..' . '/mundschenk-at/wp-data-storage/src/class-transients.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Abstract_Control' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/class-abstract-control.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Control' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/class-control.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Control_Factory' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/class-control-factory.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Checkbox_Input' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-checkbox-input.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Display_Text' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-display-text.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Hidden_Input' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-hidden-input.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Input' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-input.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Number_Input' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-number-input.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Select' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-select.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Submit_Input' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-submit-input.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Text_Input' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-text-input.php',
        'WP_Typography\\Vendor\\Mundschenk\\UI\\Controls\\Textarea' => __DIR__ . '/..' . '/mundschenk-at/wp-settings-ui/src/ui/controls/class-textarea.php',
        'WP_Typography_Factory' => __DIR__ . '/../..' . '/includes/class-wp-typography-factory.php',
        'WP_Typography_Requirements' => __DIR__ . '/../..' . '/includes/class-wp-typography-requirements.php',
    );

    public static function getInitializer(ClassLoaderWPTypography $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitWPTypography::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitWPTypography::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitWPTypography::$classMap;

        }, null, ClassLoaderWPTypography::class);
    }
}
