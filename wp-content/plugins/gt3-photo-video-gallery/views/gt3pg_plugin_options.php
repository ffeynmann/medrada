<?php
if(!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly
use GT3\PhotoVideoGallery\Settings;
use GT3\PhotoVideoGallery\Assets;

global $gt3_photo_gallery_defaults, $gt3_photo_gallery;
$plugin_info    = get_plugin_data(GT3PG_PLUGINPATH.'/gt3-photo-video-gallery.php');
$theme_list     = (array) gt3_banner_addon();
$plugin_title   = apply_filters('gt3pg_admin_title', GT3PG_ADMIN_TITLE);
$plugin_version = apply_filters('gt3pg_admin_version', $plugin_info['Version']);
$plugin_help    = apply_filters('gt3pg_admin_help', GT3PG_WORDPRESS_URL);
//wp_enqueue_script('editor');
wp_enqueue_script('gt3pg_admin_js');
?>
<script>
	var gt3pg_admin_ajax_url = "<?php echo admin_url("admin-ajax.php")?>";
</script>

<div class="gt3pg_optimized_notice" style="display: none">
	<?php esc_html_e('It requires GT3 Image Optimizer plugin', 'gt3pg'); ?>
</div>
<div class="gt3pg_admin_wrap">
	<div class="gt3pg_inner_wrap">
		<form action="" method="post" class="gt3pg_page_settings">
			<div class="gt3pg_main_line">
				<div class="gt3pg_themename">
					<?php echo $plugin_title ?>
					<span class="gt3pg_theme_ver"><?php echo $plugin_version ?></span>
				</div>
				<div class="gt3pg_links">
					<a href="<?php echo esc_attr($plugin_help) ?>" target="_blank"><?php esc_html_e('Need Help?', 'gt3pg') ?></a>
				</div>
				<div class="clear"></div>
				<?php
				$plugin            = 'gt3-photo-video-gallery-pro/gt3-photo-video-gallery-pro.php';
				$installed_plugins = get_plugins();

				if(!isset($installed_plugins[$plugin])) {
					?>
					<div class="get_pro">The <span class="gt3pg_theme_ver">Pro version</span> is now available. You can check it here -&gt;
						<a href="http://bit.ly/2BwslYG" style="color: #ffffff;">View Pro Version</a>
					</div>
					<?php
				}
				?>
			</div>
			<?php
			if(function_exists('register_block_type')) {
				wp_enqueue_script('block-library');
				wp_enqueue_script('editor');
				wp_enqueue_script('wp-editor');
				wp_enqueue_script('wp-components');
				wp_enqueue_style('wp-components');
				wp_enqueue_style('wp-element');
				wp_enqueue_style('wp-blocks-library');
				wp_enqueue_media();
				wp_enqueue_script('media-grid');
				wp_enqueue_script('media');


				wp_enqueue_script('gt3pg_settings', GT3PG_PLUGINROOTURL.'/dist/js/admin/settings.js', null, GT3PG_PLUGIN_VERSION);
				wp_enqueue_style('gt3pg_settings', GT3PG_PLUGINROOTURL.'/dist/css/admin/settings.css', null, GT3PG_PLUGIN_VERSION);
				wp_enqueue_style('gt3pg_admin_css', GT3PG_PLUGINROOTURL.'/dist/css/admin/admin.css', null, GT3PG_PLUGIN_VERSION);

				$settings = Settings::instance();
				$assets = Assets::instance();

				wp_localize_script(
					'gt3pg_settings',
					'gt3pg_lite',
					array(
						'defaults' => $settings->getSettings(),
						'blocks'   => array_map('strtolower', $settings->getBlocks()),
						'plugins'  => $assets->getPlugins(),
					)
				);

				?>
				<div class="edit-post-layout">
					<div class="edit-post-sidebar">
						<div id="gt3_editor"></div>
					</div>
				</div>
			<?php } else { ?>
				<div class="gt3pg_admin_mix-container2">
					<div class="gt3pg_admin_mix-tabs type2">
						<div class="gt3pg_admin_mix-tabs-inner">
							<div class="gt3pg_admin_head_wrap">
								<div class="gt3pg_admin_head_caption">
									<div class="gt3pg_innerpadding with_text">
										<?php
										_e('This plugin lets you extend the functionality of the default WordPress gallery. To make the changes, please use the settings below. Once you\'ve chosen the right parameters, please click <strong>"Save Settings"</strong> button.', 'gt3pg'); ?>
									</div>
								</div>
								<div class="gt3pg_admin_head_buttons">
									<div class="gt3pg_innerpadding">
										<div class="gt3pg_theme_settings_submit_cont">
											<div class="gt3pg_header_button_grow"></div>
											<input type="button" name="gt3pg_reset_theme_settings" class="gt3pg_admin_reset_settings gt3pg_admin_button gt3pg_admin_danger_btn"
											       value="<?php esc_attr_e('Reset Settings', 'gt3pg'); ?>" />
											<input type="submit" name="gt3pg_submit_theme_settings" class="gt3pg_admin_save_all gt3pg_admin_button gt3pg_admin_ok_btn"
											       value="<?php esc_attr_e('Save Settings', 'gt3pg'); ?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div class="gt3pg_admin_mix-tab-content">
								<div class="gt3pg_admin_mix-tab-controls">
									<?php
									$controls = apply_filters('gt3_admin_mix_tabs_controls', array());
									if(is_array($controls) && count($controls)) {
										ksort($controls, SORT_NUMERIC);
										foreach($controls as $position => $control) {
											/* @var gt3pg_admin_mix_tab_control $control */
											$control = apply_filters('gt3_before_render_admin_control_'.$control->name, $control, $control->name);
											if($control instanceof gt3pg_admin_mix_tab_control) {
												$control->render();
											}
										}
									}
									?>


								</div>
								<div class="gt3pg_stand_setting gt3pg_admin_mix-tab-control gt3pg_video_tutorial_cont">
									<h2 class="gt3pg_option_heading"><?php esc_html_e('How to Use Gallery. Video Tutorial.', 'gt3pg') ?></h2>
									<p><?php esc_html_e('Please watch this short video tutorial to see how to use our GT3 photo & video gallery.', 'gt3pg') ?></p>
									<iframe width="100%" height="350" src="https://www.youtube.com/embed/eIUfmr91D8g" frameborder="0" allowfullscreen></iframe>
								</div>

								<div class="gt3pg_stand_setting gt3pg_admin_mix-tab-control gt3pg_video_tutorial_cont">
									<h2 class="gt3pg_option_heading"><?php esc_html_e('Premium Photography WordPress Themes', 'gt3pg') ?></h2>
									<p><?php esc_html_e('Check out our professionally developed Photo and Video WordPress themes. Easy way to build your awesome website.', 'gt3pg') ?></p>
									<div class="gt3pg-banner_items-wrapper">
										<?php
										foreach($theme_list as $theme_item) {
											echo '<div class="gt3pg-banner_item-wrapper"><a href="'.esc_url($theme_item["item_url"]).'" class="gt3pg-banner_item_link" target="_blank"><span>'.esc_html__('View Demo', 'gt3pg').'</span><img class="gt3pg-banner-image" src="'.esc_url($theme_item["image_url"]).'" alt="gt3themes"></a></div>';
										}
										?>
									</div>
								</div>

								<div class="clear"></div>
								<div class="gt3pg_theme_settings_submit_cont albotoom">
									<div class="gt3pg_theme_settings_submit_cont">
										<input type="button" name="gt3pg_reset_theme_settings" class="gt3pg_admin_reset_settings gt3pg_admin_button gt3pg_admin_danger_btn"
										       value="<?php esc_attr_e('Reset Settings', 'gt3pg'); ?>" />
										<input type="submit" name="gt3pg_submit_theme_settings" class="gt3pg_admin_save_all gt3pg_admin_button gt3pg_admin_ok_btn"
										       value="<?php esc_attr_e('Save Settings', 'gt3pg'); ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</form>
	</div>
</div>

