!function($) {
	jQuery(".gt3-icon-id label").on("click", function() {
	    jQuery(this).attr("class","selected").siblings().removeAttr("class");
	    var cur_src = jQuery(this).find("img").attr("src"),
	        prev_value = jQuery(this).parent().parent().find(".trace-img-select").val(),
	        cur_value = jQuery(this).find("input").attr("value");
	    jQuery(this).parent().parent().find(".trace-img-select").val(cur_value).removeClass(prev_value).addClass(cur_value);
	});
}(window.jQuery);