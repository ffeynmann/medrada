// Popup
function gt3_show_admin_pop(gt3_message_text, gt3_message_type) {
    // Success - gt3_message_type = 'info_message'
    // Error - gt3_message_type = 'error_message'
    jQuery(".gt3_result_message").remove();
    jQuery("body").removeClass('active_message_popup').addClass('active_message_popup');
    jQuery("body").append("<div class='gt3_result_message " + gt3_message_type + "'>" + gt3_message_text + "</div>");
    var messagetimer = setTimeout(function () {
        jQuery(".gt3_result_message").fadeOut();
        jQuery("body").removeClass('active_message_popup');
        clearTimeout(messagetimer);
    }, 3000);
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function waiting_state_start() {
    jQuery(".waiting-bg").show();
}

function waiting_state_end() {
    jQuery(".waiting-bg").hide();
}

// Composer Part
function gt3_update_slider_value(cur_obj) {
    var obj_array = [];
    cur_obj.find(".vc-slide-item").each(function () {
        var data_type = jQuery(this).attr("data-type"),
            data_url = jQuery(this).attr("data-url"),
            tmp_arr = new Object();

        tmp_arr["slide_type"] = data_type;
        tmp_arr["slide_url"] = data_url;

        if (data_type == "video") {
            var data_title = jQuery(this).attr("data-title"),
                data_caption = jQuery(this).attr("data-caption"),
                data_cover = jQuery(this).attr("data-cover");

            tmp_arr["slide_title"] = data_title;
            tmp_arr["slide_caption"] = data_caption;
            tmp_arr["slide_cover"] = data_cover;
        }

        obj_array.push(tmp_arr);
    });

    var data = {
        action: "gt3_get_param_value_for_slider",
        string: JSON.stringify(obj_array)
    };

    jQuery.post(ajaxurl, data, function (response) {
        cur_obj.closest(".edit_form_line").find(".wpb_vc_param_value").val(response);
    });
}

jQuery(document).on("click", ".inter_x_2", function () {
    var object_for_update = jQuery(this).closest(".gt3-slides-list");

    jQuery(this).closest("li").remove();
    gt3_update_slider_value(object_for_update);
});

jQuery(document).on("click", ".vc-add-slide-image", function () {
    var ul_to_append = jQuery(this).siblings(".gt3-slides-list");

    var file_frame = wp.media.frames.file_frame = wp.media({
        title: "Select Images",
        button: {
            text: "Select",
        },
        multiple: true,
        library: {
            type: "image"
        }
    });

    var itemsIDs = [];

    file_frame.on("select", function () {
        file_frame.state().get("selection").forEach(function (item, i, arr) {
            itemsIDs[itemsIDs.length] = item.id;
        });

        var data = {
            action: "gt3_get_vc_images_for_slider",
            ids: itemsIDs.join(","),
        }

        jQuery.post(ajaxurl, data, function (response) {
            ul_to_append.append(response);
            gt3_update_slider_value(ul_to_append);
        });
    });

    file_frame.open();
});

jQuery(document).on("click", ".vc-add-slide-video", function () {
    var line = "\
  <div class='vc-video-popup'>\
    <h4>Add Video</h4>\
    <p>Video URL:</p>\
    <input type='text' name='video_url'>\
    <p>Video Title:</p>\
    <input type='text' name='video_title'>\
    <p>Image Cover:</p>\
    <div class='video-image-preview' data-url=''></div>\
    <input type='button' name='select_image' value='Select'>\
    <p>Video Caption:</p>\
    <input type='text' name='video_caption'>\
    <p></p>\
    <input type='button' name='cancel_vc_video_popup' value='Cancel'>\
    <input type='button' name='save_vc_video_popup' value='Save'>\
  </div>";


    if (!jQuery(this).siblings(".vc-video-popup").length)
        jQuery(this).siblings(".gt3-slides-list").after(line);
});

jQuery(document).on("click", "input[name='cancel_vc_video_popup']", function () {
    jQuery(this).closest(".vc-video-popup").siblings(".gt3-slides-list").show();
    jQuery(this).closest(".vc-video-popup").remove();
});

jQuery(document).on("click", "input[name='select_image'], .video-image-preview", function () {
    var div_to_append = jQuery(this).closest(".vc-video-popup").find(".video-image-preview");

    var file_frame = wp.media.frames.file_frame = wp.media({
        title: "Select Images",
        button: {
            text: "Select"
        },
        multiple: false,
        library: {
            type: "image"
        }
    });

    var itemsIDs = [];

    file_frame.on("select", function () {
        var gt3_image_attachment = file_frame.state().get("selection").first().toJSON();

        var data = {
            action: "gt3_get_vc_image_for_video_cover",
            url: gt3_image_attachment.url,
        }

        jQuery.post(ajaxurl, data, function (response) {
            div_to_append.attr("data-url", gt3_image_attachment.url).html(response);
        });
    });

    file_frame.open();
});

jQuery(document).on("click", "input[name='save_vc_video_popup']", function () {
    var div_to_remove = jQuery(this).closest(".vc-video-popup"),
        ul_to_append = div_to_remove.siblings(".gt3-slides-list");

    var url = div_to_remove.find("input[name='video_url']").val(),
        title = div_to_remove.find("input[name='video_title']").val(),
        image = div_to_remove.find(".video-image-preview").attr("data-url"),
        caption = div_to_remove.find("input[name='video_caption']").val();

    var data = {
        action: "gt3_get_vc_video_for_slider",
        url: url,
        title: title,
        image: image,
        caption: caption
    }

    jQuery.post(ajaxurl, data, function (response) {
        ul_to_append.append(response);
        div_to_remove.remove();
        gt3_update_slider_value(ul_to_append);
    });
});

jQuery(document).on("click", "input[name='save_vc_edit_video_popup']", function () {
    var div_to_remove = jQuery(this).closest(".vc-video-popup"),
        ul_to_append = div_to_remove.siblings(".gt3-slides-list"),
        li_to_replace = ul_to_append.find("li").eq(div_to_remove.attr("data-obj-num"));

    var url = div_to_remove.find("input[name='video_url']").val(),
        title = div_to_remove.find("input[name='video_title']").val(),
        image = div_to_remove.find(".video-image-preview").attr("data-url"),
        caption = div_to_remove.find("input[name='video_caption']").val();

    var data = {
        action: "gt3_get_vc_video_for_slider",
        url: url,
        title: title,
        image: image,
        caption: caption
    }

    jQuery.post(ajaxurl, data, function (response) {
        li_to_replace.replaceWith(response);
        ul_to_append.show();
        div_to_remove.remove();
        gt3_update_slider_value(ul_to_append);
    });
});

jQuery(document).on("click", ".inter_edit_2", function () {
    var object_for_update = jQuery(this).closest("li"),
        object_for_update_index = object_for_update.index(),
        attributes_container = object_for_update.find(".video-item"),
        url = attributes_container.attr("data-url"),
        title = attributes_container.attr("data-title"),
        image = attributes_container.attr("data-cover"),
        caption = attributes_container.attr("data-caption"),
        closest_ul = jQuery(this).closest(".gt3-slides-list");

    closest_ul.hide();

    var line = "\
  <div class='vc-video-popup' data-obj-num='" + object_for_update_index + "'>\
    <h4>Edit Video</h4>\
    <p>Video URL:</p>\
    <input type='text' name='video_url' value='" + url + "'>\
    <p>Video Title:</p>\
    <input type='text' name='video_title' value='" + title + "'>\
    <p>Image Cover:</p>\
    <div class='video-image-preview' data-url='" + image + "'></div>\
    <input type='button' name='select_image' value='Select'>\
    <p>Video Caption:</p>\
    <input type='text' name='video_caption' value='" + caption + "'>\
    <p></p>\
    <input type='button' name='cancel_vc_video_popup' value='Cancel'>\
    <input type='button' name='save_vc_edit_video_popup' value='Save'>\
  </div>";

    closest_ul.after(line);

    var data = {
        action: "gt3_get_vc_image_for_video_cover",
        url: image,
    }

    jQuery.post(ajaxurl, data, function (response) {
        closest_ul.siblings(".vc-video-popup").find(".video-image-preview").html(response);
    });
});





// gt3ButtonDependency
function gt3ButtonDependency () {
    // Icon Type
    jQuery('div[data-vc-shortcode-param-name="btn_icon_type"]').each(function () {
        var cur_this = jQuery(this);
        if (cur_this.find('.btn_icon_type').val() == 'font') {
            cur_this.parents('.vc_edit_form_elements').find('div[data-vc-shortcode-param-name="btn_icon_color"], div[data-vc-shortcode-param-name="btn_icon_color_hover"]').show();
        }
        cur_this.find('.btn_icon_type').change(function () {
            if (jQuery(this).val() == 'font') {
                cur_this.parents('.vc_edit_form_elements').find('div[data-vc-shortcode-param-name="btn_icon_color"], div[data-vc-shortcode-param-name="btn_icon_color_hover"]').show();
            } else {
                cur_this.parents('.vc_edit_form_elements').find('div[data-vc-shortcode-param-name="btn_icon_color"], div[data-vc-shortcode-param-name="btn_icon_color_hover"]').hide();
            }
        });
    });
    // Border Style
    jQuery('div[data-vc-shortcode-param-name="btn_border_style"]').each(function () {
        var cur_this = jQuery(this);
        if (cur_this.find('.btn_border_style').val() != 'none') {
            cur_this.parents('.vc_edit_form_elements').find('div[data-vc-shortcode-param-name="btn_border_color"], div[data-vc-shortcode-param-name="btn_border_color_hover"]').show();
        }
        cur_this.find('.btn_border_style').change(function () {
            if (jQuery(this).val() != 'none') {
                cur_this.parents('.vc_edit_form_elements').find('div[data-vc-shortcode-param-name="btn_border_color"], div[data-vc-shortcode-param-name="btn_border_color_hover"]').show();
            } else {
                cur_this.parents('.vc_edit_form_elements').find('div[data-vc-shortcode-param-name="btn_border_color"], div[data-vc-shortcode-param-name="btn_border_color_hover"]').hide();
            }
        });
    });
}
jQuery(document).on("click", ".gt3_radio_toggle_cont", function () {
	var cur_val = jQuery(this).find('.gt3_checkbox_value').val();
	if (cur_val == 'on') {
		jQuery(this).find(".gt3_radio_toggle_mirage").removeClass("checked").addClass("not_checked");
		jQuery(this).find('.gt3_checkbox_value').val('off');
	} else {
		jQuery(this).find(".gt3_radio_toggle_mirage").removeClass("not_checked").addClass("checked");
		jQuery(this).find('.gt3_checkbox_value').val('on');
	}
});

jQuery(document).on("click", ".gt3_packery_ls_item", function () {
	var cur_wrapper = jQuery(this).parents('.gt3_packery_ls_cont'),
		cur_val = jQuery(this).attr('data-value');
		console.log(cur_val);
		cur_wrapper.find('.checked').removeClass('checked');
		cur_wrapper.find('.gt3_packery_ls_value').val(cur_val);
		cur_wrapper.find('.'+cur_val).addClass('checked');
});

jQuery(document).ready(function() {
    var navigationForm = jQuery('#update-nav-menu');
    navigationForm.on('change', '[data-item-option]', function() {
        if (jQuery(this).attr('type') == 'checkbox') {
            jQuery(this).parent().find('input[type=hidden]').val(jQuery(this).parent().find('input[type=checkbox]').is(":checked"));
            if (jQuery(this).hasClass('mega-menu-checkbox')) {
                if (jQuery(this).parent().find('input[type=checkbox]').is(":checked")) {
                    jQuery(this).parents('.menu-item ').addClass('menu-item-megamenu-active');
                    $item = jQuery(this).parents('.menu-item ');
                    do{
                        $item = $item.next();
                        if (!$item.hasClass('menu-item-depth-0')) {
                            $item.addClass('menu-item-megamenu_sub-active');
                        }
                    } while(!$item.hasClass('menu-item-depth-0') && $item.next().length != 0)
                }else{
                    jQuery(this).parents('.menu-item ').removeClass('menu-item-megamenu-active');
                    $item = jQuery(this).parents('.menu-item ');
                    do{
                        $item = $item.next();
                        if (!$item.hasClass('menu-item-depth-0')) {
                            $item.removeClass('menu-item-megamenu_sub-active');
                        }
                    } while(!$item.hasClass('menu-item-depth-0') && $item.next().length != 0)
                }
            }
        }
        if (jQuery(this)[0].tagName == 'SELECT') {
            jQuery(this).parent().find('input[type=hidden]').val(jQuery(this)[0].value);
        }
    });
});

