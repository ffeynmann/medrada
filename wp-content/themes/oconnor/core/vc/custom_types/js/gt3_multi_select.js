!function($) {
	$(".gt3-multi-select").each(function () {

		$(this).siblings('.multi-select').select2();
	    $(this).siblings('select.multi-select').change(function () {
	        var ids = $(this).val();
	        var id_str = "";
	        if (ids != null) {
	            for (var i = 0; i<ids.length; i++) {
	                if (i == 0) id_str = ids[i];
	                else id_str += "," + ids[i];
	            }
	        }
	        $(this).siblings(".gt3-multi-select").val(id_str);
	    });
	    
	}) 
    
}(window.jQuery);