<?php

namespace GT3\PhotoVideoGallery;
if(!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

if(file_exists(GT3PG_PLUGINPATH.'/gt3-photo-gallery.php')) {
	wp_delete_file(GT3PG_PLUGINPATH.'/gt3-photo-gallery.php');
}

require_once(GT3PG_PLUGINPATH."config.php");
require_once(GT3PG_PLUGINPATH."core/class/load.php");
require_once(GT3PG_PLUGINPATH."core/pg-functions.php");
require_once(GT3PG_PLUGINPATH."core/ajax-handlers.php");
require_once(GT3PG_PLUGINPATH."core/actions.php");
require_once(__DIR__.'/gutenberg_support.php');
require_once(__DIR__.'/rest_api.php');

require_once __DIR__.'/autoload.php';

Settings::instance();
Assets::instance();
Elementor\Core::instance();

