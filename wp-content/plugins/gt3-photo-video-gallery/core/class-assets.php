<?php

namespace GT3\PhotoVideoGallery;
defined('ABSPATH') OR exit;


class Assets {
	private static $instance = null;

	public static function instance(){
		if(!self::$instance instanceof self) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private $style = array();
	private $responsive_style = array();

	private $pro_enabled;
	private $optimizer_enabled;

	private function __construct(){
		// Frontend
		add_action('elementor/frontend/before_enqueue_scripts', array( $this, 'frontend_elementor' ));
		add_action('enqueue_block_assets', array( $this, 'frontend_gutenberg' ));

		// Admin area
		add_action('elementor/editor/before_enqueue_scripts', array( $this, 'editor_elementor' ));
		add_action('enqueue_block_editor_assets', array( $this, 'editor_gutenberg' ));

		add_action('after_setup_theme', function() {
			$this->optimizer_enabled = defined('GT3PG_FHD_PLUGINPATH');
			$this->pro_enabled = defined('GT3PG_PRO_PLUGIN_VERSION');
		}, 0);
		///
	}

	public function getPlugins(){
		return array(
			'io'  => $this->optimizer_enabled,
			'pro' => $this->pro_enabled,
		);
	}

	public function pluginEnable($name) {
		$plugins = $this->getPlugins();
		if (key_exists($name, $plugins)) return $plugins[$name];
		else return false;
	}

	public function frontend_elementor(){

	}


	public function editor_elementor(){

	}


	function get_jed_locale_data($domain){
		$translations = get_translations_for_domain($domain);

		$locale = array(
			'' => array(
				'domain' => $domain,
				'lang'   => is_admin() ? get_user_locale() : get_locale(),
			),
		);

		if(!empty($translations->headers['Plural-Forms'])) {
			$locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
		}

		foreach($translations->entries as $msgid => $entry) {
			$locale[$msgid] = $entry->translations;
		}

		return $locale;
	}

	/**
	 * Enqueue Gutenberg block assets for both frontend + backend.
	 */
	function frontend_gutenberg(){
		wp_enqueue_style('wp-blocks');
//		if(apply_filters('gt3pg-lite/blocks/enable-style', true)) {
		wp_enqueue_style(
			'gt3pg-lite-frontend',
			GT3PG_LITE_CSS_URL.'gutenberg/frontend.css',
			array(),
			filemtime(GT3PG_LITE_CSS_PATH.'gutenberg/frontend.css')
		);
//		}

		wp_enqueue_script(
			'gt3pg-lite-frontend',
			GT3PG_LITE_JS_URL.'gutenberg/frontend.js',
			array(
				'jquery-ui-tabs',
				'jquery-ui-accordion',
				'wp-i18n',
				'imagesloaded',
			),
			filemtime(GT3PG_LITE_JS_PATH.'gutenberg/frontend.js'),
			true
		);

		wp_enqueue_script('isotope',
			GT3PG_LITE_JS_URL.'isotope.pkgd.min.js',
			array(),
			filemtime(GT3PG_LITE_JS_PATH.'isotope.pkgd.min.js'),
			true);

		$locale  = $this->get_jed_locale_data('gt3pg');
		$content = ';document.addEventListener("DOMContentLoaded", function(){window.wp && wp.i18n && wp.i18n.setLocaleData('.json_encode($locale).', "gt3pg" );;window.ajaxurl = window.ajaxurl || "'.admin_url('admin-ajax.php').'";});';

		wp_script_add_data('gt3pg-lite-frontend', 'data', $content);

		wp_register_script('vimeo_api', 'https://player.vimeo.com/api/player.js', array(), false, true);
		wp_register_script('youtube_api', 'https://www.youtube.com/iframe_api', array(), false, true);
	}

	/**
	 * Enqueue Gutenberg block assets for backend editor.
	 */
	function editor_gutenberg(){
		wp_enqueue_media();
		wp_enqueue_script('media-grid');
		wp_enqueue_script('media');
		// Scripts.
		wp_enqueue_script(
			'gt3pg-lite-blocks-editor',
			GT3PG_LITE_JS_URL.'gutenberg/editor.js',
			array(
				'wp-blocks',
				'wp-i18n',
				'wp-element',
				// Tabs
				'jquery-ui-tabs',
				'jquery-ui-accordion',
			), // Dependencies, defined above.
			filemtime(GT3PG_LITE_JS_PATH.'gutenberg/editor.js'),
			true
		);

		$settings = Settings::instance();

		wp_localize_script(
			'gt3pg-lite-blocks-editor',
			'gt3pg_lite',
			array(
				'defaults' => $settings->getSettings(),
				'blocks'   => array_map('strtolower', $settings->getBlocks()),
				'plugins'  => array(
					'io'  => $this->optimizer_enabled,
					'pro' => $this->pro_enabled,
				),
				'_watermark_nonce' => wp_create_nonce('process_watermarks'),
			)
		);
		// Styles.
		wp_enqueue_style(
			'gt3pg-lite-blocks-editor',
			GT3PG_LITE_CSS_URL.'gutenberg/editor.css',
			array( 'wp-edit-blocks' ),
			filemtime(GT3PG_LITE_CSS_PATH.'gutenberg/editor.css')
		);
	}

	public function camelToUnderscore($string, $us = "-"){
		$patterns = array(
			'/([a-z]+)([0-9]+)/i',
			'/([a-z]+)([A-Z]+)/',
			'/([0-9]+)([a-z]+)/i'
		);
		$string   = preg_replace($patterns, '$1'.$us.'$2', $string);

		return strtolower($string);
	}

	public function getStyles($with_tags = true, $getResponsiveStyle = true){
		$style = '';
		if(is_array($this->style) && count($this->style)) {
			foreach($this->style as $selector => $_styles) {
				if(is_array($_styles) && count($_styles)) {
					$_style = '';
					foreach($_styles as $styleName => $value) {
						if(!empty($value)) {
							if(!is_array($value)) {
								$value = array( $value );
							}
							if(substr($styleName, -1, 1) !== ';') {
								$styleName .= ';';
							}
							$_style .= "\t".sprintf($this->camelToUnderscore($styleName), ...$value).PHP_EOL;
						}
					}
					if(!empty($_style)) {
						$style .= $selector.' {'.PHP_EOL.$_style.'}'.PHP_EOL;
					}
				}
			}
		}
		if($getResponsiveStyle) {
			$style .= $this->getResponsiveStyles();
		}
		if(!empty($style) && $with_tags) {
			return '<style>'.$style.'</style>';
		}

		return $style;
	}

	/**
	 * @param array|string $selector
	 * @param array|null   $value
	 */
	public function addStyle($selector, $value = null){
		if(is_array($selector) && count($selector)) {

			foreach($selector as $_selector => $_value) {
				if(is_numeric($_selector)) {
					$_selector = $_value;
					$_value    = $value;
				}
				if(isset($this->style[$_selector])) {
					$oldStyle = $this->style[$_selector];
				} else {
					$oldStyle = array();
				}
				$this->style[$_selector] = array_merge($oldStyle, $_value);
			}
		} else {
			if(isset($this->style[$selector])) {
				$oldStyle = $this->style[$selector];
			} else {
				$oldStyle = array();
			}
			$this->style[$selector] = array_merge($oldStyle, $value);
		}
	}

	public function getResponsiveStyles(){
		$style = '';
		if(is_array($this->responsive_style) && count($this->responsive_style)) {
			krsort($this->responsive_style);
			foreach($this->responsive_style as $maxWidth => $_styles) {
				if(is_array($_styles) && count($_styles)) {
					$this->style      = $_styles;
					$responsive_style = $this->getStyles(false, false);
					if(!empty($responsive_style)) {
						$style .= '@media screen and (max-width: '.$maxWidth.'px) {'."\t".PHP_EOL.$responsive_style."\t".PHP_EOL.'}'.PHP_EOL;
					}
				}
			}
		}

		return $style;
	}

	public function addResponsiveStyle($maxWidth, $selector, $value = null){
		if(is_array($selector) && count($selector)) {
			foreach($selector as $_selector => $value) {
				if(isset($this->responsive_style[$maxWidth]) && isset($this->responsive_style[$maxWidth][$_selector])) {
					$oldStyle = $this->responsive_style[$maxWidth][$_selector];
				} else {
					$oldStyle = array();
				}
				$this->responsive_style[$maxWidth][$_selector] = array_merge($oldStyle, $value);
			}
		} else {
			if(isset($this->responsive_style[$maxWidth]) && isset($this->responsive_style[$maxWidth][$selector])) {
				$oldStyle = $this->responsive_style[$maxWidth][$selector];
			} else {
				$oldStyle = array();
			}
			$this->responsive_style[$maxWidth][$selector] = array_merge($oldStyle, $value);
		}
	}

	/**
	 * @param array|string $selector
	 * @param array|string $style
	 * @param array        $block
	 */
	public function addResponsiveBlock($selector, $style, $block){
		if(is_array($block) && key_exists('default', $block)) {
			if(is_array($selector) && count($selector)) {
				foreach($selector as $_selector) {
					// Default
					if(is_array($style) && count($style)) {
						foreach($style as $_style) {
							$this->addStyle($_selector, array( $_style => $block['default'] ));
						}
					} else {
						$this->addStyle($_selector, array( $style => $block['default'] ));
					}

					// Responsive
					if(key_exists('responsive', $block)
					   && $block['responsive']
					   && key_exists('data', $block)
					   && is_array($block['data'])
					   && count($block['data'])) {
						foreach($block['data'] as $name => $data) {
							if(is_array($style) && count($style)) {
								foreach($style as $_style) {
									$this->addResponsiveStyle($data['width'], $_selector, array( $_style => $data['value'] ));
								}
							} else {
								$this->addResponsiveStyle($data['width'], $_selector, array( $style => $data['value'] ));
							}
						}
					}
				}
			}
		}
	}
}


