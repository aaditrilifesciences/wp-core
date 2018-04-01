<?php
/**
 * Action hooks.
 *
 * @since   1.0.0
 * @package Valey
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_setup' ) ) {
	function fx_valey_setup() {
		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * @since 1.0.0
		 */
		$GLOBALS['content_width'] = apply_filters( 'valey_content_width', 820 );

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /language/ directory.
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'valey', FX_VALEY_PATH . '/core/libraries/516x/language' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Register theme location.
		 *
		 * @since 1.0.0
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'valey' ),
			)
		);

		// Tell TinyMCE editor to use a custom stylesheet.
		add_editor_style();
	}
}
add_action( 'after_setup_theme', 'fx_valey_setup' );

/**
 * Register widget area.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_register_sidebars' ) ) {
	function fx_valey_register_sidebars() {
		$footerlayout = cs_get_option( 'footer-layout' );

		register_sidebar(
			array(
				'name'          => esc_html__( 'Primary Sidebar', 'valey' ),
				'id'            => 'primary-sidebar',
				'description'   => esc_html__( 'The Primary Sidebar', 'valey' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'Canvas Sidebar', 'valey' ),
				'id'            => 'canvas-sidebar',
				'description'   => esc_html__( 'The Canvas Sidebar', 'valey' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
		if ( 'equal' == $footerlayout || 'six' == $footerlayout ) {
			for ( $i = 1, $n = 4; $i <= $n; $i++ ) {
				register_sidebar(
					array(
						'name'          => esc_html__( 'Footer Area #', 'valey' ) . $i,
						'id'            => 'footer-' . $i,
						'description'   => sprintf( esc_html__( 'The #%s column in footer area', 'valey' ), $i ),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				);
			}
		} else if ( 'center' == $footerlayout ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Area #1', 'valey' ),
					'id'            => 'footer-1',
					'description'   => esc_html__( 'The first column in footer area', 'valey' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		} else if ( 'three' == $footerlayout ) {
			for ( $i = 1, $n = 3; $i <= $n; $i++ ) {
				register_sidebar(
					array(
						'name'          => esc_html__( 'Footer Area #', 'valey' ) . $i,
						'id'            => 'footer-' . $i,
						'description'   => sprintf( esc_html__( 'The #%s column in footer area', 'valey' ), $i ),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				);
			}
		}
	}
}
add_action( 'widgets_init', 'fx_valey_register_sidebars' );

/**
 * Register custom widgets.
 *
 * @since   1.0.0
 */

if ( ! function_exists( 'fx_valey_register_widgets' ) ) {
	function fx_valey_register_widgets() {
		// Widgets
		$widgets = 'instagram';
		$widgets = array_map( 'trim', explode( ',', $widgets ) );
		foreach ( $widgets as $widget ) {
			require_once FX_VALEY_PATH . '/core/libraries/516x/widgets/' . $widget . '.php';
		}

		register_widget( 'FX_Valey_Widget_Instagram' );
	}
	add_action( 'widgets_init', 'fx_valey_register_widgets' );
}

/**
 * Add Menu Page Link.
 *
 * @return void
 * @since  1.0.0
 */
if ( ! function_exists( 'fx_valey_add_framework_menu' ) ) {
	function fx_valey_add_framework_menu() {
		$menu = 'add_menu_' . 'page';
		$menu(
			'fosx_panel',
			esc_html__( '516x', 'valey' ),
			'',
			'fosx',
			NULL,
			FX_VALEY_URL . '/assets/images/brand.png',
			99
		);
	}
}
add_action( 'admin_menu', 'fx_valey_add_framework_menu' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_enqueue_scripts' ) ) {
	function fx_valey_enqueue_scripts() {
		wp_enqueue_style( 'fx-font-google', fx_valey_google_font_url() );

		// Font Awesome
		wp_enqueue_style( 'font-awesome', FX_VALEY_URL . '/assets/vendors/font-awesome/css/font-awesome.min.css' );

		// Owl Carousel
		wp_enqueue_style( 'owl-carousel', FX_VALEY_URL . '/assets/vendors/owl-carousel/owl.carousel.min.css' );
		wp_enqueue_script( 'owl-carousel', FX_VALEY_URL . '/assets/vendors/owl-carousel/owl.carousel.min.js', array(), false, true );

		// Magnific Popup
		wp_enqueue_script( 'magnific-popup', FX_VALEY_URL . '/assets/vendors/magnific-popup/jquery.magnific-popup.min.js', array(), false, true );

		// Retina
		wp_enqueue_script( 'retina', FX_VALEY_URL . '/assets/vendors/retina/retina.min.js', array(), false, true );

		// Isotope
		wp_enqueue_script( 'isotope', FX_VALEY_URL . '/assets/vendors/isotope/isotope.pkgd.min.js', array(), false, true );

		// jQuery Nav
		wp_register_script( 'jquery-nav', FX_VALEY_URL . '/assets/vendors/jquery-nav/jquery-nav.min.js', array(), false, true );

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}

		// Main scripts
		wp_enqueue_script( 'fx-valey-script', FX_VALEY_URL . '/assets/js/main.js', array( 'jquery' ), '', true );

		// Main stylesheet
		wp_enqueue_style( 'fx-valey-style', get_stylesheet_uri() );

		// Inline stylesheet
		wp_add_inline_style( 'fx-valey-style', fx_valey_custom_css() );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		do_action( 'valey_scripts');
	}
}
add_action( 'wp_enqueue_scripts', 'fx_valey_enqueue_scripts' );

/**
 * Render google font link
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_google_font_url' ) ) {
	function fx_valey_google_font_url() {
		// Google font
		$fonts = $font_parse = array();

		// Font default
		$fonts['Montserrat'] = array(
			'400',
			'700',
		);
		$fonts['Libre Baskerville'] = array(
			'400',
			'700',
		);

		// Body font
		$body_font    = cs_get_option( 'body-font' );
		$heading_font = cs_get_option( 'heading-font' );

		if ( $body_font ) {
			$font_family = esc_attr( $body_font['family'] );
			if ( '100italic' == $body_font['variant'] ) {
				$font_weight = array( '100' );
			} elseif ( '300italic' == $body_font['variant'] ) {
				$font_weight = array( '300' );
			} elseif ( '400italic' == $body_font['variant'] ) {
				$font_weight = array( '400' );
			} elseif ( '700italic' == $body_font['variant'] ) {
				$font_weight = array( '700' );
			} elseif ( '900italic' == $body_font['variant'] ) {
				$font_weight = array( '900' );
			} elseif ( 'regular' == $body_font['variant'] ) {
				$font_weight = array( '400' );
			} else {
				$font_weight = array( $body_font['variant'] );
			}

			// Merge array and delete values duplicated
			$fonts[$font_family] = isset( $fonts[$font_family] ) ? array_unique( array_merge( $fonts[$font_family], $font_weight ) ) : $font_weight;
		}

		if ( $heading_font ) {
			$font_family = esc_attr( $heading_font['family'] );
			if ( '100italic' == $heading_font['variant'] ) {
				$font_weight = array( '100' );
			} elseif ( '300italic' == $heading_font['variant'] ) {
				$font_weight = array( '300' );
			} elseif ( '400italic' == $heading_font['variant'] ) {
				$font_weight = array( '400' );
			} elseif ( '700italic' == $heading_font['variant'] ) {
				$font_weight = array( '700' );
			} elseif ( '900italic' == $heading_font['variant'] ) {
				$font_weight = array( '900' );
			} elseif ( 'regular' == $heading_font['variant'] ) {
				$font_weight = array( '400' );
			} else {
				$font_weight = array( $heading_font['variant'] );
			}

			// Merge array and delete values duplicated
			$fonts[$font_family] = isset( $fonts[$font_family] ) ? array_unique( array_merge( $fonts[$font_family], $font_weight ) ) : $font_weight;
		}

		// Parse array to string for url Google fonts
		foreach ( $fonts as $font_name => $font_weight ) {
			$font_parse[] = $font_name . ':'. implode( ',' , $font_weight );
		}

		$query_args = array(
			'family' => urldecode( implode( '|', $font_parse ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
	}
}

/**
 * Redirect to under construction page
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_offline' ) ) {
	function fx_valey_offline() {
		// Check if under construction page is enabled
		if ( cs_get_option( 'maintenance' ) ) {
			if ( ! is_feed() ) {
				// Check if user is not logged in
				if ( ! is_user_logged_in() ) {
					// Load under construction page
					get_template_part( 'views/pages/offline' );
					exit;
				}
			}

			// Check if user is logged in
			if ( is_user_logged_in() ) {
				global $current_user;

				// Get user role
				get_currentuserinfo();

				$loggedInUserID = $current_user->ID;
				$userData = get_userdata( $loggedInUserID );

				// If user role is not 'administrator' then redirect to under construction page
				if ( 'administrator' != $userData->roles[0] ) {
					if ( ! is_feed() ) {
						get_template_part( 'views/pages/offline' );
						exit;
					}
				}
			}
		}
	}
}
add_action( 'template_redirect', 'fx_valey_offline' );