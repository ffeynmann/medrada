(function ($) {
	/*hotspot*/
	vc.atts.gt3_init_hotspot = {
		init: function (param, $field) {
			if(!$field.prev().data('vc-shortcode-param-name') || !$field.prev().data('vc-shortcode-param-name') == 'image') {
				return false;
			}

			var imgSrc = '';
			var $imgInput = $field.prev().find('input[name="attach_image"]');
			var previewImage = function() {
				if($field.prev().find('img').length > 0) {
					var id = $field.find('.gt3_hotspot_manual').attr('id');
					imgSrc = $field.prev().find('img').attr('src');
					imgSrc = imgSrc.replace('-150x150', '', imgSrc);
					if($field.find('img.gt3-hotspot-image').length > 0) {
						$field.find('img.gt3-hotspot-image').attr('src', imgSrc);
					} else {
						$field.find('.gt3-hotspot-image-holder').append('<img src="'+imgSrc+'" alt="Preview image" class="gt3-hotspot-image" />');
					}
					$field.find('.gt3-hotspot-image-holder').hotspot({
						mode:		 'admin',
						LS_Variable: '#'+id,
						popupTitle:	 $field.find('.gt3-hotspot-image-holder').data('popup-title') ? $field.find('.gt3-hotspot-image-holder').data('popup-title') : 'Save',
						saveText:	 $field.find('.gt3-hotspot-image-holder').data('save-text') ? $field.find('.gt3-hotspot-image-holder').data('save-text') : 'Save',
						closeText:	 $field.find('.gt3-hotspot-image-holder').data('close-text') ? $field.find('.gt3-hotspot-image-holder').data('close-text') : 'Close',
						dataStuff:   [
							{
								'property': 'Title',
								'default': 'Please enter title here'
							},
							{
								'property': 'Message',
								'default': 'Please enter content here'
							},
							{
								'property': 'Marker',
								'default': ''
							}
						]
					});
				}
			};
				
			previewImage();
			$imgInput.change(function() {
				previewImage();
			});
		},
	};
})(window.jQuery);