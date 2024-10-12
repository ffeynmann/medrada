jQuery(document).ready(function($) {
	gt3_animate_cart ();
	gt3_spinner_up_down ();
	gt3_size_guide ();
	gt3_comment_label();
	gt3_category_accordion();
    woocommerce_triger_lightbox();
});

jQuery(window).load(function($) {
	var $anim_prod = jQuery(".gt3-animation-wrapper.gt3-anim-product");
	if ($anim_prod.length) {
		gt3_scroll_animation($anim_prod, false);
	}
});

jQuery(window).resize(function($){

});

jQuery( document ).ajaxComplete(function() {
	var select = jQuery('#yith-quick-view-modal').find('.variations select');
	if (select.length) {
		select.on('change', function(){
			var thumbnails = jQuery('#yith-quick-view-modal').find('.gt3-thumbnails-control');
			var selectEmpty = true;

			select.each(function(){
			    var easyzoom = jQuery("#yith-quick-view-content").find(".woocommerce-product-gallery__image").easyZoom();
				var api = easyzoom.data('easyZoom');
				api.teardown();
				api._init();

				if ( this.value !== '') {
					selectEmpty = false;
				}
			});

			if ( selectEmpty ) {
				thumbnails.css({'height':'auto'});
			} else {
				thumbnails.find('.gt3-thumb-control-item:first').trigger( "click" );
				thumbnails.css({'height':'0'});
			}
		})
	}
});

function gt3_scroll_animation($el, newItem) {
    var order = 0,
    	lastOffsetTop = 0;
    jQuery.each($el, function(index, value) {
        var el = jQuery(this);
        el.imagesLoaded(function() {
            var elOffset 	 = el.offset(),
            	windowHeight = jQuery(window).outerHeight(),
            	delay 		 = 0,
            	offset 		 = 20;
            if (elOffset.top > (windowHeight + offset)) {
                if (order === 0) {
                    lastOffsetTop = elOffset.top;
                } else {
                    if (lastOffsetTop !== elOffset.top) {
                        order = 0;
                        lastOffsetTop = elOffset.top;
                    }
                }
                order++;
                index = order;
            }
            delay = index * 0.20;
            el.css({'transition-delay': delay + 's'}).attr('data-delay', delay).attr('data-delay', delay);
        });
    });
    $el.appear(function() {
        var el = jQuery(this)
          , windowScrollTop = jQuery(window).scrollTop();
        if (newItem) {
            el.addClass('loaded');
        } else {
            var addLoaded = setTimeout(function() {
                el.addClass('loaded');
            }, 300);
            if (windowScrollTop > 100) {
                clearTimeout(addLoaded);
                el.addClass('loaded');
            }
        }
        var elDur = el.css('transition-duration')
          , elDelay = el.css('transition-delay')
          , timeRemove = elDur.split('s')[0] * 1000 + elDelay.split('s')[0] * 1000 + 4000
          , notRemove = '.wil-progress';
        el.not(notRemove).delay(timeRemove).queue(function() {
            el.removeClass('loaded gt3-anim-product').dequeue();
        });
        el.delay(timeRemove).queue(function() {
            el.css('transition-delay', '');
        });
    }, {
        accX: 0,
        accY: 30
    });
}

// Cart Count Icon Animation
function gt3_animate_cart () {
	jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
		this.each(function() {
			for (var x=1; x<=intShakes; x++) {
				jQuery(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
				.animate({left:intDistance}, ((intDuration/intShakes)/2))
				.animate({left:0}, (((intDuration/intShakes)/4)));
			}
		});
		return this;
	};
	jQuery(document.body).live('added_to_cart', function(el, data, params){
		setTimeout(function(){
			jQuery(".gt3_header_builder_cart_component").addClass("show_cart");
			jQuery(".woo_mini-count").shake(3,1.2,300);
			jQuery(".gt3-loading-overlay, .gt3-loading").remove();
		}, 300);
		setTimeout(function(){
			jQuery(".gt3_header_builder_cart_component").removeClass("show_cart");
		}, 2800);
    });
}

// Input spinner
function gt3_spinner_up_down () {
	var rtime;
	var timeout = false;
	var delta = 400;

	jQuery('body').on('tap click', '.gt3_qty_spinner .quantity-up', function() {
		var input 	= jQuery(this).parent().find('input[type="number"]'),
			max 		= input.attr('max'),
			oldValue 	= parseFloat(input.val()),
        	newVal;
		if (oldValue >= max && '' !== max) {
			newVal = oldValue;
		} else {
			newVal = oldValue + 1;
		}
		input.val(newVal).addClass('allotted');
		input.trigger("change");

		gt3_timeout(input);
	});

	jQuery('body').on('tap click', '.gt3_qty_spinner .quantity-down', function() {
		var input 	= jQuery(this).parent().find('input[type="number"]'),
			min 		= input.attr('min'),
			oldValue 	= parseFloat(input.val()),
			newVal;
		if (oldValue <= min && '' !== min) {
			newVal = oldValue;
		} else {
			newVal = oldValue - 1;
		}
		input.val(newVal).addClass('allotted');
		input.trigger("change");

		gt3_timeout(input);
	});

	function gt3_timeout(input){
		rtime = new Date();
		if (timeout === false) {
			timeout = true;
			setTimeout(clickend, delta);
		}
		function clickend() {
			if (new Date() - rtime < delta) {
				setTimeout(clickend, delta);
			} else {
				timeout = false;
				input.removeClass('allotted');
			}
		}
	}
}

function gt3_size_guide() {
	var size_popup = jQuery('.gt3_block_size_popup');
	if (size_popup.length) {
		size_popup.on('tap click', function(){
			image_size_popup = jQuery('.image_size_popup');
			image_size_popup.addClass('active');
			if (image_size_popup.hasClass('active')) {
				jQuery(document).keyup(function(e) {
					if (e.keyCode === 27) image_size_popup.removeClass('active');
				});
				jQuery('.image_size_popup .layer, .image_size_popup .close').on('tap click', function(){
					image_size_popup.removeClass('active');
				});
			}
		});
	}
}

function gt3_comment_label() {
	var $label = jQuery('#respond').find('#commentform p[class*="comment-form-"] > label');
	if ($label.length) {
        $label.each(function () {
			var _this_label = jQuery(this);
			_this_label.parent().find('input, textarea').on('focus', function () {
				_this_label.addClass('gt3_onfocus');
			}).on('blur', function () {
				if (jQuery(this).val() === "") {
					_this_label.removeClass('gt3_onfocus');
				} else {
					_this_label.addClass('gt3_onfocus');
				}
			});
		})
	}
}

function gt3_search_label() {
	var $form = jQuery('.gt3_search_form, .gt3_form, #mc_signup .mc_merge_var');
    if ($form.length) {
        $form.each(function () {
            var _elem = jQuery(this).find('input, textarea');
            if (_elem.val() !== "") {
                _elem.prev('label').addClass('gt3_onfocus');
            }
            _elem.on('focus', function () {
                jQuery(this).prev('label').addClass('gt3_onfocus');
            }).on('blur', function () {
                if (jQuery(this).val() === "") {
                    jQuery(this).prev('label').removeClass('gt3_onfocus');
                }
            });
        })
    }
}

function gt3_category_accordion () {
	var widget_product_categories = jQuery('.widget_product_categories');
	if (widget_product_categories.length) {
		widget_product_categories.each(function(){
			var $this = jQuery(this);
			var elements = $this.find('.product-categories>li.cat-parent');

			for (var i = 0; i < elements.length; i++) {
				if ( jQuery(elements[i]).hasClass('current-cat-parent') ) {
					jQuery(elements[i]).addClass('open').find('.current-cat').parent().slideDown();
				}
				jQuery(elements[i]).append("<span class=\"gt3-button-cat-open\"></span>");
			}
		});
		jQuery(".gt3-button-cat-open").on("click", function () {
			jQuery(this).parent().toggleClass('open');
			if (jQuery(this).parent().hasClass('open')) {
				jQuery(this).parent().children('.children').slideDown();
			} else {
				jQuery(this).parent().children('.children').slideUp();
			}
		})
	}
}

// func called from frontend
function gt3_clear_recently_products(el){
	document.cookie = 'gt3_product_recently_viewed=;path=/';
	jQuery(el).parent().fadeOut(400);
}

function woocommerce_triger_lightbox() {
    jQuery('.woocommerce-product-gallery .woocommerce-product-gallery__wrapper').on('click', function (e) {
        jQuery('.woocommerce-product-gallery .woocommerce-product-gallery__trigger').trigger( "click" );
        // e.preventDefault();
    });
}