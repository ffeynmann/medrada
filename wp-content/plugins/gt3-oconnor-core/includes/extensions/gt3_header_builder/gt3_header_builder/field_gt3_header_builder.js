/*global redux, redux_opts*/
/*
 * Field Sorter jquery function
 * Based on
 * [SMOF - Slightly Modded Options Framework](http://aquagraphite.com/2011/09/slightly-modded-options-framework/)
 * Version 1.4.2
 */

(function( $ ) {
    "use strict";

    redux = redux || {};

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.gt3_header_builder = redux.field_objects.gt3_header_builder || {};

    var scroll = '';

    $( document ).ready(
        function() {
        	//redux.gt3_header_builder_func();            
            responsive_tab();
        }
    );

    function responsive_tab (){
        console.log(111);
        jQuery('#gt3_header_builder_id').find('.gt3_header_builder__side.tablet,.gt3_header_builder__side.mobile').hide();
        jQuery('.gt3_header_builder__responsive').find('.gt3_header_builder__responsive_tab').on('click',function(){
            var element = jQuery(this);
            var tab_name = element.attr('data-tab-name');
            element.addClass('active').siblings().removeClass('active');
            element.parents('#gt3_header_builder_id').find('.gt3_header_builder__side').hide();
            if (tab_name == 'desktop') {
                element.parents('#gt3_header_builder_id').find('.gt3_header_builder__side:not(.tablet):not(.mobile)').show();
            }else{
                element.parents('#gt3_header_builder_id').find('.gt3_header_builder__side.'+tab_name).show();
            }
            
        })
    }

    redux.field_objects.gt3_header_builder.init = function( selector ) {



        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-gt3_header_builder:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;
                
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                
/*                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }*/
                
                /**    Sorter (Layout Manager) */
                el.find( '.redux-sorter' ).each(
                    function() {
                        var id = $( this ).attr( 'id' );

                        el.find( '#' + id ).find( 'ul' ).sortable(
                            {
                                items: 'li',
                                placeholder: "placeholder",
                                connectWith: '.sortlist_' + id,
                                opacity: 0.95,
                                scroll: false,
                                out: function( event, ui ) {
                                    if ( !ui.helper ) return;
                                    if ( ui.offset.top > 0 ) {
                                        scroll = 'down';
                                    } else {
                                        scroll = 'up';
                                    }
                                    /*redux.field_objects.sorter.scrolling( $( this ).parents( '.redux-field-container:first' ) );*/

                                },
                                over: function( event, ui ) {
                                    scroll = '';
                                },

                                deactivate: function( event, ui ) {
                                    scroll = '';
                                },

                                stop: function( event, ui ) {
                                    /*var sorter = redux.gt3_header_builder[$( this ).attr( 'data-id' )];

                                    console.log(sorter);
                                    var id = $( this ).find( 'h3' ).text();

                                    if ( sorter.limits && id && sorter.limits[id] ) {
                                        if ( $( this ).children( 'li' ).length >= sorter.limits[id] ) {
                                            $( this ).addClass( 'filled' );
                                            if ( $( this ).children( 'li' ).length > sorter.limits[id] ) {
                                                $( ui.sender ).sortable( 'cancel' );
                                            }
                                        } else {
                                            $( this ).removeClass( 'filled' );
                                        }
                                    }*/
                                },

                                update: function( event, ui ) {
                                    //var sorter = redux.gt3_header_builder[$( this ).attr( 'data-id' )];
                                    var id = $( this ).find( 'h3' ).text();

                                    
                                    $( this ).find( '.position' ).each(
                                        function() {
                                            //var listID = $( this ).parent().attr( 'id' );
                                            var listID = $( this ).parent().attr( 'data-id' );
                                            var parentID = $( this ).parent().parent().attr( 'data-group-id' );

                                            redux_change( $( this ) );

                                            var optionID = $( this ).parent().parent().parent().parent().parent().attr( 'id' );

                                            $( this ).prop(
                                                "name",
                                                redux.args.opt_name + '[' + optionID + '][' + parentID + '][content][' + listID + '][title]'
                                            );
                                        }
                                    );                                    
                                    $( this ).find( '.sortee .has_settings ' ).each(
                                        function() {
                                            //var listID = $( this ).parent().attr( 'id' );
                                            var listID = $( this ).parent().attr( 'data-id' );
                                            var parentID = $( this ).parent().parent().attr( 'data-group-id' );

                                            redux_change( $( this ) );

                                            var optionID = $( this ).parent().parent().parent().parent().parent().attr( 'id' );

                                            $( this ).prop(
                                                "name",
                                                redux.args.opt_name + '[' + optionID + '][' + parentID + '][content][' + listID + '][has_settings]'
                                            );
                                        }
                                    );
                                }
                            }
                        );
                        el.find( ".redux-sorter" ).disableSelection();
                    }
                );
            }
        );
    };

})( jQuery );