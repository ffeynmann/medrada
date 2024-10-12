<?php

/**
 * Fired during plugin activation
 *
 * @link       https://themeforest.net/user/gt3themes
 * @since      1.0.0
 *
 * @package    Gt3_oconnor_core
 * @subpackage Gt3_oconnor_core/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Gt3_oconnor_core
 * @subpackage Gt3_oconnor_core/includes
 * @author     GT3themes <gt3themes@gmail.com>
 */
class Gt3_oconnor_core_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		GT3PostTypesRegister::getInstance()->register();
		flush_rewrite_rules();
	}

}
