/* global confirm, redux, redux_change */

jQuery(document).ready(function() {
	jQuery('.has_settings').each(function(){
		var attr = jQuery(this).attr('data-settings-id');
		if (typeof attr !== typeof undefined && attr !== false) {
		 	jQuery(this).find('.gt3_header_builder__setting-icon').on('click',function(){
		 		console.log(jQuery('#'+attr+'-start'))
		  		jQuery('#'+attr+'-start').addClass('showSettings');
		  	})
		}
	})
	jQuery('.gt3_section__close-icon').each(function(){
		jQuery(this).on('click',function(){
			jQuery(this).parents('.gt3_section_container').removeClass('showSettings');
		})
	})
	jQuery('.gt3_section_container .gt3_section_container__cover').each(function(){
		jQuery(this).on('click',function(){
			jQuery(this).parents('.gt3_section_container').removeClass('showSettings');
		})
	})

});
