<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/gt3themes
 * @since      1.0.0
 *
 * @package    Gt3_oconnor_core
 * @subpackage Gt3_oconnor_core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gt3_oconnor_core
 * @subpackage Gt3_oconnor_core/includes
 * @author     GT3themes <gt3themes@gmail.com>
 */
class Gt3_oconnor_core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gt3_oconnor_core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'gt3_oconnor_core';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_CPT_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gt3_oconnor_core_Loader. Orchestrates the hooks of the plugin.
	 * - Gt3_oconnor_core_i18n. Defines internationalization functionality.
	 * - Gt3_oconnor_core_Admin. Defines all hooks for the admin area.
	 * - Gt3_oconnor_core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .'/includes/widgets/posts.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) .'/includes/widgets/flickr.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3_oconnor_core-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3_oconnor_core-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-gt3_oconnor_core-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gt3_oconnor_core-public.php';

		//Load redux
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/class.redux-plugin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/init.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-extension-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-importer-config.php';
		//Load meta-box
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box/meta-box.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/metabox-addon.php';

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/aq_resizer.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/post-types-register.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/team/team-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/team/shortcodes/team.php';

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/practice/practice-register.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/practice/shortcodes/practice.php';

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/case/case-register.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/case/shortcodes/case.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-adding-functions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/gt3_mega_menu/class-gt3_mega_menu.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3-woocommerce-adjacent-products.php';

		$this->loader = new Gt3_oconnor_core_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gt3_oconnor_core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Gt3_oconnor_core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Gt3_oconnor_core_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	/**
	 * Register all of the hooks related to the CPT functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_CPT_hooks(){
		$plugin_CPT = gt3PostTypesRegister::getInstance();
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'register' );
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'shortcodes' );
        $practice = new Gt3PracticeRegister();
		$team = new gt3TeamRegister();
		$case = new gt3CaseRegister();
		/*register practice single*/
		$this->loader->add_filter( 'single_template', $practice, 'registerSingleTemplate');
		$this->loader->add_filter( 'archive_template', $practice, 'registerArchiveTemplate');
		$this->loader->add_filter( 'single_template', $team, 'registerSingleTemplate');
		$this->loader->add_filter( 'archive_template', $team, 'registerArchiveTemplate');
		$this->loader->add_filter( 'single_template', $case, 'registerSingleTemplate');
		$this->loader->add_filter( 'archive_template', $case, 'registerArchiveTemplate');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Gt3_oconnor_core_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gt3_oconnor_core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
