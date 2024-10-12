"use strict";
var header = jQuery('.main_header'),
    footer = jQuery('.main_footer'),
    nav = jQuery('nav.main_nav'),
    menu = nav.find('ul.menu'),
    html = jQuery('html'),
    body = jQuery('body'),
    myWindow = jQuery(window),
    windowWidth = myWindow.outerWidth();

(function gt3_preloader() {
    setTimeout(function () {
        jQuery('#loading').fadeOut();
    }, 8000);
}());

jQuery(document).ready(function ($) {

    /* ol increment */
    $("ol[start]").each(function () {
        var val = 1;
        if (jQuery(this).attr("start")) {
            val = jQuery(this).attr("start");
        }
        val = val - 1;
        val = 'li ' + val;
        $(this).css('counter-increment', val);
    });
    gt3_search();
    gt3_mobile_menu();
    gt3_menu_line();
    gt3_sticky_header();
    gt3_burger_sidebar();
    gt3_modal_login();
    gt3_message_close();
    gt3_custom_price_button();
    gt3_back_to_top();
    gt3_mega_menu();
    gt3_video_play_button();
    init_slick_post_gallery();
    gt3_custom_color();
    gt3_initCounter();
    gt3_hide_label();

    if ($('.pp_block').size() > 0) {
        html.addClass('pp_page');
    }
    var gt3_js_bg_img = $('.gt3_js_bg_img');
    if (gt3_js_bg_img.size() > 0) {
        gt3_js_bg_img.each(function () {
            $(this).css('background-image', 'url(' + $(this).attr('data-src') + ')');
        });
    }
    var gt3_js_bg_color = $('.gt3_js_bg_color');
    if (gt3_js_bg_color.size() > 0) {
        gt3_js_bg_color.each(function () {
            $(this).css('background-color', $(this).attr('data-bgcolor'));
        });
    }
    var gt3_js_color = $('.gt3_js_color');
    if (gt3_js_color.size() > 0) {
        gt3_js_color.each(function () {
            $(this).css('color', $(this).attr('data-color'));
        });
    }
    var gt3_js_transition = $('.gt3_js_transition');
    if (gt3_js_transition.size() > 0) {
        gt3_js_transition.each(function () {
            var transition_time = $(this).attr('data-transition') + 'ms';
            $(this).css({'transition-duration': transition_time});
        });
    }

    //Flickr Widget
    if ($('.flickr_widget_wrapper').size() > 0) {
        $('.flickr_badge_image a').each(function () {
            $(this).append('<div class="flickr_fadder"></div>');
        });
    }

    //Blank Anchors
    $('a[href="#"]').on('click', function (e) {
        e.preventDefault();
    });

    // Gt3 Carousel List
    gt3_carousel_list();

    // GT3 Testimonials List
    gt3_testimonials_list();

    // Slick Slider Arrows
    gt3_slick_slider_arrows();
    var carousel_arrows_tag = $('.gt3_module_featured_posts .carousel_arrows');
    if (carousel_arrows_tag.length) {
        carousel_arrows_tag.each(function () {
            $(this).find('a.left_slick_arrow').on("click", function () {
                $(this).parents('.gt3_module_carousel').find('.slick-prev').click();
            });
            $(this).find('a.right_slick_arrow').on("click", function () {
                $(this).parents('.gt3_module_carousel').find('.slick-next').click();
            });
        });
    }

    if ($('.gt3-contact-widget').length) {
        $('.gt3-contact-widget_label').on('click', function () {
            $('.gt3-contact-widget').toggleClass('open');
        })
    }

    // GT3 Countdown
    gt3_countdown_module();

    // GT3 Flicker Widget
    gt3_flickr_widget();

    // GT3 Popup Video
    gt3_popup_video();

    gt3_includes_js();

    // GT3 Hotspot
    gt3_hotspot_marker_active();
});

function gt3_includes_js() {
    // GT3 Button
    var gt3_btn_customize = jQuery('.gt3_btn_customize');
    if (gt3_btn_customize.length) {
        gt3_btn_customize.each(function () {
            var this_btn = jQuery(this).find('a');
            var body_tag = jQuery('body');

            // Default Attributes
            var btn_default_bg = this_btn.attr('data-default-bg');
            var btn_default_color = this_btn.attr('data-default-color');
            var btn_default_border_color = this_btn.attr('data-default-border');
            var btn_default_icon = jQuery(this).find('.gt3_btn_icon').attr('data-default-icon');

            // Hover Attributes
            var btn_hover_bg = this_btn.attr('data-hover-bg');
            var btn_hover_color = this_btn.attr('data-hover-color');
            var btn_hover_border_color = this_btn.attr('data-hover-border');
            var btn_hover_icon = jQuery(this).find('.gt3_btn_icon').attr('data-hover-icon');

            // Theme Color
            var theme_color = body_tag.attr('data-theme-color');

            this_btn.mouseenter(function () {
                // Button Hover Bg
                if (typeof btn_hover_bg !== 'undefined') {
                    this_btn.css({'background-color': btn_hover_bg});
                } else {
                    this_btn.css({'background-color': '#ffffff'});
                }
                // Button Hover Text Color
                if (typeof btn_hover_color !== 'undefined') {
                    this_btn.css({'color': btn_hover_color});
                } else {
                    this_btn.css({'color': theme_color});
                }
                // Button Hover Border Color
                if (typeof btn_hover_border_color !== 'undefined') {
                    this_btn.css({'border-color': btn_hover_border_color});
                } else {
                    this_btn.css({'border-color': theme_color});
                }
                // Button Hover Icon Color
                if (typeof btn_hover_icon !== 'undefined') {
                    this_btn.find('.gt3_btn_icon').css({'color': btn_hover_icon});
                } else {
                    this_btn.find('.gt3_btn_icon').css({'color': '#ffffff'});
                }
            }).mouseleave(function () {
                // Button Default Bg
                if (typeof btn_default_bg !== 'undefined') {
                    this_btn.css({'background-color': btn_default_bg});
                } else {
                    this_btn.css({'background-color': theme_color});
                }
                // Button Default Text Color
                if (typeof btn_default_color !== 'undefined') {
                    this_btn.css({'color': btn_default_color});
                } else {
                    this_btn.css({'color': '#ffffff'});
                }
                // Button Default Border Color
                if (typeof btn_default_border_color !== 'undefined') {
                    this_btn.css({'border-color': btn_default_border_color});
                } else {
                    this_btn.css({'border-color': theme_color});
                }
                // Button Default Icon Color
                if (typeof btn_default_icon !== 'undefined') {
                    this_btn.find('.gt3_btn_icon').css({'color': btn_default_icon});
                } else {
                    this_btn.find('.gt3_btn_icon').css({'color': '#ffffff'});
                }
            });

        });
    }

    // GT3 Link Layer
    var gt3_hover_customize = jQuery('.gt3_hover_customize');
    if (gt3_hover_customize.length) {
        gt3_hover_customize.each(function () {
            var this_ = jQuery(this);
            var body_tag = jQuery('body');

            // Default Attributes
            var this_default_bg = this_.attr('data-default-bg');
            var this_default_color = this_.attr('data-default-color');
            var this_default_border_color = this_.attr('data-default-border');
            var this_default_icon = jQuery(this).find('.gt3_icon').attr('data-default-icon');

            // Hover Attributes
            var this_hover_bg = this_.attr('data-hover-bg');
            var this_hover_color = this_.attr('data-hover-color');
            var this_hover_border_color = this_.attr('data-hover-border');
            var this_hover_icon = jQuery(this).find('.gt3_icon').attr('data-hover-icon');

            // Theme Color
            var theme_color = body_tag.attr('data-theme-color');

            this_.mouseenter(function () {
                // Button Hover Bg
                if (typeof this_hover_bg !== 'undefined') {
                    this_.css({'background-color': this_hover_bg});
                } else {
                    // this_.css({'background-color': '#ffffff'});
                }
                // Button Hover Text Color
                if (typeof this_hover_color !== 'undefined') {
                    this_.css({'color': this_hover_color});
                } else {
                    // this_.css({'color': theme_color});
                }
                // Button Hover Border Color
                if (typeof this_hover_border_color !== 'undefined') {
                    this_.css({'border-color': this_hover_border_color});
                } else {
                    // this_.css({'border-color': theme_color});
                }
                // Button Hover Icon Color
                if (typeof this_hover_icon !== 'undefined') {
                    this_.find('.gt3_icon').css({'color': this_hover_icon});
                } else {
                    // this_.find('.gt3_icon').css({'color': '#ffffff'});
                }
            }).mouseleave(function () {
                // Button Default Bg
                if (typeof this_default_bg !== 'undefined') {
                    this_.css({'background-color': this_default_bg});
                } else {
                    // this_.css({'background-color': theme_color});
                }
                // Button Default Text Color
                if (typeof this_default_color !== 'undefined') {
                    this_.css({'color': this_default_color});
                } else {
                    // this_.css({'color': '#ffffff'});
                }
                // Button Default Border Color
                if (typeof this_default_border_color !== 'undefined') {
                    this_.css({'border-color': this_default_border_color});
                } else {
                    // this_.css({'border-color': theme_color});
                }
                // Button Default Icon Color
                if (typeof this_default_icon !== 'undefined') {
                    this_.find('.gt3_icon').css({'color': this_default_icon});
                } else {
                    // this_.find('.gt3_icon').css({'color': '#ffffff'});
                }
            });

        });
    }
}

function gt3_mega_menu() {
    jQuery('.gt3_header_builder > .gt3_header_builder__container .gt3_megamenu_active > .sub-menu, .gt3_header_builder > .sticky_header > .gt3_header_builder__container .gt3_megamenu_active > .sub-menu').each(function () {
        jQuery(this).find('.gt3_megamenu_triangle').css({
            'margin-left': '0px'
        });
        jQuery(this).css({
            'margin-left': '0px'
        });
        var elementWidth = jQuery(this).outerWidth();
        var windowWidth = jQuery(window).width();
        if (elementWidth > (windowWidth - 50) || jQuery(this).hasClass('huge_number_of_column')) {
            elementWidth = windowWidth - 50;
            jQuery(this).addClass('huge_number_of_column');
            var menu_item_width = jQuery(this).children('.menu-item').outerWidth();
            var namber_item_per_row = Math.floor(elementWidth / menu_item_width);
            var item_count = jQuery(this).children('.menu-item').length;
            var i = 1;
            var last_item_begin_from = (Math.floor(item_count / namber_item_per_row) * namber_item_per_row);
            jQuery(this).children('.menu-item').each(function () {
                i++;
                if (last_item_begin_from < i) {
                    jQuery(this).css('max-width', (menu_item_width - 70 /*padding value*/) + 'px');
                }

            })
        } else {
            jQuery(this).removeClass('huge_number_of_column');
        }
        var halfWidth = Math.round(elementWidth / 2);

        var leftOffset = jQuery(this).offset().left - halfWidth;
        var rightOffset = windowWidth - (leftOffset + elementWidth);
        if (rightOffset < 25) {
            halfWidth = halfWidth + 25 - rightOffset;
        }
        if (leftOffset < 25) {
            halfWidth = halfWidth - 25 + leftOffset;
        }
        jQuery(this).find('.gt3_megamenu_triangle').css({
            'margin-left': (halfWidth - 34) + 'px'
        });
        jQuery(this).css({
            'margin-left': -halfWidth + 'px'
        });
    })
}

jQuery(window).resize(function () {
    if (jQuery(window).width() >= 1200) {
        gt3_mega_menu();
    }
});

function gt3_popup_video() {
    var swipebox = jQuery('.swipebox-video, .swipebox');
    if (swipebox.length) {
        swipebox.swipebox({
            useCSS: true, // false will force the use of jQuery for animations
            useSVG: true, // false to force the use of png for buttons
            initialIndexOnArray: 0, // which image index to init when a array is passed
            hideCloseButtonOnMobile: false, // true will hide the close button on mobile devices
            removeBarsOnMobile: true, // false will show top bar on mobile devices
            hideBarsDelay: 3000, // delay before hiding bars on desktop
            videoMaxWidth: 1140,
            autoplayVideos: false,
            beforeOpen: function () {}, // called before opening
            afterOpen: null, // called after opening
            afterClose: function () {}, // called after closing
            loopAtEnd: false // true will return to the first image after the last image is reached
        });
    }
}

function gt3_back_to_top() {
    var W_height = jQuery(window).height();
    var element = jQuery('#back_to_top');
    if (element.length) {
        element.click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
        var show_back_to_top = function () {
            if (jQuery(document).scrollTop() < W_height) {
                element.removeClass('show');
            } else {
                element.addClass('show');
            }
        };
        show_back_to_top();
        jQuery(window).scroll(function () {
            show_back_to_top();
        });
    }
}

// menu line
function gt3_menu_line() {
    var menu = jQuery('.main-menu.main_menu_container.menu_line_enable > ul');
    if (menu.length) {
        menu.each(function () {
            var menu = jQuery(this);
            var current = '';
            menu.append('<span class="menu_item_line"></span>');
            var menu_item = menu.find('> .menu-item');
            var currentItem = menu.find('> .current-menu-item');
            var currentItemParent = menu.find('> .current-menu-ancestor');
            var line = menu.find('.menu_item_line');
            if (currentItem.length || currentItemParent.length) {
                current = currentItem.length ? currentItem : (currentItemParent.length ? currentItemParent : '');
                line.css({width: current.find('>a').outerWidth()});
                line.css({left: current.find('>a').offset().left - menu.offset().left});
            }

            menu_item.mouseenter(function () {
                line.css({width: jQuery(this).find('> a').outerWidth()});
                line.css({left: jQuery(this).find('> a').offset().left - jQuery(this).parent().offset().left});
            });

            menu.mouseleave(function () {
                if (current.length) {
                    line.css({width: current.find('> a').outerWidth()});
                    line.css({left: current.find('> a').offset().left - menu.offset().left});
                } else {
                    line.css({width: '0'});
                    line.css({left: '100%'});
                }
            });


        })
    }
}

function gt3_sticky_header() {
    var stickyHeader = jQuery('.gt3_header_builder > .sticky_header');
    if (jQuery(window).width() > 1200 || stickyHeader.hasClass('header_sticky_mobile')) {
        var stickyNumber = jQuery('.gt3_header_builder').height();
        var docScroll = jQuery(document).scrollTop();
        var docScrollNext = jQuery(document).scrollTop();
        if (stickyHeader.length) {
            var stickyType = stickyHeader.attr('data-sticky-type');
            if (stickyHeader[0].hasAttribute('data-sticky-number')) {
                stickyNumber = stickyHeader.attr('data-sticky-number');
            }
            var stickyOn = function () {
                docScroll = jQuery(document).scrollTop();
                if (stickyType === 'classic') {
                    if (docScroll < stickyNumber) {
                        stickyHeader.removeClass('sticky_on')
                    } else {
                        stickyHeader.addClass('sticky_on')
                    }
                } else {
                    if ((docScrollNext < docScroll) || (docScroll < stickyNumber)) {
                        stickyHeader.removeClass('sticky_on')
                    } else {
                        stickyHeader.addClass('sticky_on')
                    }
                }
                docScrollNext = jQuery(document).scrollTop();

            };
            stickyOn();
            jQuery(window).scroll(function () {
                stickyOn();
            });

            if (windowWidth <= 768 && document.body.classList.contains('admin-bar') ) {
                jQuery('.mobile_menu_container').css({'top': stickyHeader.height() + 46});
            }else if(windowWidth > 768 && document.body.classList.contains('admin-bar')){
                jQuery('.mobile_menu_container').css({'top': stickyHeader.height() + 30});
            }else{
                jQuery('.mobile_menu_container').css({'top': +stickyHeader.height()});
            }
        }
    }
}

// mobile menu
function gt3_mobile_menu() {
    var windowW = jQuery(window);
    var loaded = false;
    var main_menu = jQuery('.mobile_menu_container .main-menu > ul');
    var sub_menu = jQuery('.mobile_menu_container .main-menu > ul ul');
    var mobile_toggle = jQuery('.mobile-navigation-toggle');
    if (windowW.width() <= 1200) {
        sub_menu.hide().removeClass('showsub');
        main_menu.hide().addClass('mobile_view_on');
        loaded = true;
        gt3_mobile_menu_switcher(main_menu)
    } else {
        sub_menu.show();
        main_menu.show();
    }

    jQuery(window).resize(function () {
        if (windowW.width() <= 1200) {
            if (!mobile_toggle.hasClass('is-active')) {
                sub_menu.hide().removeClass('showsub');
                main_menu.hide().removeClass('showsub').addClass('mobile_view_on');
                mobile_toggle.removeClass('is-active')
            }
            if (loaded === false) {
                loaded = true;
                gt3_mobile_menu_switcher(main_menu)
            }
        } else {
            sub_menu.show().removeClass('showsub');
            main_menu.show().removeClass('showsub').removeClass('mobile_view_on');
            mobile_toggle.removeClass('is-active')
        }
    });
}

// end mobile menu

function gt3_mobile_menu_switcher(main_menu){
    if (jQuery(main_menu).find('.menu-item-has-children > .mobile_sitcher').length == 0) {
        jQuery(main_menu).find('.menu-item-has-children').append('<div class="mobile_sitcher"></div>')
    }
    var timeStamp = 1;
    jQuery('.mobile-navigation-toggle').on("tap click", function(event) {
        if ((event.timeStamp - timeStamp) > 100) {
            timeStamp = event.timeStamp;
            var element = jQuery(this);
            if (element.hasClass('is-active')) {
                main_menu.removeClass('showsub').slideUp(200)
                element.removeClass('is-active')
            }else{
                main_menu.addClass('showsub').slideDown(200)
                element.addClass('is-active')
            }
        }
    });

    jQuery(main_menu).find('.menu-item-has-children > .mobile_sitcher , .menu-item-has-children > a[href*=#]').on("tap click", function(e) {
        e.preventDefault();
        var element = jQuery(this);
        if ((event.timeStamp - timeStamp) > 100) {
            timeStamp = e.timeStamp;
            if (element.hasClass('is-active')) {
                element.prev('ul.sub-menu').removeClass('showsub').slideUp(200)
                element.next('ul.sub-menu').removeClass('showsub').slideUp(200)
                element.removeClass('is-active')
            }else{
                element.prev('ul.sub-menu').addClass('showsub').slideDown(200)
                element.next('ul.sub-menu').addClass('showsub').slideDown(200)
                element.addClass('is-active')
            }
        }
    });
}

function gt3_burger_sidebar() {
    var element = jQuery('.gt3_header_builder_burger_sidebar_component');
    var sidebar = jQuery('.gt3_header_builder__burger_sidebar');
    jQuery('.gt3_header_builder_burger_sidebar_component,.gt3_header_builder__burger_sidebar-cover').on('click', function () {
        if (element.hasClass('active')) {
            element.removeClass('active');
            sidebar.removeClass('active');
            jQuery('body').removeClass('active_burger_sidebar');
        } else {
            element.addClass('active');
            sidebar.addClass('active');
            jQuery('body').addClass('active_burger_sidebar');
        }
    });
    jQuery(sidebar).on('swiperight', function () {
        if (element.hasClass('active')) {
            element.removeClass('active');
            sidebar.removeClass('active');
            jQuery('body').removeClass('active_burger_sidebar');
        } else {
            element.addClass('active');
            sidebar.addClass('active');
            jQuery('body').addClass('active_burger_sidebar');
        }
    });
}

function gt3_modal_login() {
    var element = jQuery('.gt3_header_builder__login-modal');
    jQuery('.gt3_header_builder_login_component,.gt3_header_builder__login-modal-close,.gt3_header_builder__login-modal-cover').on('click', function () {
        if (element.hasClass('active')) {
            element.removeClass('active');
        } else {
            element.addClass('active');
        }
    })
}

function gt3_search() {
    var top_search = jQuery('.header_search');

    if (top_search.size() > 0) {
        top_search.each(function () {

            var $ctsearch = jQuery(this),
                $ctsearchinput = $ctsearch.find('input.search_text'),
                $body = jQuery('html, body'),
                openSearch = function () {
                    $ctsearch.data('open', true).addClass('ct-search-open');
                    $ctsearchinput.focus();
                    return false;
                },
                closeSearch = function () {
                    $ctsearch.data('open', false).removeClass('ct-search-open');
                };

            $ctsearchinput.on('click', function (e) {
                e.stopPropagation();
                $ctsearch.data('open', true);
            });

            $ctsearch.on('click', function (e) {
                e.stopPropagation();
                if (!$ctsearch.data('open')) {
                    openSearch();
                    $body.on('click', function () {
                        closeSearch();
                    });
                } else {
                    if ($ctsearchinput.val() === '') {
                        closeSearch();
                        return false;
                    }
                }
            });

            top_search.on('click', function () {
                var element = jQuery(this);
                if (element.hasClass('ct-search-hover')) {
                    element.removeClass('ct-search-hover');
                } else {
                    element.addClass('ct-search-hover');
                    setTimeout(function () {
                        element.find('input.search_text').focus();
                    }, 100);
                }
            })

        });
    }

    jQuery('.search_form .search_submit').on({
        mouseenter: function () {
            jQuery(this).parents('.search_form').addClass("button-hover");
        },
        mouseleave: function () {
            jQuery(this).parents('.search_form').removeClass("button-hover");
        }
    });
}

function gt3_message_close() {
    jQuery(".gt3_message_box-closable").each(function () {
        var element = jQuery(this);
        element.find('.gt3_message_box__close').on('click', function () {
            element.slideUp(300);
        })
    })
}

jQuery(window).resize(function () {
    // Slick Slider Arrows
    gt3_slick_slider_arrows();
    // Blog Isotope reLayout
    gt3_blog_isotope_update_js();
});

jQuery(window).load(function () {
    gt3_practice_isotope();
    gt3_team_isotope();
    gt3_case_isotope();
    gt3_practice_load_more_init();
    gt3_team_load_more_init();
    gt3_case_load_more_init();

    // Blog Isotope reLayout
    /*gt3_blog_isotope_update_js ();*/
    gt3_blog_isotope_js();
    jQuery('#loading').fadeOut();
});

// Slick Slider Arrows
function gt3_slick_slider_arrows() {
    var carousel_arrows_tag = jQuery('.gt3_module_featured_posts .carousel_arrows');
    if (carousel_arrows_tag.length) {
        carousel_arrows_tag.each(function () {
            if (jQuery(this).parents('.gt3_module_carousel').find('.slick-arrow').length) {
                jQuery(this).removeClass('hidden_block');
            } else {
                jQuery(this).addClass('hidden_block');
            }
        });
    }
}

// -------------------- //
// --- GT3 COMPOSER --- //
// -------------------- //

// GT3 Counter
function gt3_initCounter() {
    var gt3_module_counter = jQuery('.gt3_module_counter');
    if ((gt3_module_counter).length) {
        if (jQuery(window).width() > 760) {
            var waypoint = new Waypoint({
                element: document.getElementsByClassName('gt3_module_counter'),
                handler: function (direction) {},
                offset: 'bottom-in-view'
            });
            waypoint.context.refresh();

            gt3_module_counter.each(function () {
                var cur_this = jQuery(this);
                var stat_count = cur_this.find('.stat_count'),
                set_count = stat_count.attr('data-value'),
                counter_suffix = stat_count.attr('data-suffix'),
                counter_prefix = stat_count.attr('data-prefix'),
                thousands_separator = stat_count.attr('data-thousands_separator'),
                thousands_separator_text = stat_count.attr('data-thousands_separator_text'),
                counter_decimal = stat_count.attr('data-counter_decimal');
                if (thousands_separator !== 'yes') {
                    thousands_separator_text = '';
                }
                if (jQuery(this).offset().top < jQuery(window).height()) {
                    if (!jQuery(this).hasClass('done')) {
                        jQuery(this).find('.stat_temp').stop().animate({width: set_count}, {
                            duration: 3000,
                            step: function (now) {
                                var data = parseFloat(now).toFixed(counter_decimal);
                                data = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, thousands_separator_text);
                                stat_count.text(counter_prefix + data + counter_suffix);
                            }
                        });
                        jQuery(this).addClass('done');
                    }
                } else {
                    jQuery(this).waypoint(function () {
                        if (!cur_this.hasClass('done')) {
                            cur_this.find('.stat_temp').stop().animate({width: set_count}, {
                                duration: 3000,
                                step: function (now) {
                                    var data = parseFloat(now).toFixed(counter_decimal);
                                    data = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, thousands_separator_text);
                                    stat_count.text(counter_prefix + data + counter_suffix);
                                }
                            });
                            cur_this.addClass('done');
                        }
                    }, {offset: 'bottom-in-view'});
                }
            });
        } else {
            gt3_module_counter.each(function () {
                var stat_count = jQuery(this).find('.stat_count'),
                    set_count = stat_count.attr('data-value'),
                    counter_suffix = stat_count.attr('data-suffix'),
                    counter_prefix = stat_count.attr('data-prefix'),
                    thousands_separator = stat_count.attr('data-thousands_separator'),
                    thousands_separator_text = stat_count.attr('data-thousands_separator_text'),
                    counter_decimal = stat_count.attr('data-counter_decimal');
                if (thousands_separator !== 'yes') {
                    thousands_separator_text = '';
                }
                jQuery(this).find('.stat_temp').stop().animate({width: set_count}, {
                    duration: 3000,
                    step: function (now) {
                        var data = parseFloat(now).toFixed(counter_decimal);
                        data = data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, thousands_separator_text);
                        stat_count.text(counter_prefix + data + counter_suffix);
                    }
                });
            }, {offset: 'bottom-in-view'});
        }
    }
}

// team
function gt3_team_isotope(){
    jQuery('.gt3_team_list__posts-container').each(function(){
        var element = jQuery(this);
        var element_item = element.find('.gt3_team_list__item');
        // var layoutMode = element.hasClass('isotope_packery') ? 'masonry' : 'fitRows';
        var count = 1;

        element_item.on('mouseenter', function(){
            count ++;
            jQuery(this).css({'z-index':count});
        });

        element.find('.gt3_team_list__item:not(.image_loaded)').each(function(){
            element_item = jQuery(this);
            element_item.find('img').imagesLoaded().always(function(instance ){
                jQuery(instance.elements).parents('.gt3_team_list__item').addClass('image_loaded');
            })
        });

        element.isotope({
            itemSelector: '.gt3_team_list__item',
            percentPosition: true,
            masonry: {
                columnWidth: '.gt3_team_list__grid-sizer',
                gutter: '.gt3_team_list__grid-gutter'
            }
        });

        element.imagesLoaded(function(){
            element.isotope({
                itemSelector: '.gt3_team_list__item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.gt3_team_list__grid-sizer',
                    gutter: '.gt3_team_list__grid-gutter'
                }
            });
        });

        element.parent('.gt3_team_list').find(".gt3_team_list__filter.isotope-filter a").on( 'click', function(){
            var filter_item = jQuery(this);
            filter_item.siblings().removeClass('active');
            filter_item.addClass("active");
            var selector = filter_item.attr('data-filter');
            element.isotope({
                filter: selector
            });
            return false;
        });
    })
}

function gt3_team_load_more_init (){
    var gt3_team_list = jQuery('.gt3_team_list');
    if (gt3_team_list.length) {
        gt3_team_list.each(function(){
            var element = jQuery(this);
            var loadMoreButton = element.find('.gt3_team_load_more');
            var teamContainer = element.find('.gt3_team_list__posts-container');
            var nextPage = 2;
            var max_num_pages = 3;
            if (typeof teamContainer.data('max_num_pages') !== 'undefined' && teamContainer.data('max_num_pages') !== false) {
                max_num_pages = teamContainer.data('max_num_pages');
            }

            loadMoreButton.on('click', function (e) {
                loadMoreButton.addClass('loading');
                e.preventDefault();
                e.stopPropagation();
                if (nextPage <= max_num_pages) {
                    var ajaxData = {
                        action: 'gt3_get_team_item_from_ajax',
                        build_query: teamContainer.attr('data-build_query'),
                        team_style: teamContainer.attr('data-team_style'),
                        posts_per_line: teamContainer.attr('data-posts_per_line'),
                        items_load: teamContainer.attr('data-items_load'),
                        post_count: teamContainer.attr('data-post_count')
                    };
                    ajaxData['next_page'] = nextPage;
                    jQuery.ajax({
                        type: 'POST',
                        data: ajaxData,
                        url: gt3_oconnor.ajaxurl,
                        success: function (data) {
                            loadMoreButton.removeClass('loading');
                            if (data !== '') {
                                var response = jQuery.parseJSON(data);
                                var responseHtml = response.html;
                                var img_loader = imagesLoaded( teamContainer );
                                img_loader.on( "always", function (){
                                    setTimeout(function() {
                                        teamContainer
                                            .append( jQuery(responseHtml) )
                                            .isotope( 'appended', jQuery(responseHtml) )
                                            .isotope('reloadItems');
                                        teamContainer.find('.gt3_team_list__item:not(.image_loaded)').each(function(){
                                            jQuery(this).imagesLoaded().always(function(instance ){
                                                jQuery(instance.elements).addClass('image_loaded');
                                            })
                                        });
                                        setTimeout(function(){
                                            teamContainer.isotope({sortby: 'original-order'});
                                        },100)
                                    },200);
                                });
                                if (Number(response.items_left) <= '0') {
                                    loadMoreButton.hide(300);
                                }
                                teamContainer.attr('data-post_count',Number(ajaxData.post_count) + Number(ajaxData.items_load));
                            }
                        }
                    });
                }
            })
        })
    }
}

// Practice
function gt3_practice_isotope() {
    jQuery('.gt3_practice_list__posts-container').each(function () {
        var element = jQuery(this);
        var element_item = element.find('.gt3_practice_list__item');
        var layoutMode = element.attr('data-practice_layout') === 'grid' ? 'fitRows' : 'masonry';
        var count = 1;

        element_item.on('mouseenter', function(){
            count ++;
            jQuery(this).css({'z-index':count});
        });

        element.find('.gt3_practice_list__item:not(.image_loaded)').each(function () {
            element_item = jQuery(this);
            element_item.find('img').imagesLoaded().always(function (instance) {
                jQuery(instance.elements).parents('.gt3_practice_list__item').addClass('image_loaded');
            })
        });

        element.isotope({
            itemSelector: '.gt3_practice_list__item',
            percentPosition: true,
            layoutMode: layoutMode,
            masonry: {
                columnWidth: '.gt3_practice_list__grid-sizer',
                // columnWidth: Math.floor(element.outerWidth(true)/4),
                gutter: '.gt3_practice_list__grid-gutter'
            }
        });

        element.imagesLoaded(function () {
            element.isotope({
                itemSelector: '.gt3_practice_list__item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.gt3_practice_list__grid-sizer',
                    // columnWidth: Math.floor(element.outerWidth(true)/4),
                    gutter: '.gt3_practice_list__grid-gutter'
                }
            });
        });

        element.parent('.gt3_practice_list').find(".gt3_practice_list__filter.isotope-filter a").on('click', function () {
            var filter_item = jQuery(this);
            filter_item.siblings().removeClass('active');
            filter_item.addClass("active");
            var selector = filter_item.attr('data-filter');
            element.isotope({
                filter: selector
            });
            return false;
        });

    })
}

function gt3_practice_load_more_init() {
    var gt3_practice_list = jQuery('.gt3_practice_list');
    if (gt3_practice_list.length) {
        gt3_practice_list.each(function () {
            var element = jQuery(this);
            var loadMoreButton = element.find('.gt3_practice_load_more');
            var practiceContainer = element.find('.gt3_practice_list__posts-container');
            var nextPage = 2;
            var max_num_pages = 3;
            if (typeof practiceContainer.data('max_num_pages') !== 'undefined' && practiceContainer.data('max_num_pages') !== false) {
                max_num_pages = practiceContainer.data('max_num_pages');
            }

            loadMoreButton.on('click', function (e) {
                loadMoreButton.addClass('loading');
                e.preventDefault();
                e.stopPropagation();
                if (nextPage <= max_num_pages) {
                    var ajaxData = {
                        action: 'gt3_get_practice_item_from_ajax',
                        build_query: practiceContainer.attr('data-build_query'),
                        practice_style: practiceContainer.attr('data-practice_style'),
                        practice_layout: practiceContainer.attr('data-practice_layout'),
                        columns_with_spaces: practiceContainer.attr('data-columns_with_spaces'),
                        rounded_images: practiceContainer.attr('data-rounded_images'),
                        posts_per_line: practiceContainer.attr('data-posts_per_line'),
                        image_proportional: practiceContainer.attr('data-image_proportional'),
                        items_load: practiceContainer.attr('data-items_load'),
                        post_count: practiceContainer.attr('data-post_count')
                    };
                    ajaxData['next_page'] = nextPage;
                    jQuery.ajax({
                        type: 'POST',
                        data: ajaxData,
                        url: gt3_oconnor.ajaxurl,
                        success: function (data) {
                            loadMoreButton.removeClass('loading');
                            if (data !== '') {
                                var response = jQuery.parseJSON(data);
                                var responseHtml = response.html;
                                var img_loader = imagesLoaded(practiceContainer);
                                img_loader.on("always", function () {
                                    setTimeout(function () {
                                        practiceContainer
                                            .append(jQuery(responseHtml))
                                            .isotope('appended', jQuery(responseHtml))
                                            .isotope('reloadItems');
                                        practiceContainer.find('.gt3_practice_list__item:not(.image_loaded)').each(function () {
                                            jQuery(this).imagesLoaded().always(function (instance) {
                                                jQuery(instance.elements).addClass('image_loaded');
                                            })
                                        });
                                        setTimeout(function () {
                                            practiceContainer.isotope({sortby: 'original-order'});
                                        }, 100)
                                    }, 200);
                                });
                                if (Number(response.items_left) <= '0') {
                                    loadMoreButton.hide(300);
                                }
                                practiceContainer.attr('data-post_count', Number(ajaxData.post_count) + Number(ajaxData.items_load));
                            }
                        }
                    });
                }
            })
        })
    }
}

// case
function gt3_case_isotope(){
    jQuery('.gt3_case_list__posts-container').each(function(){
        var element = jQuery(this);
        var element_item = element.find('.gt3_case_list__item');
        // var layoutMode = element.hasClass('isotope_packery') ? 'masonry' : 'fitRows';
        var count = 1;

        element_item.on('mouseenter', function(){
            count ++;
            jQuery(this).css({'z-index':count});
        });

        element.find('.gt3_case_list__item:not(.image_loaded)').each(function(){
            element_item = jQuery(this);
            element_item.find('img').imagesLoaded().always(function(instance ){
                jQuery(instance.elements).parents('.gt3_case_list__item').addClass('image_loaded');
            })
        });

        element.isotope({
            itemSelector: '.gt3_case_list__item',
            percentPosition: true,
            masonry: {
                columnWidth: '.gt3_case_list__grid-sizer',
                gutter: '.gt3_case_list__grid-gutter'
            }
        });

        element.imagesLoaded(function(){
            element.isotope({
                itemSelector: '.gt3_case_list__item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.gt3_case_list__grid-sizer',
                    gutter: '.gt3_case_list__grid-gutter'
                }
            });
        });

        element.parent('.gt3_case_list').find(".gt3_case_list__filter.isotope-filter a").on( 'click', function(){
            var filter_item = jQuery(this);
            filter_item.siblings().removeClass('active');
            filter_item.addClass("active");
            var selector = filter_item.attr('data-filter');
            element.isotope({
                filter: selector
            });
            return false;
        });
    })
}

function gt3_case_load_more_init (){
    var gt3_case_list = jQuery('.gt3_case_list');
    if (gt3_case_list.length) {
        gt3_case_list.each(function(){
            var element = jQuery(this);
            var loadMoreButton = element.find('.gt3_case_load_more');
            var caseContainer = element.find('.gt3_case_list__posts-container');
            var nextPage = 2;
            var max_num_pages = 3;
            if (typeof caseContainer.data('max_num_pages') !== 'undefined' && caseContainer.data('max_num_pages') !== false) {
                max_num_pages = caseContainer.data('max_num_pages');
            }

            loadMoreButton.on('click', function (e) {
                if (!caseContainer.hasClass('dsb_img_placeholder')) caseContainer.addClass('dsb_img_placeholder');
                loadMoreButton.addClass('loading');
                e.preventDefault();
                e.stopPropagation();
                if (nextPage <= max_num_pages) {
                    var ajaxData = {
                        action: 'gt3_get_case_item_from_ajax',
                        build_query: caseContainer.attr('data-build_query'),
                        case_style: caseContainer.attr('data-case_style'),
                        posts_per_line: caseContainer.attr('data-posts_per_line'),
                        items_load: caseContainer.attr('data-items_load'),
                        post_count: caseContainer.attr('data-post_count')
                    };
                    ajaxData['next_page'] = nextPage;
                    jQuery.ajax({
                        type: 'POST',
                        data: ajaxData,
                        url: gt3_oconnor.ajaxurl,
                        success: function (data) {
                            loadMoreButton.removeClass('loading');
                            if (data !== '') {
                                var response = jQuery.parseJSON(data);
                                var responseHtml = response.html;
                                var add = jQuery(responseHtml);
                                caseContainer.append(add);
                                caseContainer.imagesLoaded(function () {
                                    caseContainer.isotope('appended', add).isotope({sortby: 'original-order'}).isotope('reloadItems');
                                    setTimeout(function () {
                                        caseContainer.find('.gt3_case_list__item:not(.image_loaded)').addClass('image_loaded');
                                    }, 100);
                                });
                                if (Number(response.items_left) <= '0') {
                                    loadMoreButton.hide(300);
                                }
                                caseContainer.attr('data-post_count', Number(ajaxData.post_count) + Number(ajaxData.items_load));
                            }
                        }
                    });
                }
            })
        })
    }
}

function gt3_custom_price_button() {
    jQuery(".shortcode_button").each(function () {
        var _this = jQuery(this);
        if (_this.attr('data-btn-color')) {
            var curent_color = _this.attr('data-btn-color');
            this.style.borderColor = curent_color;
            this.style.backgroundColor = curent_color;
            this.style.color = "#ffffff";
            _this.on({
                mouseenter: function () {
                    /*this.style.backgroundColor = "#ffffff";
                    this.style.color = curent_color;*/
                    _this.style.backgroundColor = "#ffffff";
                    _this.style.color = curent_color;
                },
                mouseleave: function () {
                    /*this.style.backgroundColor = curent_color;
                    this.style.color = "#ffffff";*/
                    _this.style.backgroundColor = curent_color;
                    _this.style.color = "#ffffff";
                }
            })
        }
    });

    jQuery(".shortcode_button.alt").each(function () {
        var _this = jQuery(this);
        if (_this.attr('data-btn-color')) {
            var curent_color = _this.attr('data-btn-color');
            this.style.borderColor = curent_color;
            this.style.backgroundColor = "#ffffff";
            this.style.color = curent_color;
            _this.on({
                mouseenter: function () {
                    /*this.style.backgroundColor = curent_color;
                    this.style.color = "#ffffff";*/
                    _this.style.backgroundColor = curent_color;
                    _this.style.color = "#ffffff";
                },
                mouseleave: function () {
                    /*this.style.backgroundColor = "#ffffff";
                    this.style.color = curent_color;*/
                    _this.style.backgroundColor = "#ffffff";
                    _this.style.color = curent_color;
                }
            })
        }
    })
}

// Blog Isotope
function gt3_blog_isotope_js() {
    var isotope_blog_items = jQuery('.isotope_blog_items');
    if ((isotope_blog_items).length) {
        isotope_blog_items.isotope({
            itemSelector: '.element'
        });
    }
}

// Blog Isotope reLayout
function gt3_blog_isotope_update_js() {
    var isotope_blog_items = jQuery('.isotope_blog_items');
    if ((isotope_blog_items).length) {
        isotope_blog_items.isotope('layout');
    }
}

// Gt3 Carousel List
function gt3_carousel_list() {
    var carousel_tag = jQuery('.gt3_carousel_list');
    if (carousel_tag.length) {
        carousel_tag.each(function () {
            jQuery(this).slick();
        });
    }
}

// Gt3 Testimonials
function gt3_testimonials_list() {
    var module_testimonial_type4 = jQuery('.module_testimonial.type4');
    if ((module_testimonial_type4).length) {
        module_testimonial_type4.each(function () {
            var cur_img = jQuery(this).find('.testimonials_photo');
            var wrapper_img = '';
            for (var i = 0; i < cur_img.length; i++) {
                wrapper_img += cur_img[i].outerHTML;
            }
            jQuery(this).find('.testimonials-photo-wrapper').append(wrapper_img);
        })
    }
    var module_testimonial_active_carousel = jQuery('.module_testimonial.active-carousel');
    if ((module_testimonial_active_carousel).length) {
        module_testimonial_active_carousel.each(function () {
            var cur_slidesToShow = jQuery(this).attr('data-slides-per-line') * 1;
            var cur_sliderAutoplay = jQuery(this).attr('data-autoplay-time') * 1;
            var cur_fade = jQuery(this).attr('data-slider-fade') === 1;
            var rotator = jQuery(this).find('.testimonials_rotator');
            var photo_wrapper = jQuery(this).find('.testimonials-photo-wrapper');
            jQuery(this).find('.testimonials_rotator').slick({
                slidesToShow: cur_slidesToShow,
                slidesToScroll: cur_slidesToShow,
                autoplay: true,
                autoplaySpeed: cur_sliderAutoplay,
                speed: 500,
                dots: true,
                fade: cur_fade,
                focusOnSelect: true,
                arrows: false,
                infinite: true,
                asNavFor: photo_wrapper,
                responsive: [
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            var centerMode = false;
            if (jQuery(this).hasClass('testimonials_align_center')) {
                centerMode = true;
            }
            jQuery(this).find('.testimonials-photo-wrapper').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: rotator,
                dots: false,
                centerMode: centerMode,
                focusOnSelect: true
            })
        });
    }
}

// GT3 Countdown
function gt3_countdown_module() {
    var countdown = jQuery('.gt3-countdown');
    if ((countdown).length) {
        countdown.each(function () {
            var year = jQuery(this).attr('data-year');
            var month = jQuery(this).attr('data-month');
            var day = jQuery(this).attr('data-day');
            var hours = jQuery(this).attr('data-hours');
            var min = jQuery(this).attr('data-min');
            var format = jQuery(this).attr('data-format');

            var austDay = new Date(+year, +month - 1, +day, +hours, +min);
            jQuery(this).countdown({
                until: austDay,
                format: format,
                padZeroes: true,
                labels: [jQuery(this).attr('data-label_years'), jQuery(this).attr('data-label_months'), jQuery(this).attr('data-label_weeks'), jQuery(this).attr('data-label_days'), jQuery(this).attr('data-label_hours'), jQuery(this).attr('data-label_minutes'), jQuery(this).attr('data-label_seconds')],
                labels1: [jQuery(this).attr('data-label_year'), jQuery(this).attr('data-label_month'), jQuery(this).attr('data-label_week'), jQuery(this).attr('data-label_day'), jQuery(this).attr('data-label_hour'), jQuery(this).attr('data-label_minute'), jQuery(this).attr('data-label_second')]
            });
        });
    }
}

// GT3 Flicker Widget
function gt3_flickr_widget() {
    var flickr_widget_wrapper = jQuery('.flickr_widget_wrapper');
    if ((flickr_widget_wrapper).length) {
        flickr_widget_wrapper.each(function () {
            var flickrid = jQuery(this).attr('data-flickrid');
            var widget_id = jQuery(this).attr('data-widget_id');
            var widget_number = jQuery(this).attr('data-widget_number');
            jQuery(this).addClass('flickr_widget_wrapper_' + flickrid);

            jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + widget_id + "&lang=en-us&format=json&jsoncallback=?", function (data) {
                jQuery.each(data.items, function (i, item) {
                    if (i < widget_number) {
                        jQuery("<img/>").attr("src", item.media.m).appendTo(".flickr_widget_wrapper_" + flickrid).wrap("<div class=\'flickr_badge_image\'><a href=\'" + item.link + "\' target=\'_blank\' title=\'Flickr\'></a></div>");
                    }
                });
            });
        });
    }
}

// Post Likes
jQuery(document).on("click", ".post_likes_add", function () {
    var post_likes_this = jQuery(this);
    if (!jQuery.cookie(post_likes_this.attr('data-modify') + post_likes_this.attr('data-postid'))) {
        jQuery.post(gt3_oconnor.ajaxurl, {
            action: 'add_like_attachment',
            attach_id: jQuery(this).attr('data-postid')
        }, function (response) {
            jQuery.cookie(post_likes_this.attr('data-modify') + post_likes_this.attr('data-postid'), 'true', {
                expires: 7,
                path: '/'
            });
            post_likes_this.addClass('already_liked');
            post_likes_this.find('span.like_count').text(response);
        });
    }
});

function gt3_hotspot_marker_active() {
    var $marker_wrap = jQuery('.gt3_marker_wrapper'),
        count = 1;

    if (windowWidth > 760) {

        jQuery('.gt3-hotspot-shortcode-wrapper').each(function () {
            var $self = $marker_wrap.first(),
                $self_half_width = Math.round($self.width() / 2),
                $self_half_height = Math.round($self.height() / 2);
            jQuery(this).find('.gt3_marker_wrapper').css('transform', 'translate3d(-' + $self_half_width + 'px, -' + $self_half_height + 'px, 0px)');
        });

        var $marker_click = jQuery('.hotspot_action-click .gt3_marker'),
            $marker_hover = jQuery('.hotspot_action-hover .gt3_marker'),
            $marker_visible = jQuery('.hotspot_action-visible .gt3_marker');

        $marker_click.on('click', function () {
            gt3_tooltip_offset(jQuery(this), count);
        });

        $marker_hover.on('hover', function () {
            gt3_tooltip_offset(jQuery(this), count);
        });

        $marker_visible.on('click', function () {
            gt3_tooltip_offset(jQuery(this), count);
        });
        $marker_visible.trigger('click');

        jQuery(document).keyup(function (e) {
            if (e.keyCode === 27) $marker_wrap.removeClass('active');
        });
    } else {
        var $marker = jQuery('.gt3_marker');
        $marker.on('click', function () {
            count++;
            jQuery(this).parent().toggleClass('active').css({'z-index': count});
        })
    }
    jQuery('.gt3_marker_wrapper .gt3-close').on('click', function (e) {
        e.preventDefault();
        jQuery(this).closest('.gt3_marker_wrapper').removeClass('active');
    });
    jQuery(document).on('mouseup', function (e) {
        e.preventDefault();
        if ($marker_wrap.has(e.target).length === 0) {
            jQuery('.gt3-hotspot-image-cover:not(.hotspot_action-visible) .gt3_marker_wrapper').removeClass('active');
        }
    });
}

function gt3_tooltip_offset(click_hover, count) {
    /* GT3 Tooltip Offset */
    var tooltip = jQuery(click_hover).parent().find('.gt3_tooltip'),
        selfWidth = tooltip.outerWidth(),
        selfOffset = tooltip.offset();

    if (selfOffset.left <= 0 && selfOffset.left + selfWidth > windowWidth) {
        tooltip.removeClass('gt3-hotspot-offset-left gt3-hotspot-offset-right').addClass('gt3-hotspot-offset-outsite');
    } else if (selfOffset.left <= 0) {
        tooltip.removeClass('gt3-hotspot-offset-outsite gt3-hotspot-offset-right').addClass('gt3-hotspot-offset-left');
    } else if (selfOffset.left + selfWidth > windowWidth) {
        tooltip.removeClass('gt3-hotspot-offset-outsite gt3-hotspot-offset-left').addClass('gt3-hotspot-offset-right');
    }

    /* GT3 Tooltip z-index */
    count++;
    jQuery(click_hover).parent().toggleClass('active').css({'z-index': count});
}

// Video
function gt3_video_play_button() {
    jQuery('.blog_post_media.has_post_thumb').each(function () {
        var iframe = jQuery(this).find('.gt3_video__play_iframe iframe');
        var iframe_wrapper = jQuery(this).find('.gt3_video__play_iframe');
        var thumb = jQuery(this).find('.gt3_video_wrapper__thumb');
        jQuery(this).find('.gt3_video__play_button').on('click', function () {
            iframe[0].src += jQuery(this).attr('data-video-autoplay');
            iframe_wrapper.addClass('play_video');
            thumb.addClass('play_video');
        })

    })
}

// Gallery
function init_slick_post_gallery() {
    var all_wrappers = jQuery('.blog_post_media .slider-wrapper');
    if (!all_wrappers.length) {
        return;
    }
    jQuery.each(all_wrappers, function (key, $scope) {
        var slick_wrapper = jQuery('.slick_wrapper', $scope);
        slick_wrapper.slick({
            autoplay: false,
            arrows: true,
            dots: false,
            slidesToScroll: 1,
            slidesToShow: 1,
            focusOnSelect: true,
            speed: 500,
            nextArrow: '<button type="button" class="slick-next"></button>',
            prevArrow: '<button type="button" class="slick-prev"></button>'
        });
    })
}

// Custom Colors
function gt3_custom_color() {
    jQuery('.gt3_custom_color').each(function () {
        var element = jQuery(this);
        var color = element.attr('data-color');
        var hover_color = element.attr('data-hover-color');
        var bg_color = element.attr('data-bg-color');
        var border_color = element.attr('data-border-color');
        var bg_hover_color = element.attr('data-hover-bg-color');
        var border_hover_color = element.attr('data-hover-border-color');

        //set default colors
        if (typeof color !== 'undefined') {
            element.css({'color': color});
        } else {
            element.css({'color': ''});
        }
        if (typeof bg_color !== 'undefined') {
            element.css({'background-color': bg_color});
        } else {
            element.css({'background-color': ''});
        }

        if (typeof border_color !== 'undefined') {
            element.css({'border-color': border_color});
        } else {
            element.css({'border-color': ''});
        }

        //change colors on mouseenter / mouseleave
        element.mouseenter(function () {
            // Button Hover Text Color
            if (typeof hover_color !== 'undefined') {
                element.css({'color': hover_color});
            }
            if (typeof bg_hover_color !== 'undefined') {
                element.css({'background-color': bg_hover_color});
            }
            if (typeof border_hover_color !== 'undefined') {
                element.css({'border-color': border_hover_color});
            }
        }).mouseleave(function () {
            // Button Default Text Color
            if (typeof color !== 'undefined') {
                element.css({'color': color});
            } else {
                element.css({'color': ''});
            }
            if (typeof bg_color !== 'undefined') {
                element.css({'background-color': bg_color});
            } else {
                element.css({'background-color': ''});
            }
            if (typeof border_color !== 'undefined') {
                element.css({'border-color': border_color});
            } else {
                element.css({'border-color': ''});
            }
        });
    })
}

function gt3_hide_label() {
    var mc_merge_var = jQuery('#mc_signup').find('.mc_merge_var');
    if (mc_merge_var.length) {
        mc_merge_var.each(function () {
            var _elem = jQuery(this).find('input, textarea');
            _elem.on('focus', function () {
                jQuery(this).prev('label').addClass('gt3_onfocus');
            }).on('blur', function () {
                if (jQuery(this).val() === '') {
                    jQuery(this).prev('label').removeClass('gt3_onfocus');
                }
            });
        })
    }
}
