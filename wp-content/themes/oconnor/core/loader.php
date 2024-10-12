<?php

#main config
if (class_exists( 'RWMB_Loader' )) {
	function gt3_metabox_init(){
    	require_once(get_template_directory() . "/core/metabox_config.php");
    }
	add_action('init', 'gt3_metabox_init', 20);
}


require_once(get_template_directory() . "/core/metabox_config.php");

require_once(get_template_directory() . "/core/config.php");
require_once(get_template_directory() . "/core/default-options.php");
require_once(get_template_directory() . "/core/redux-config.php");
require_once(get_template_directory() . "/core/vc/init.php");


#all registration
require_once(get_template_directory() . "/core/registrator/css-js.php");
require_once(get_template_directory() . "/core/registrator/ajax-handlers.php");
require_once(get_template_directory() . "/core/registrator/sidebars.php");
require_once(get_template_directory() . "/core/registrator/misc.php");
require_once(get_template_directory() . "/core/registrator/license_verification.php");


#TGM init
require_once(get_template_directory() . "/core/tgm/gt3-tgm.php");