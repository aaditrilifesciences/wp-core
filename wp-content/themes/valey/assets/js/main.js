(function( $ ) {
	"use strict";

	// Check images loaded
	$.fn.FX_ImagesLoaded = function( callback ) {
		var FX_Images = function ( src, callback ) {
			var img = new Image;
			img.onload = callback;
			img.src = src;
		}
		var images = this.find('img').toArray().map(function( element ) {
			return element.src;
		});
		var loaded = 0;
		$(images).each(function( i, src ) {
			FX_Images(src, function() {
				loaded++;
				if (loaded == images.length) {
					callback();
				}
			})
		})
	}

	// Initialize search form in header.
	var initSearchForm = function() {
		var sfHeader = $( '#sf-header' );
		var headerHeight = $( '#fx-header .top' ).height() + $( '#fx-header .middle' ).height() + $( '#fx-header .bottom' ).height() +  $( '#fx-header.classic' ).height() + $( '#wpadminbar' ).height();

		sfHeader.css({
			'top': headerHeight + 50,
			'height': 'calc(100vh - ' + headerHeight + 'px)',
		});
		// Open search form
		$( '#sf-open' ).on( 'click', function() {
			sfHeader.slideToggle();
			sfHeader.find( 'input[type="text"]' ).focus();
		});
	}

	// Initialize WC quantity adjust.
	var wcQuantityAdjust = function() {
		$( 'body' ).on( 'click', '.quantity .plus', function( e ) {
			var $input = $( this ).parent().parent().find( 'input' );
			$input.val( parseInt( $input.val() ) + 1 );
		});
		$( 'body' ).on( 'click', '.quantity .minus', function( e ) {
			var $input = $( this ).parent().parent().find( 'input' );
			var value = parseInt( $input.val() ) - 1;
			if ( value < 1 ) value = 1;
			$input.val( value );
		});
	}

	// Initialize owl carousel to extra product
	var initCarousel = function() {
		$('.product-extra .owl-carousel').owlCarousel({
			loop: true,
			margin: 30,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					nav: true
				},
				600:{
					items: 3,
					nav: false
				},
				1000:{
					items: 4,
					nav: true,
					loop: false
				}
			}
		})
	}

	// Back to top button
	var backToTop = function() {
		$( '#fx-backtop' ).click( function() {
			$('body,html').animate({
				scrollTop: 0
			}, 500);
			return false;
		});
	}

	// Refest mini cart on ajax event
	var refreshCart = function() {
		$.ajax({
			type: 'POST',
			url: FXAjaxURL,
			dataType: 'json',
			data: { action:'load_mini_cart' },
			success:function(data) {
				var cartContent = $( '.fx-cart .widget_shopping_cart_content' );
				if ( data.cart_html.length > 0 ) {
					cartContent.html( data.cart_html );
				}

				$( '.fx-cart .count' ).text( data.cart_total );

				$( 'body' ).animate({ scrollTop: 0 });
				cartContent.toggleClass( 'actived' );
			}
		});
	}

	// Hide mini cart after actived
	var hideMiniCart = function() {
		$( document ).mouseup( function (e) {
			var actived = $( '.actived' );
			if ( ! actived.is( e.target ) && actived.has( e.target ).length === 0 ) {
				actived.removeClass( 'actived' );
			}
		});
	}

	// Trigger add to cart button
	var initAddToCart = function() {
		$( 'body' ).on( 'click', '.single_add_to_cart_button', function() {
			var current = $(this);
			$.ajax({
				type: 'POST',
				url: FXSiteURL,
				dataType: 'html',
				data: $( '.product-entry form, .content-quickview form' ).serialize(),
				beforeSend: function(){
					current.append( '<i class="fa fa-spinner fa-pulse pa"></i>' );
				},
				success:function(){
					setTimeout( function() {
						$( '.fa-spinner' ).remove();
						$.magnificPopup.close();
					}, 480)
					refreshCart();
				}
			});

			return false;
		});
	}

	// Product quick view
	var productQuickView = function() {
		$( 'body' ).on( 'click', '.btn-quickview', function(e) {
			var _this = $(this),
				id    = _this.attr( 'data-prod' ),
				data  = { action: 'fx_quickview', product: id };

			$( '#fx-wrapper' ).after( '<div class="loader"><div class="loader-inner"></div></div>' );

			$.post( FXAjaxURL, data, function( response ) {
				$.magnificPopup.open({
					items: {
						src: response
					}
				});

				$( '.loader' ).remove();

				if ( $( '.content-quickview form' ).hasClass( 'variations_form' ) ) {
					$( '.single_add_to_cart_button' ).attr( 'disabled', 'disabled' );
				}

				setTimeout( function() {
					if ( $( '.content-quickview form' ).hasClass( 'variations_form' ) ) {
						$( '.content-quickview form.variations_form' ).wc_variation_form();
					}
				}, 100 );
			});
			e.preventDefault();
			e.stopPropagation();
		});
	}

	// Init canvas sidebar
	var initCanvasSidebar = function() {
		$( 'body' ).on( 'click touchend', '#sb-open', function(e) {
			e.preventDefault();
			var mask = '<div class="mask-overlay">';

			$( 'body' ).toggleClass( 'sidebar-opened' );
			$(mask).hide().appendTo( 'body' ).fadeIn( 'fast' );
			$( '.mask-overlay' ).on( 'click', function() {
				$( 'body' ).removeClass( 'sidebar-opened' );
				$( '.mask-overlay' ).remove();
			});
		});
	}

	// Init isotipe
	var initMasonry = function() {
		var el = $( '.fx-masonry' );

		el.each( function(i, val) {
			var _option = $(this).data( 'layout' );

			if ( _option !== undefined ) {
				var _selector = _option.selector,
					_width    = _option.columnWidth;

				$(this).FX_ImagesLoaded( function() {
					$(val).isotope( {
						itemSelector: _selector,
						masonry: {
							columnWidth: _width
						}
					} );
				})
			}
		});
		$( '.fx-filters a' ).click( function() {
			var selector = $( this ).attr( 'data-filter' );
			el.isotope( {
				filter: selector,
				transitionDuration: '0.6s',
			} );
			return false;
		} );
		var $optionSets = $( '.fx-filters' ), $optionLinks = $optionSets.find( 'a' );

		$optionLinks.click( function() {
			var $this = $( this );
			// don't proceed if already selected
			if ( $this.hasClass( 'selected' ) ) {
				return false;
			}
			var $optionSet = $this.parents( '.fx-filters' );
			$optionSet.find( '.selected' ).removeClass( 'selected' );
			$this.addClass( 'selected' );
		} );
	}

	/**
	 * DOMready event.
	 */
	$( document ).ready( function() {
		initSearchForm();
		wcQuantityAdjust();
		initCarousel();
		backToTop();
		initAddToCart();
		hideMiniCart();
		productQuickView();
		initCanvasSidebar();
		initMasonry();
		initMasonry();
	});

})( jQuery );