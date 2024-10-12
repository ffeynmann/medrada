<?php
$url    = GT3PG_LITE_IMG_URL.'/thumbs/';
$themes = array(
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/oni-photography-wordpress-theme-for-elementor/24461452',
		'img'  => 'oni.jpg',
		'name' => 'Oni'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/soho-fullscreen-photo-video-wordpress-theme/10020792',
		'img'  => 'soho.jpg',
		'name' => 'Soho'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/moone-photography-portfolio-wordpress-theme/21690421',
		'img'  => 'moone.jpg',
		'name' => 'Moone'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/ewebot-seo-and-marketing-agency-wordpress-theme/24776025',
		'img'  => 'ewebot.jpg',
		'name' => 'Ewebot'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/odry-photography-portfolio-wordpress-theme/25251979',
		'img'  => 'odry.jpg',
		'name' => 'Odry'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/juris-law-consulting-services-wordpress-theme/24900705',
		'img'  => 'juris.jpg',
		'name' => 'Juris'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/qudos-multipurpose-elementor-wordpress-theme/22595558',
		'img'  => 'qudos.jpg',
		'name' => 'Qudos'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/listingeasy-directory-wordpress-theme/20882964',
		'img'  => 'listingeasy.jpg',
		'name' => 'Listingeasy'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/optima-psychologist-psychology-center-wordpress-theme/21431402',
		'img'  => 'optima.jpg',
		'name' => 'Optima'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/zohar-business-consulting-elementor-wordpress-theme/23194664',
		'img'  => 'zohar.jpg',
		'name' => 'Zohar'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/woocommerce-multipurpose-responsive-wordpress-theme-wizestore/19999516',
		'img'  => 'wizestore.jpg',
		'name' => 'Wizestore'
	),
	array(
		'url'  => 'https://1.envato.market/c/296172/275988/4415?u=https://themeforest.net/item/sunergy-multipurpose-green-energy-and-ecology-wordpress-theme/21865879',
		'img'  => 'sunergy.jpg',
		'name' => 'Sunergy'
	),
)
?>

<div class="most_popular_wp_themes">
	<h2><?php echo esc_html__('Premium WordPress Themes', 'gt3pg_pro') ?></h2>
	<p><?php echo esc_html__('GT3themes provides high-quality WordPress themes which are easy to use and customize.', 'gt3pg_pro') ?></p>
	<div class="most_popular_wp_themes_wrap">
	<?php
		foreach($themes as $theme) {
			echo '<div class="wp_themes_item"><a href="'.$theme['url'].'" target="_blank"><img src="'.$url.$theme['img'].'" alt="'.$theme['name'].'" /><span class="purchase_wp_theme">'. esc_html__('View Demo', 'gt3pg_pro') .'</span></a></div>';
		}
	?>
	</div>
</div>
