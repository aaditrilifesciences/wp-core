window.jQuery = window.$ = jQuery;
var $window = $(window);
var Engo_Apps = {
    start: function() {
        "use strict";
        this.engoMobiledetect();
        this.stickyHeader();
        this.offcanvasMenu.start();
        this.megaMenu.start();
        this.wowAnimate();
        this.slider.start();
        this.outTeam();
        this.faq();
        this.woocommerce.start();
        this.backToTop();
    },
    engoMobiledetect: function() {
        var engomobile;
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
            engomobile = true;
            $("html").addClass("mobile");
        }
        else {
            engomobile = false;
            $("html").addClass("no-mobile");
        }
        return engomobile;
    },
    stickyHeader: function() {
        "use strict";
        var self = this;
        if (($(window).width() >= 1024) && (self.engoMobiledetect() == false)) {
            var stickyelement = $('.engoj-sticky-header');
            if (stickyelement.hasClass('no-sticky')) return false;
            else {
                var engostickyonTop = stickyelement.offset().top;
                $(window).scroll(function () {
                    if ($(window).scrollTop() > engostickyonTop) {
                        stickyelement.addClass("stick");
                        stickyelement.css({position: 'fixed', top: '0px'});
                    } else {
                        stickyelement.css({position: 'relative', top: '0px'});
                        stickyelement.removeClass("stick");
                    }
                });
            }
        }


    },
    offcanvasMenu: {
        start: function() {
            var self = this;
            self.offcanvas_position();
            $window.on('scroll', function () {
                self.offcanvas_position();
            });
            $('[data-toggle="offcanvas"], .btn-offcanvas').click(function () {
                $(this).toggleClass('on');
                $('.row-offcanvas').toggleClass('active') ;
            });

            $("#main-menu-offcanvas .caret").click( function(){
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
                return false;
            } );
            $('.showright').click( function(){
                $('.offcanvas-showright').toggleClass('active');
            } );
        },
        offcanvas_position: function () {
            var scroll_Top = $window.scrollTop();
            if (scroll_Top >= 1) {
                if($('[data-toggle="offcanvas"]').hasClass('on')) {
                    if(scroll_Top >= 40) {
                        $('[data-toggle="offcanvas"]').css({'position':'absolute','top':'4px'});
                    } else {
                        $('[data-toggle="offcanvas"]').removeAttr('style');
                    }
                } else {
                    $('[data-toggle="offcanvas"]').css({'position':'absolute','top':'4px'});
                }
            } else {
                $('[data-toggle="offcanvas"]').removeAttr('style');
            }
        }
    },
    megaMenu: {
        start: function(){
            this.horizontal();
            this.vertical();
            this.toogleCategory();
        },
        horizontal: function() {
          /** Mega menu - horizontal mega**/
              $(".engo-horizontal-megamenu ul.megamenu > li.dropdown").each(function () {
                  var dropdown        = $(this).children(".dropdown-menu");
                  var megamenu       = $(this).parent();

                  dropdown.css("right", "auto");

                  var widthElement = $(this).children("a").outerWidth()/2;
                  var arrowElement = $(this).find(".arrow").outerWidth();
                  var marginElement = 0;
                  var elementPadding = (dropdown.outerHeight() - dropdown.height)/2;
                  if($(this).hasClass('has-mega')) {
                      /** dropdown begin vs megamenu **/
                      var dropdown_begin_mega = $(this).offset().left - megamenu.offset().left;
                      if($(this).hasClass('aligned-fullwindown')) {
                          /** dropdown begin vs window **/
                          var dropdown_begin = $(this).offset().left;
                          dropdown.css({'left':-dropdown_begin,'width':$(window).width()});
                      } else if($(this).hasClass('aligned-fullwidth')) {
                          dropdown.css({'left':- dropdown_begin_mega,'width':megamenu.outerWidth()});
                      } else if($(this).hasClass('aligned-right')) {
                          var dropdown_end_right = (megamenu.offset().left + megamenu.outerWidth()) - ($(this).offset().left + $(this).outerWidth()) ;
                          dropdown.css({'right':-dropdown_end_right});
                      } else if($(this).hasClass('aligned-left')) {
                          dropdown.css({'left':-dropdown_begin_mega});
                      }  else if($(this).hasClass('aligned-right-window')) {
                          var window_end_right = - ($(window).width() - megamenu.offset().left - megamenu.outerWidth() );
                          dropdown.css({'right':window_end_right});
                      } else {
                          var end_right     = ($(window).width() - (dropdown.offset().left + dropdown.outerWidth()));
                          var end_right2    = ($(window).width() - (megamenu.offset().left + megamenu.outerWidth()));
                          if(end_right2 > end_right) {
                              $(dropdown).css({"right":"0", "left":"auto"});
                          }
                      }


                  } else {
                  }
                  $(this).find(".arrow").css({"margin-left": widthElement-arrowElement/2, "margin-top": -elementPadding});

                  $(this).hover(function(){
                      $("ul.megamenu > li").removeClass("active");
                      $(this).addClass("active");
                  },function () {
                      $(this).removeClass("active");
                  });
              });



        },
        vertical: function(){
        /** Mega menu - vertical mega**/
        $(".engo-vertical-megamenu ul.megamenu > li.dropdown").each(function () {
            var dropdown        = $(this).children(".dropdown-menu");
            var megamenu       = $("ul.megamenu");
            var this_toggle = $(this).parent().parent();
            var marginElement = 0;

            if($(this).hasClass('has-mega')) {
                if($(this).hasClass('aligned-fullwidth') || $(this).hasClass('aligned-fullwindown')) {
                    $(dropdown).attr("style","width:" + ($(window).width() - this_toggle.outerWidth())+"px !important; right:"+ -($(window).width() - this_toggle.outerWidth())+"px;");
                } else if($(this).hasClass('aligned-right') || $(this).hasClass('aligned-left')) {
                    $(dropdown).css({'right': - dropdown.outerWidth(true)});
                } else {
                    $(dropdown).css({'right': - dropdown.outerWidth(true)});
                }
            }else {
                $(dropdown).css({'right': - dropdown.outerWidth(true)});
            }

            var dropdownHeight = $(dropdown).outerHeight();
            var heightElement = $(this).children("a").outerHeight()/2;
            var arrowElement = $(this).find(".arrow").outerHeight();


            $(dropdown).css("top", -dropdownHeight/2 + heightElement);

            var end_bottom     = $(window).height() - (dropdown.outerHeight() + dropdown.offset().top);
            if(end_bottom <= 0) {
                if($(window).height() > dropdown.outerHeight()) {
                    $(dropdown).css("top", - ($(this).offset().top - ($(window).height() - dropdown.outerHeight())/2) );
                    marginElement = ($(window).height() - dropdown.outerHeight())/2;
                } else {
                    $(dropdown).css("top",- $(this).offset().top);
                }
            }

            $(this).find(".arrow").css("top", marginElement + dropdownHeight/2 - arrowElement/2);

            $(this).hover(function(){
                $("ul.megamenu > li").removeClass("active");
                $(this).addClass("active");
            },function () {
                $(this).removeClass("active");
            });

        });


        },
        verticalOffCanvas: function() {
            "use strict";
            /** toggle menu header v5 **/
                var self = this;
            var toggle_background = $(".engo-toggle-menu-position").attr("data-style");
            var screen_height = $(window).height();
            $("body").append("<div class='engo-menu-toggle-background'></div>");
            $(".engo-vertical-fixed-block").addClass(toggle_background);
            var ignore_close = false;
            var nav_collapse = $(".engo-vertical-fixed-block > nav > .navbar-collapse", "#engo-mainmenu");
            nav_collapse.attr('style', 'height:' + screen_height + 'px !important');
            var this_ul_mega = $(".engo-vertical-fixed-block > nav > .navbar-collapse > ul", "#engo-mainmenu");
            $("#search-box-v5").css({"top": this_ul_mega.offset().top + this_ul_mega.outerHeight()});

            $(".engo-toggle-menu-position").click(function () {
                    $(this).toggleClass("on");
                    $(".engo-menu-toggle-background").toggleClass("show " + toggle_background);
                    $(".navbar-collapse").toggleClass("open");
                    $("#search-box-v5").toggleClass("active");
            });
            $(".engo-menu-toggle-background").click(function(){
                $(".engo-toggle-menu-position").trigger("click");
            });

        },
        toogleCategory: function(){
            /** Vervical toggle menu **/
            $('.engo-toggle-dropdown-menu ul li.item-toggle-dropdown').each(function(){
                if ($(this).find('.item-toggle-menu').length > 0) {
                    $(this).append('<i class="closed toggle-button fa fa-caret-down"></i>');
                }
                $(this).find('.item-toggle-menu').slideUp('fast');
            });
            $( "body" ).on( "click", '.engo-toggle-dropdown-menu ul li.item-toggle-dropdown .closed', function(){
                $(this).parent().find('.item-toggle-menu').first().slideDown('fast');
                $(this).removeClass('closed').removeClass('fa-caret-down').addClass('opened').addClass('fa-caret-up');
            });
            $( "body" ).on( "click", '.engo-toggle-dropdown-menu ul li.item-toggle-dropdown .opened', function(){
                $(this).parent().find('.item-toggle-menu').first().slideUp('fast');
                $(this).removeClass('opened').removeClass('fa-caret-up').addClass('closed').addClass('fa-caret-down');
            });
        }
    },
    wowAnimate: function(){
        var wow = new WOW();
        wow.init();
    },
    animateElements: {
        start: function(){
            $window.on('scroll resize', this.check_if_in_view());
            $window.trigger('scroll');
        },
        check_if_in_view: function() {
            var $animation_elements_in = $('.animation-element.fade-in'),
                $animation_elements_left = $('.animation-element.fade-left'),
                $animation_elements_right = $('.animation-element.fade-right'),
                $animation_engoPullDown = $('.animation-element.engo-PullDown'),
                $animation_tinDownIn = $('.animation-element.tin-DownIn'),
                $animation_hover_in = $('.animation-hover-element.fade-in');
            var window_height = $window.height(),
                window_top_position = $window.scrollTop(),
                window_bottom_position = (window_top_position + window_height);

            $animation_hover_in.each(function() {
                var $element = $(this);
                $element.hover(
                    function(){
                        $element.addClass('animated fadeInUp');
                    },
                    function(){
                        $element.removeClass('animated fadeInUp');
                    });
            });

            $animation_tinDownIn.each(function() {
                var $element = $(this);
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 100);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+10) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated tinDownIn');
                }
            });
            $animation_engoPullDown.each(function() {
                var $element = $(this);
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 100);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+10) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('engoPullDown');
                }
            });

            $animation_elements_in.each(function() {
                var $element = $(this);
                /*console.log($element);*/
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + 100);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+10) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated fadeInUp');
                }
            });

            $animation_elements_left.each(function() {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+100) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated fadeInLeft');
                }
            });

            $animation_elements_right.each(function() {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+100) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated fadeInRight');
                }
            });
        }
    },
    slider: {
        start: function(){
            this.owl_fix_hide('add');
            this.owlCarousel();
            this.owl_fix_hide('remove');
        },
        owl_fix_hide: function (status) {
            /** Fix owlcarosel not init when display none in tab content **/
            if(status == 'add') {
                $(".tab-pane").addClass("show");
            }
            else{
                $(".tab-pane").removeClass("show");
            }
        },
        owlCarousel: function(){
            $(".owl-carousel-play .owl-carousel").each( function(){
                var config = {
                    navigation : false, // Show next and prev buttons
                    slideSpeed : 300,
                    paginationSpeed : 400,
                    responsiveClass:true,
                };
                var owl = $(this);
                if($(this).attr( 'data-pagination' ) == true) {
                    config.pagination = true;
                }
                if($(this).attr("data-autoPlay") == "true") {
                    config.autoplay = true;
                    if($(this).attr("data-time") > 0) {
                        config.autoplayTimeout = $(this).attr("data-time");
                    }
                }
                if($(this).attr("data-loop") == "true") {
                    config.loop = true;
                }
                if($(this).attr("data-navigation") == "true") {
                    config.dots = true;
                }
                if($(this).attr("data-next-prev") == "true") {
                    config.nav = true;
                }
                if ($(this).attr('data-slide')) {
                    config.items = $(this).attr('data-slide');
                }
                var responsive_config = {};
                if ($(this).attr('data-lg')) {
                    responsive_config.lg = $(this).attr('data-lg');
                }
                if ($(this).attr('data-md')) {
                    responsive_config.md = $(this).attr('data-md');
                }
                if ($(this).attr('data-sm')) {
                    responsive_config.sm = $(this).attr('data-sm');
                }
                if ($(this).attr('data-xs')) {
                    responsive_config.xs = $(this).attr('data-xs');
                }
                if ($(this).attr('data-xs')) {
                    responsive_config.mb = $(this).attr('data-xs');
                }


                var responsive = {
                    0:{
                        items:1
                    },
                    480:{
                        items:responsive_config.mb
                    },
                    640:{
                        items:responsive_config.xs
                    },
                    768:{
                        items:responsive_config.sm
                    },
                    1024:{
                        items:responsive_config.md
                    },
                    1200:{
                        items:responsive_config.lg
                    }
                };
                if($.isEmptyObject(responsive_config) == false) {
                    /*console.log(JSON.stringify(responsive_config));*/
                    config.responsive = responsive;
                }
                //console.log(JSON.stringify(config));
                owl.owlCarousel( config );
                $('.left',$(this).parent()).click(function(){
                    owl.trigger('prev.owl.carousel');
                    return false;
                });
                $('.right',$(this).parent()).click(function(){
                    owl.trigger('next.owl.carousel');
                    return false;
                });
            } );
        },
    },
    outTeam: function() {
        /** Out team v1 **/
        $(".team-v1").each(function(){
            var team_item = $(this);
            var team_avatar = team_item.find("img.img-responsive");
            var team_info = team_item.find(".team-info");
            var team_body = team_item.find(".team-body");
            var team_body_content = team_item.find(".team-body-content");

            $(team_item).css({'height':team_body.height() + team_body_content.height()});
            $(team_info).css({'width':team_avatar.width() - 20});
            $(this).hover(
                function() {
                    $(team_body).css({'margin-top':team_body_content.height()});
                },
                function() {
                    $(team_body).css({'margin-top':0});
                }
            );

        });
    },
    faq: function() {
        /** FAQ v1**/
        $(".engo-faq-v1").each(function(){
            $(".wpb_wrapper",$(this)).append("<div id='engo-faq-result'></div>");
            $(".vc_toggle_title h4").each(function(){
                $(this).click(function(){
                    $("#engo-faq-result").css({'opacity':0});
                    var parent = $(this).parent().parent();
                    var html_faq = $(".vc_toggle_content",parent).html();

                    if($(parent).hasClass('vc_toggle_title_active')) {
                        $(parent).removeClass("vc_toggle_title_active");
                    } else {
                        $(".vc_toggle").removeClass("vc_toggle_title_active");

                        $(parent).addClass('vc_toggle_title_active');
                        setTimeout(function(){
                            $("#engo-faq-result").html(html_faq).css({'opacity':1});
                        }, 200);

                    }
                });
            });

        });
    },
    woocommerce: {
        start: function () {
            this.bind();
            this.quantity();
        },
        bind: function() {
            //$(document).off( 'click', '.add_to_cart_button' );
            $(document).on('click',".variation_add_to_cart_button", this.addToCartActions);
        },
        quantity: function(){
            var form_cart = $( 'form .quantity' );
            $(form_cart ).each(function(){
                var this_prod = $(form_cart).attr("data-product");
                var this_add_to_cart_btn = $(".add_to_cart_button[data-product_id='"+this_prod+"']");
                $(this).prepend( '<span class="minus"><i class="fa fa-minus-square-o"></i></span>' );
                $(this).append( '<span class="plus"><i class="fa fa-plus-square-o"></i></span>' );
                var minus = $(this).find( $( '.minus' ) );
                var plus  = $(this).find( $( '.plus' ) );
                var min_order = parseInt($(this).find( '.qty' ).attr('min'));
                var max_order = parseInt($(this).find( '.qty' ).attr('max'));

                minus.on( 'click', function(){
                    var qty = $( this ).parent().find( '.qty' );
                    if ( qty.val() <= min_order ) {
                        qty.val(1);
                        this_add_to_cart_btn.attr("data-quantity",1);
                    } else {
                        qty.val( ( parseInt( qty.val() ) - 1 ) );
                        this_add_to_cart_btn.attr("data-quantity",( parseInt( qty.val() ) ));
                    }
                });
                plus.on( 'click', function(){
                    var qty = $( this ).parent().find( '.qty' );
                    if ( qty.val() >= max_order ) {
                        qty.val( max_order );
                        this_add_to_cart_btn.attr("data-quantity",max_order);
                    } else {
                        qty.val( ( parseInt( qty.val() ) + 1 ) );
                        this_add_to_cart_btn.attr("data-quantity",( parseInt( qty.val() ) ));
                    }
                });
            });
        },
        addToCartActions: function(e) {
            e.preventDefault();
            var $thisbutton = $( this );

            /** Remove old Class **/
            $thisbutton.removeClass('error');
            $( '.ajaxerrors' ).remove();
            $('form.cart').find(".engo-addToCart-error").remove();

            $variation_form = $( this ).closest( '.variations_form' );
            var var_id = $variation_form.find( 'input[name=variation_id]' ).val();

            var product_id = $variation_form.find( 'input[name=product_id]' ).val();
            var quantity = $variation_form.find( 'input[name=quantity]' ).val();


            var item = {},
                check = true;

            variations = $variation_form.find( 'select[name^=attribute]' );

            /* Updated code to work with radio button */
            if ( !variations.length) {
                variations = $variation_form.find( '[name^=attribute]:checked' );
            }

            /* Backup Code for getting input variable */
            if ( !variations.length) {
                variations = $variation_form.find( 'input[name^=attribute]' );
            }

            variations.each( function() {
                var $this = $( this ),
                    attributeName = $this.attr( 'name' ),
                    attributevalue = $this.val(),
                    index,
                    attributeTaxName;
                    $this.removeClass( 'error' );

                if ( attributevalue.length === 0 ) {
                    index = attributeName.lastIndexOf( '_' );
                    attributeTaxName = attributeName.substring( index + 1 );

                    //$this.addClass( 'required error' ).before( '<div class="ajaxerrors"><p>Please select ' + attributeTaxName + '</p></div>' );
                    $this.addClass( 'required error' ).before( '<div class="ajaxerrors"><p>' + wc_add_to_cart_variation_params.i18n_make_a_selection_text + '</p></div>' );
                    check = false;
                } else {
                    item[attributeName] = attributevalue;
                }
            } );

            if ( !check ) {
                return false;
            }


            if ( $thisbutton.is( '.product-type-variable .single_add_to_cart_button' ) ) {
                $thisbutton.removeClass('added').addClass('loading');
                var data = {
                    action: 'engo_add_to_cart_variable',
                    product_id: product_id,
                    quantity: quantity,
                    variation_id: var_id,
                    variation: item
                };

                // Trigger event
                $( 'body' ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

                // Ajax action
                $.post( wc_add_to_cart_params.ajax_url, data, function( response ) {
                    if ( ! response )
                        return;

                    var this_page = window.location.toString();
                    this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

                    if ( response.error && response.product_url ) {
                        //window.location = response.product_url;
                        $('form.cart').append('<p class="engo-addToCart-error">'+ response.messages.error[0]+'</p>');
                        $thisbutton.removeClass('loading').addClass('error');
                        return;
                    }

                    $thisbutton.removeClass( 'loading' ).removeClass('error');

                    var fragments = response.fragments;
                    var cart_hash = response.cart_hash;

                    // Block fragments class
                    if ( fragments ) {
                        $.each( fragments, function( key ) {
                            $( key ).addClass( 'updating' );
                        });
                    }

                    // Block widgets and fragments
                    $( '.shop_table.cart, .updating, .cart_totals' ).fadeTo( '400', '0.6' ).block({
                        message: null,
                        overlayCSS: {
                            opacity: 0.6
                        }
                    });

                    // Changes button classes
                    $thisbutton.addClass('added');

                    // View cart text
                    if ( ! wc_add_to_cart_params.is_cart && $thisbutton.parent().find( '.added_to_cart' ).size() === 0 ) {
                        $thisbutton.after( ' <a href="' + wc_add_to_cart_params.cart_url + '" class="added_to_cart wc-forward" title="' + wc_add_to_cart_params.i18n_view_cart + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>' );
                    }

                    // Replace fragments
                    if ( fragments ) {
                        $.each( fragments, function( key, value ) {
                            $( key ).replaceWith( value );
                        });
                    }

                    // Unblock
                    $( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

                    // Cart page elements
                    $( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

                        $( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();
                        $( document.body ).trigger( 'cart_page_refreshed' );
                    });

                    $( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
                        $( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
                    });

                    // Trigger event so themes can refresh other areas
                    $( document.body ).trigger( 'added_to_cart', [ fragments, cart_hash, $thisbutton ] );
                });

                return false;

            } else {
                return true;
            }
        }
    },
    backToTop: function(){
        if ($('#back-to-top').length) {
            var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }
    }
}
Engo_Apps.start();