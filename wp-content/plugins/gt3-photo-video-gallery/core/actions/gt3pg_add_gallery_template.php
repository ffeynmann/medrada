<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	} // Exit if accessed directly

	function gt3pg_add_gallery_template() {
		// change native template
		global $gt3_photo_gallery, $gt3_photo_gallery_defaults;

		?>
		<script>
			jQuery(function() {
				wp.media._galleryDefaults = {
					itemtag: 'dl',
					icontag: 'dt',
					captiontag: 'dd',
					columns: '<?php echo( ( isset( $gt3_photo_gallery['columns'] ) ) ? $gt3_photo_gallery['columns'] : '' ); ?>',
					real_columns: 'default',
					link: 'default',
					size: 'default',
					order: 'ASC',
					id: wp.media.view.settings.post && wp.media.view.settings.post.id,
					orderby: 'menu_order ID',
					rand_order: 'default',
					rand_settings: '<?php echo isset( $gt3_photo_gallery['random'] ) ? $gt3_photo_gallery['random'] : ''  ?>',
					margin: '<?php echo isset( $gt3_photo_gallery['margin'] ) ? $gt3_photo_gallery['margin'] : ''  ?>',
					thumb_type: 'default',
					corners_type: 'default',
					border_type: 'default',
					border_size: '<?php echo isset( $gt3_photo_gallery['borderSize'] ) ? $gt3_photo_gallery['borderSize'] : ''; ?>',
					border_padding: '<?php echo isset( $gt3_photo_gallery['borderPadding'] ) ? $gt3_photo_gallery['borderPadding'] : ''; ?>',
					border_col: '<?php echo isset( $gt3_photo_gallery['borderColor'] ) ? $gt3_photo_gallery['borderColor'] : ''; ?>',
					<?php do_action( 'gt3pg_admin_default_settings' ); ?>
					is_margin: 'default'
				};

				if ( wp.media.view.settings.galleryDefaults ) {
					wp.media.galleryDefaults = _.extend( {}, wp.media._galleryDefaults, wp.media.view.settings.galleryDefaults );
				} else {
					wp.media.galleryDefaults = wp.media._galleryDefaults;
				}

				wp.media.gallery = new wp.media.collection({
					tag: 'gallery',
					type : 'image',
					editTitle : wp.media.view.l10n.editGalleryTitle,
					defaults : wp.media.galleryDefaults,

					setDefaults: function( attrs ) {
						var self = this, changed = ! _.isEqual( wp.media.galleryDefaults, wp.media._galleryDefaults );
						_.each( this.defaults, function( value, key ) {
							attrs[ key ] = self.coerce( attrs, key );
							if ( value === attrs[ key ] && ( ! changed || value === wp.media._galleryDefaults[ key ] ) ) {
								delete attrs[ key ];
							}
						} );
						return attrs;
					}
				});

				var script_text = '<div class="gt3pg_settings"><h2><?php _e( 'GT3 Photo & Video Gallery Settings' );?></h2>'+
						'<b>deprecated</b><br/>'+
					'<label class="gt3pg_setting">'+
					'<input class="hidden" type="hidden" name="gt3_gallery" data-setting="gt3_gallery" value="yes"/>'+
					'</label>'+

					<?php
					$panels = array();
					$panels = apply_filters( 'gt3_before_admin_panel_tabs_controls', $panels );
					ksort( $panels, SORT_NUMERIC );
					foreach ( $panels as $position => $panel ) {
						/* @var gt3panel_control $control */
						$panel = apply_filters( 'gt3_before_render_admin_panel_control_' . $panel->name, $panel, $panel->name );
						if ( $panel instanceof gt3panel_control ) {
							echo $panel;
						}
					}
					?>

					'<script>'+
					'jQuery(\'input[name="color_picker"]\').val(jQuery(\'input[name="border_col"]\').val());'+
					'jQuery(\'.gt3pg_settings\').attr("data-post-id", jQuery("#post_ID").val());'+


					'jQuery(\'.media-button-insert\').on("mousedown", function(e){ e.preventDefault();' +
					'if (jQuery("select[name=\'border_type\']").val() == "default") { ' +
					'   jQuery(\'input[name="border_size"]\').val(<?php echo $gt3_photo_gallery["borderSize"] ?>).trigger("change").trigger("input").trigger("focus").trigger("blur"); ' +
					'   jQuery(\'input[name="border_padding"]\').val(<?php echo $gt3_photo_gallery["borderPadding"] ?>).trigger("change").trigger("input").trigger("focus").trigger("blur"); ' + '' +
					'   jQuery(\'input[name="border_col"]\').val("#<?php echo substr( $gt3_photo_gallery["borderColor"], 1 ); ?>").trigger("change").trigger("input").trigger("focus").trigger("blur"); }' +

					'   if(jQuery(".rand_order").val() == "rand") jQuery(\'input[name="orderby"]\').prop("checked", "checked").trigger("change").trigger("input").trigger("focus").trigger("blur"); ' +
					'       else if(jQuery(".rand_order").val() == "menu_order ID") jQuery(\'input[name="orderby"]\').prop("checked", false).trigger("change").trigger("input").trigger("focus").trigger("blur"); ' +
					'       else if (<?php echo( ( $gt3_photo_gallery["random"] == "checked" || $gt3_photo_gallery["random"] == "on" ) ? "true" : "false" )?>) jQuery(\'input[name="orderby"]\').prop("checked", "checked").trigger("change").trigger("input").trigger("focus").trigger("blur"); ' +
					'       else jQuery(\'input[name="orderby"]\').prop("checked", false).trigger("change").trigger("input").trigger("focus").trigger("blur");' +

					'   if (jQuery("select[name=\'is_margin\']").val() == "default") { jQuery(\'input[name="margin"]\').val(<?php echo $gt3_photo_gallery["margin"] ?>).trigger("change").trigger("input").trigger("focus").trigger("blur"); }' +

					<?php
					do_action( 'gt3_add_gallery_template_script_mousedown' );
					?>
					'});' +


					'jQuery(\'input[name="gt3_gallery"]\').trigger("change").trigger("input").trigger("focus").trigger("blur");' +
					'jQuery(".gt3pg_setting.random").hide();' +

					'if(jQuery(".border_type").val() == "on") jQuery(".border_setting").show(); else jQuery(".border_setting").hide();' +
					'jQuery(".border_type").on("change", function(){' +
					'if(jQuery(".border_type").val() == "on") jQuery(".gt3pg_setting.border_setting").show(); else jQuery(".gt3pg_setting.border_setting").hide(); });' +
					'if(jQuery(".is_margin").val() == "custom") jQuery(".gt3pg_setting.margin").show(); else jQuery(".gt3pg_setting.margin").hide(); ' +
					'jQuery(".is_margin").on("change", function(){' +
					'if(jQuery(".is_margin").val() == "custom") jQuery(".gt3pg_setting.margin").show(); else jQuery(".gt3pg_setting.margin").hide(); });' +
					'jQuery(\'input[name="color_picker"]\').wpColorPicker();' +

					<?php
					do_action( 'gt3_add_gallery_template_script_main' );
					?>


					'jQuery(\'.media-button-insert\').on("mouseover", function() {' +
					'if (jQuery(\'input[name="color_picker"]\').val() != "undefined") jQuery(\'input[name="border_col"]\').val(jQuery(\'input[name="color_picker"]\').val()).trigger("change").trigger("input").trigger("focus").trigger("blur");' +
					'if (jQuery(\'select[name="real_columns"]\').val() != "default" && jQuery(\'select[name="real_columns"]\').val() != jQuery(\'select[name="columns"]\').val()) jQuery(\'select[name="columns"]\').val(jQuery(\'select[name="real_columns"]\').val()).trigger("change").trigger("input").trigger("focus").trigger("blur"); else if (jQuery(\'select[name="real_columns"]\').val() == "default") jQuery(\'select[name="columns"]\').val("<?php echo( ( isset( $gt3_photo_gallery['columns'] ) ) ? $gt3_photo_gallery['columns'] : '' ) ?>").trigger("change").trigger("input").trigger("focus").trigger("blur");' +
					<?php
					do_action( 'gt3_add_gallery_template_script_mouseover' );
					?>
					'});' +
					'<\/script>'+

					'</div>';

				if (document.body.classList.contains('gutenberg-editor-page') ||
				document.body.classList.contains('block-editor-page')) {
					jQuery('script#tmpl-gallery-settings').text('');
				} else {
					jQuery('script#tmpl-gallery-settings').text(script_text);
				}


			});
		</script><?php
	}
