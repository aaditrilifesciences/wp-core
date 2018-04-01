<?php
/**
 * EngoTheme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */

nautica_engo_includes(  get_template_directory() . '/inc/config/define.php' );

/*
 * Fix for woocommerce non active
 * */
if( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	function is_product() {
		return false;
	}
	function is_product_category() {
		return false;
	}
}

/**
 * Set up the content width value based on the theme's design.
 *
 * @see nautica_fnc_content_width()
 *
 * @since EngoTheme 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * EngoTheme only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	$message = sprintf( esc_html__( 'Nautica requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'nautica' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

if ( ! function_exists( 'nautica_fnc_setup' ) ) :
/**
 * EngoTheme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_setup() {

	/*
	 * Make EngoTheme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on EngoTheme, use a find and
	 * replace to change 'nautica' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'nautica', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', nautica_fnc_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 370, 265, true );
	add_image_size( 'nautica-post-fullwidth', 1038, 9999, true );

	// This theme uses wp_nav_menu() in two locations.
	$custom_header_primary_menus = array(
			'primary'   => esc_html__( 'Primary menu', 'nautica' ),
			'secondary' => esc_html__( 'Secondary menu in left sidebar', 'nautica' ),
			'topmenu'	=> esc_html__( 'Topbar Menu in Topbar sidebar', 'nautica' )
	);
	$headers_layout = nautica_fnc_get_header_layouts_to_array();
	if($headers_layout) {
		foreach ($headers_layout as $key => $value) {
			$custom_header_primary_menus["primary_menu_header_".$key] = $value.esc_html__( " primary menu", 'nautica' );
		}
	}

	register_nav_menus($custom_header_primary_menus);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'nautica_fnc_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	
	// add support for display browser title
	add_theme_support( 'title-tag' );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	nautica_fnc_get_load_plugins();

}
endif; // nautica_fnc_setup
add_action( 'after_setup_theme', 'nautica_fnc_setup' );

/**
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function nautica_engo_includes( $path, $ifiles=array() ){

    if( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    }else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

/**
 * Get Theme Option Value.
 * @param String $name : name of prameters 
 */
function nautica_fnc_theme_options($name, $default = false) {
  
    // get the meta from the database
    $options = ( get_option( 'engo_theme_options' ) ) ? get_option( 'engo_theme_options' ) : null;

    // return the option if it exists
    if ( isset( $options[$name] ) ) {
        return apply_filters( 'engo_theme_options_$name', $options[ $name ] );
    }
    if( get_option( $name ) ){
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'engo_theme_options_$name', $default );
}
/**
 * Adjust content_width value for image attachment template.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'nautica_fnc_content_width' );


/**
 * Require function for including 3rd plugins
 *
 */
nautica_engo_includes(  get_template_directory() . '/inc/plugins/*.php' );

function nautica_fnc_get_load_plugins(){

	$plugins[] =(array(
		'name'                     => 'Meta Box', // The plugin name
	    'slug'                     => 'meta-box', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => 'WooCommerce', // The plugin name
	    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));


	$plugins[] =(array(
		'name'                     => 'MailChimp for WordPress', // The plugin name
	    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => 'Contact Form 7', // The plugin name
	    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => 'WPBakery Visual Composer', // The plugin name
	    'slug'                     => 'js_composer', // The plugin slug (typically the folder name)
	    'required'                 => true,
	    'source'				   => 'http://plugins.engotheme.com/js_composer.zip'
	));

	$plugins[] =(array(
		'name'                     => 'Revolution Slider', // The plugin name
        'slug'                     => 'revslider', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'				   => 'http://plugins.engotheme.com/revslider.zip'
	));

	$plugins[] =(array(
		'name'                     => 'ENGO Themer For Themes', // The plugin name
        'slug'                     => 'engotheme', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'				   => 'http://plugins.engotheme.com/engotheme.zip'
	));

	$plugins[] =(array(
			'name'                     => 'YITH WooCommerce Wishlist', // The plugin name
			'slug'                     => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
			'required'                 => true,
	));

	$plugins[] =(array(
			'name'                     => 'YITH WooCommerce Compare', // The plugin name
			'slug'                     => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
			'required'                 => true ,
	));

	$plugins[] =(array(
			'name'                     => 'YIKES Custom Product Tabs for WooCommerce', // The plugin name
			'slug'                     => 'yikes-inc-easy-custom-woocommerce-product-tabs', // The plugin slug (typically the folder name)
			'required'                 => false ,
	));


	$plugins[] =(array(
		'name'                     => 'Google Web Fonts Customizer', // The plugin name
        'slug'                     => 'google-web-fonts-customizer-gwfc', // The plugin slug (typically the folder name)
        'required'                 => false ,
	));

	tgmpa( $plugins );
}

/**
 * Register three EngoTheme widget areas.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_registart_widgets_sidebars() {
	 
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Sidebar Default', 'nautica' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'nautica'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Left Sidebar' , 'nautica'),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'nautica'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));
	register_sidebar(
	array(
		'name'          => esc_html__( 'Right Sidebar' , 'nautica'),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'nautica'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Left Sidebar' , 'nautica'),
		'id'            => 'blog-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'nautica'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Right Sidebar', 'nautica'),
		'id'            => 'blog-sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'nautica'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

}
add_action( 'widgets_init', 'nautica_fnc_registart_widgets_sidebars' );

/**
 * Register Lato Google font for EngoTheme.
 *
 * @since EngoTheme 1.0
 *
 * @return string
 */
function nautica_fnc_font_url() {
	 
	$fonts_url = '';
    
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $montserrat = _x( 'on', 'Montserrat: on or off', 'nautica' );
    
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lora = _x( 'on', 'Lora: on or off', 'nautica' );
    
    $raleway = _x( 'on', 'Raleway: on or off', 'nautica' );
 
        $font_families = array();
 
        if ( 'off' !== $lora ) {
            $font_families[] = 'Lora:400,700,400italic';
        }
        
        if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }
        
        if ( 'off' !== $raleway ) {
            $font_families[] = 'Raleway:400';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		 
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
 
    return esc_url_raw( $fonts_url );
}

function nautica_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'nautica_javascript_detection', 0 );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'nautica-fonts', nautica_fnc_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'nautica-fa', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'nautica-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'nautica-ie', get_template_directory_uri() . '/css/ie.css', array( 'nautica-style' ), '20131205' );
	wp_style_add_data( 'nautica-ie', 'conditional', 'lt IE 9' );

//	wp_enqueue_style( 'owl-carosel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array(), '2.0' );

	wp_enqueue_style( 'nautica-gallery', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '3.1.6' );

	wp_enqueue_script( 'nautica-html5', get_template_directory_uri() . '/js/html5.js',  array(),  '20160330' );
	wp_script_add_data( 'nautica-html5', 'conditional', 'lt IE 9' );
	
	wp_enqueue_script( 'nautica-bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130402' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'nautica-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'nautica-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'nautica-slider', 'featuredSliderDefaults', array(
			'prevText' => esc_html__( 'Previous', 'nautica' ),
			'nextText' => esc_html__( 'Next', 'nautica' )
		) );
	}



	wp_enqueue_script( 'nautica-owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array( 'jquery' ), '20150315', false );

	wp_enqueue_script( 'nautica-jquery-zoom', get_template_directory_uri() . '/js/jquery.zoom.js', array( 'jquery' ), '20151127', false );
	wp_enqueue_script( 'nautica-jquery-gallery', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), '20151127', false );
	wp_enqueue_script( 'nautica-wow', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), '1.1.2', true );
	wp_enqueue_script( 'nautica-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );
	wp_enqueue_script( 'nautica-apps', get_template_directory_uri() . '/js/engo-apps.js', array( 'jquery' ), '20150315', true );
	wp_localize_script( 'nautica-script', 'nauticaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

}
add_action( 'wp_enqueue_scripts', 'nautica_fnc_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_admin_fonts() {
	wp_enqueue_style( 'nautica-lato', nautica_fnc_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'nautica_fnc_admin_fonts' );


/**
 * Implement rick meta box for post and page, custom post types. These 're used with metabox plugins
 */
if( is_admin() ){
	nautica_engo_includes(  get_template_directory() . '/inc/admin/function.php' );
	nautica_engo_includes(  get_template_directory() . '/inc/admin/metabox/*.php' );
	nautica_engo_includes(  get_template_directory() . '/inc/admin/exporter/*.php' );
}
nautica_engo_includes(  get_template_directory() . '/inc/classes/*.php' );
nautica_engo_includes(  get_template_directory() . '/inc/*.php' );
?>
<?php
 global $product;
 $apiUrl = 'http://clothchronicles.com/index.php/api/soap/?wsdl';
 $soapApiKey = 'medma1234';
 $soapUserName = 'apiuser';
add_action( 'woocommerce_order_status_completed', 'my_function' );
/*
 * Do something after WooCommerce sets an order on completed
 */
function my_function($order_id) {
	

	//echo 'hiii'.$order_id;
	//echo '<pre>';
	$order = new WC_Order( $order_id );
	//$items = $order->get_items();
	/*$product = array();
	$product[]
	*/
	
	foreach($order->get_items() as $item)
{                

 $product_variation_id = $item['variation_id'];
  // Check if product has variation.
  if ($product_variation_id) { 
    $product = new WC_Product($item['variation_id']);
    $json[$product->get_sku()] = array (
		'color' => get_post_meta($item['variation_id'], 'attribute_pa_color', true),
        'size' => get_post_meta($item['variation_id'], 'attribute_pa_size', true), // Here appear the name of the product
        'qty' => $item['qty'], // here the quantity of the product
   );
  } else {
    $product = new WC_Product($item['product_id']);
   $json[$product->get_sku()] = array (
		'color' => 'BLACK',
        'size' => 'XL', // Here appear the name of the product
        'qty' => $item['qty'], // here the quantity of the product
   );
  }

  // Get SKU
 // $sku = $product->get_sku();
   
}
	
	/*echo '<pre>';
	print_r($json);
	exit;
	*/
	/*foreach ( $items as $item ) {
		  $product[] = $item['product_id'];
		  $product_name = $item['name'];
			// $product_variation_id = $item['variation_id'];
		  // etc
	}
	*/
	
	
	$arr = array();
	$arr['orderarr']['customer_info']['email']=$order->billing_email;
	$arr['orderarr']['customer_info']['firstname']= $order->billing_first_name;
	$arr['orderarr']['customer_info']['lastname']=$order->billing_last_name;
	$arr['orderarr']['customer_address']['street'] = array('0'=>$order->billing_address_1,'1'=>$order->billing_address_2);
	$arr['orderarr']['customer_address']['city'] = $order->billing_city;
	$arr['orderarr']['customer_address']['country'] = ' ';
	$arr['orderarr']['customer_address']['country_id'] = $order->billing_country;
	$arr['orderarr']['customer_address']['region'] = '';
	$arr['orderarr']['customer_address']['region_id']=$order->billing_state;
	$arr['orderarr']['customer_address']['telephone'] = $order->billing_phone;
	$arr['orderarr']['customer_address']['fax'] = ' ';
	$arr['orderarr']['customer_address']['company'] = $order->billing_company;
	$arr['orderarr']['customer_address']['postcode'] = $order->billing_postcode;
	$arr['orderarr']['customer_address']['payment_method'] = $order->payment_method;
	$arr['orderarr']['product_id'] = $json;
	
	
	//echo '<pre>---/*/*/*';
	//print_r($arr);
	
	ini_set("soap.wsdl_cache_enabled", "0");
	$soap_user = $GLOBALS['soapUserName']; // Soap User
	$soap_key = $GLOBALS['soapApiKey']; // Soap key.
	$usermail = 'corp@medma.in';
	$proxy = new SoapClient($GLOBALS['apiUrl']);
	echo $sessionId = $proxy->login($soap_user, $soap_key);
	$collection = $proxy->call($sessionId, 'sales_order.createordercustom', $arr);
	print_r($collection);		
			
	
	
	exit;
	
	/*
	$billing_address = $order->billing_first_name();
	$billing_address = $order->billing_last_name();
	$billing_address = $order->billing_email();
	$billing_address = $order->billing_address_1();
	$billing_address = $order->billing_address_2();
	$billing_address = $order->billing_city();
	$billing_address = $order->billing_state();
	$billing_address = $order->billing_postcode();
	$billing_address = $order->billing_phone();
	*/
	//$items = $order->get_items();
/*	foreach ( $items as $item ) {
  $product_id = $item['product_id'];
  $product_name = $item['name'];
  $product_variation_id = $item['variation_id'];
  // etc
}*/
	/*print_r($billing_address);
	print_r($order->billing_first_name);
	
	echo '---';
	echo $user_id = get_post_meta( $order_id, '_customer_user', true );
	*/exit;
	// order object (optional but handy)
//	$order = new WC_Order( $order_id );

	// do some stuff here
	
}

add_action('wp_ajax_post_type_search_callback', 'getnearbycustomer');
//for not logged in users
add_action('wp_ajax_nopriv_post_type_search_callback', 'getnearbycustomer');

function getnearbycustomer() {
    $order_email= $_POST['order_email'];
    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $street1= $_POST['street1'];
    $street2= $_POST['street2'];
    $city= $_POST['city'];
    $country= $_POST['country'];
    $state= $_POST['state'];
    $phone= $_POST['phone'];
    $company= $_POST['company'];
    $postcode= $_POST['postcode'];
    $order_id= $_POST['order_id'];
	$order = new WC_Order( $order_id );
		foreach($order->get_items() as $item)
		{                
		 $product_variation_id = $item['variation_id'];

		  // Check if product has variation.
		  if ($product_variation_id) { 
			$product = new WC_Product($item['variation_id']);
		  } else {
			$product = new WC_Product($item['product_id']);
		  }
		   $json[$product->get_sku()] = array (
				'color' => 'Black',
				'size' => 'XL', // Here appear the name of the product
				'qty' => $item['qty'], // here the quantity of the product
		   );
		}
	
	$soap_user = $GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			$email = 'test321@gmail.com';
			
			
			$arr = array();
			$arr['orderarr']['customer_info']['email']= $order_email;//'test321@gmail.com';
			$arr['orderarr']['customer_info']['firstname']=$first_name;//'shshank';
			$arr['orderarr']['customer_info']['lastname']=$last_name;//'mishra';
			$arr['orderarr']['customer_address']['street'] = array('0'=>$street1,'1'=> $street2);
			$arr['orderarr']['customer_address']['city'] = $city;//'lucknow';
			$arr['orderarr']['customer_address']['country'] = ' ';// 'Canada';
			$arr['orderarr']['customer_address']['country_id'] = $country;
			$arr['orderarr']['customer_address']['region'] = ' ';
			$arr['orderarr']['customer_address']['region_id']= $state; //'region id';
			$arr['orderarr']['customer_address']['telephone'] = $phone;//'123456789';
			$arr['orderarr']['customer_address']['fax'] = '123456';//'456789';
			$arr['orderarr']['customer_address']['company'] = $company;
			$arr['orderarr']['customer_address']['postcode'] = $postcode;
			$arr['orderarr']['product_id'] = $json;

			/*echo '<pre>';
			print_r($arr);
			exit;*/
			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.getNearByTailor',$arr);			
			foreach($collection as $key=>$val)
			{
				$tailor_id = $key;
				$tailor_name = $val['name'];
				$tailor_company = $val['company'];
				$tailor_address = $val['street'].'</br>'.$val['city'].', '.$val['postcode'].' '.$val['region'];
				$tailor_distance = $val['distance'];
				
				
				echo '<div class="tailor_detail" id="tailor_'.$tailor_id.'">
						<div class="tailor_info_set">
							<div class="tailor_label">Tailor Name: </div>
							<div class="tailor_name tailor_info">'.$tailor_name.'</div>
						</div>
						<div class="tailor_info_set">
							<div class="tailor_label">Company : </div>
							<div class="tailor_company tailor_info">'.$tailor_company.'</div>
						</div>
						<div class="tailor_info_set">
							<div class="tailor_label">Address: </div>
							<div class="tailor_address tailor_info">'.$tailor_address.'</div>
						</div>
						<div class="tailor_info_set">	
							<div class="tailor_label">Distance: </div>
							<div class="tailor_distance tailor_info">'.$tailor_distance.'</div>
						</div>
						<div class="tailor_info_set">	
							<button class="button" id="assign_button_'.$tailor_id.'" onclick="assign('.$tailor_id.')">Select</button>
							<img id="ajax_loader_'.$tailor_id.'" src="'.admin_url("images/loading.gif").'" style="display:none;">
						</div>
						<div class="assign_tailor_msg" id="assign_tailor_msg_'.$tailor_id.'">
						</div>
					</div>';
			}
exit();
}



add_action('wp_ajax_assign_tailor', 'assigntailor');
//for not logged in users
add_action('wp_ajax_nopriv_assign_tailor', 'assigntailor');

function assigntailor() {
    $id= $_POST['id'];
    $email= $_POST['email'];
    $order_id= $_POST['order_id'];
    $url= $_POST['url'];
	
	
			$soap_user =$GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			//$email = 'test321@gmail.com';
			$data = array();
			$data['info']['email'] = $email;
			$data['info']['tailor_id'] = $id;
			$data['info']['order_id'] = $order_id;
			$data['info']['url'] = $url;

			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.assignCustomer',$data);			
				
	echo $collection;
exit();
}





add_action('wp_ajax_check_measured', 'checkmeasured');
//for not logged in users
add_action('wp_ajax_nopriv_check_measured', 'checkmeasured');

function checkmeasured() {
   // $data= $_POST['variable'];
    $email= $_POST['email'];
	
	
	$soap_user = $GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			$email = $email;//'test321@gmail.com';
			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.checkCustomerMeasured',$email);
				
	echo $collection;
//print_r($collection) ;
   // $output= 'i was returned with ajax';
    //need to echo output and exit here
	//echo '<pre>';
//print_r($collection) ;
exit();
}




add_action('wp_ajax_get_all_measurement', 'getallmeasurement');
//for not logged in users
add_action('wp_ajax_nopriv_get_all_measurement', 'getallmeasurement');

function getallmeasurement() {
    $email= $_POST['email'];
	
	
	$soap_user = $GLOBALS['soapUserName']; // Soap User
			$soap_key = $GLOBALS['soapApiKey']; // Soap key.
			//$usermail ='medmatest100@gmail.com';
			$usermail['user_id'] = 'corp@medma.in';
			//$email = 'test321@gmail.com';
			
			ini_set("soap.wsdl_cache_enabled", "0");
			$proxy = new SoapClient($GLOBALS['apiUrl']);
	
			//$proxy = new SoapClient('http://192.168.0.99/magento/fabric_shop_new/index.php/api/soap/?wsdl');
			$sessionId = $proxy->login($soap_user, $soap_key);
			$collection = $proxy->call($sessionId, 'sales_order.checkCustomerMeasured',$email);
			//~ echo '---<pre>';
			//~ print_r($collection);
			//~ exit;
			//~ if(is_array($collection))
			if($collection)
			{
					$all_measurement = $proxy->call($sessionId, 'sales_order.getCustomerMeasurementsAllCategories',$email);
				/*	echo '<pre>';
						print_r($all_measurement);
					echo '</pre>';
					*/foreach($all_measurement as $key=> $val)
					{
						//echo '//'.$key;
						//exit;
						if($key =='garment_measurements')
						{
							$heading = 'Garment Measurement Detail';
							echo '<div class="garment_measurements_detail">';
							echo '<p><strong><u>'.$heading.'</u></strong></p>';
							
							foreach($val as $key1=> $val1)
							{
								echo '<p><strong>Category : '.$key1.'</strong></p>';
								foreach($val1 as $key2=> $val2)
								{
									echo '<div class="measurement_detail">
											<div class="measurement_lable">
												'.$val2["name"].'
											</div>
											<div class="measurement_value">
												'.$val2["value"].'
											</div>
										</div>';
								}
							}
							echo '</div>';
						}else if($key == 'body_measurements')
						{
							$heading = 'Body Measurement Detail';
							
							echo '<div class="body_measurements_detail">';
							echo '<p><strong><u>'.$heading.'</u></strong></p>';
							
							foreach($val as $key1=> $val1)
							{
								if(is_array($val1))
								{
								echo '<p><strong>'.$key1.'</strong></p>';
								
									foreach($val1 as $key2=> $val2)
									{
									echo '<div class="measurement_detail">
											<div class="measurement_lable">
												'.$key2.'
											</div>
											<div class="measurement_value">
												'.$val2.'
											</div>
										</div>';
									}	
								}else
								{
									echo '<div class="measurement_detail">
											<div class="measurement_lable">
												'.$key1.'
											</div>
											<div class="measurement_value">
												'.$val1.'
											</div>
										</div>';
								}
							}
							echo '</div>';
							
						}
					}
					
					echo '<div id="confirm_button_group"><button class="button satisfy" onclick="satisfy()">Satisfy</button>
							<img id="ajax_loader_satisfy" src="'.admin_url('images/loading.gif').'" style="display:none;">
							
							<button class="button notsatisfy" onclick="notsatisfy()">Not Satisfy</button>
							<img id="ajax_loader_notsatisfy" src="'.admin_url('images/loading.gif').'" style="display:none;"></div>';
					
					
		
			
			}else
			{
				echo 'You have no measurement yet. Please click on Find Tailor button to get measured.';
			}
	
exit();
}


add_action('wp_ajax_customer_satisfy', 'satisfy');
//for not logged in users
add_action('wp_ajax_nopriv_customer_satisfy', 'satisfy');

function satisfy() {
   // $data= $_POST['variable'];
    $order_id= $_POST['order_id'];
	$order = new WC_Order($order_id);
	if (!empty($order)) {
		$order->update_status( 'completed' );
		echo 'Your order has been completed';
	}else{
		echo 'There is some error...';
	}
exit();
}

add_action('wp_ajax_customer_notsatisfy', 'notsatisfy');
//for not logged in users
add_action('wp_ajax_nopriv_customer_notsatisfy', 'notsatisfy');

function notsatisfy() {
	
	echo 'Please click on Find Tailor button and choose your favourite tailor for measurement.';
	exit();
}


add_action('wp_ajax_import_product', 'importproduct');
//for not logged in users
add_action('wp_ajax_nopriv_import_product', 'importproduct');

function importproduct() {
	 $email= $_POST['email'];
		//$customer_email = $_POST['customer_email'];
        $apiuser=$GLOBALS['soapUserName']; //webservice user login
        $apikey = $GLOBALS['soapApiKey']; //webservice user pass
		$remote = $GLOBALS['apiUrl']; // remote address
		$client = new SoapClient($remote); //soap handle
		
		$sessionId = $client->login($apiuser, $apikey);
		$collections = $client->call($sessionId, 'sales_order.showalldata', trim($email));
		$response['response'] = $collections;
		header( "Content-Type: application/json" );
		//echo '+';
		echo json_encode($response);
	/*	echo '+';
		print_r($collections);
		exit;*/
exit();	
}



add_action('wp_ajax_create_category', 'createCategory');
//for not logged in users
add_action('wp_ajax_nopriv_create_category', 'createCategory');

function createCategory() {
	 $category= $_POST['category'];
		echo 'createCategory';
		print_r($category);
		foreach($category as $key=>$val)
		{
			$cat_name = $val;
				$cat_name = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_name);
				$term = get_term_by('name', trim($cat_name) , 'product_cat');
				if(!$term)
				{
					$slug = strtolower($cat_name);
					 $cid = wp_insert_term(
						$cat_name, // the term 
						'product_cat', // the taxonomy
						array(
								'description'=> ' ',
								'slug' => $slug,
								'parent' => '-1'
							)
					);
				}
		}
		echo 'ok';
exit();	
}



add_action('wp_ajax_create_product', 'createSimpleProduct');
//for not logged in users
add_action('wp_ajax_nopriv_create_product', 'createSimpleProduct');

function createSimpleProduct() {
	 $p_name= $_POST['p_name'];
	 $p_cat= $_POST['p_cat'];
	 $p_image= $_POST['p_image'];
	 $p_price= $_POST['p_price'];
	 $p_sku= $_POST['p_sku'];
	 $p_dis= $_POST['p_dis'];
	 $p_short_dis= $_POST['p_short_dis'];
	
	$imgurl = $p_image; 
	global $wpdb;
	/*echo '-->'.*/$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' ORDER BY post_id DESC", $p_sku ) );
	/*echo 'status-->'.*/$product_status = $wpdb->get_var( $wpdb->prepare( "SELECT post_status FROM $wpdb->posts WHERE ID='%d'", $product_id ) );
	
	
	
	if ($product_id == null || $product_status != 'publish')
	{
	// echo 'in if';
		$new_post = array(
						'post_title' => $p_name,
						'post_content' => ' ',
						'post_status' => 'publish',
						'post_type' => 'product'
						// 'post_category' => array(26)
					);
					$sku = $p_sku;
					$price = $p_price;
					$qty = 10;
					$post_id = wp_insert_post($new_post);
					update_post_meta($post_id, '_sku', $sku );
					update_post_meta( $post_id, '_regular_price', $price);
					update_post_meta( $post_id, '_price', $price);
					update_post_meta( $post_id, '_manage_stock', true );
					update_post_meta( $post_id, '_stock', $qty );
						//update_post_meta( $post_id, '_visibility', 'visible' );
					
					if (((int)$product['Qty']) > 0)
					{
						update_post_meta( $post_id, '_stock_status', 'instock');
					}
					update_post_meta( $post_id, '_visibility', 'visible' );
					// assign product to category..
					$cat_name = $p_cat;
					$cat_name = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_name);
					$term = get_term_by('name', trim($cat_name) , 'product_cat');
					if($term)
					{
						wp_set_object_terms($post_id, $term->term_id, 'product_cat');
						
					}
					//	echo 'ok';
					/*--------image upload--------------*/
					require_once(ABSPATH . 'wp-admin/includes/file.php');
					require_once(ABSPATH . 'wp-admin/includes/media.php');
					$thumb_url = $p_image;

					// Download file to temp location
					$tmp = download_url( $thumb_url );

					// Set variables for storage
					// fix file name for query strings
					preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $thumb_url, $matches);
					$file_array['name'] = basename($matches[0]);
					$file_array['tmp_name'] = $tmp;

					// If error storing temporarily, unlink
					if ( is_wp_error( $tmp ) ) {
					@unlink($file_array['tmp_name']);
					$file_array['tmp_name'] = '';
					$logtxt .= "Error: download_url error - $tmp\n";
					}else{
					$logtxt .= "download_url: $tmp\n";
					}

					//use media_handle_sideload to upload img:
					$thumbid = media_handle_sideload( $file_array, $post_id, 'gallery desc' );
					// If error storing permanently, unlink
					if ( is_wp_error($thumbid) ) {
					@unlink($file_array['tmp_name']);
					//return $thumbid;
					$logtxt .= "Error: media_handle_sideload error - $thumbid\n";
					}else{
					$logtxt .= "ThumbID: $thumbid\n";
					}

					set_post_thumbnail($post_id, $thumbid);
					
					/*----------------------*/	
				exit();	
	}
}


add_action('wp_ajax_create_variable_product', 'createVariableProduct');
//for not logged in users
add_action('wp_ajax_nopriv_create_variable_product', 'createVariableProduct');

function createVariableProduct() {
	$p_name= $_POST['p_name'];
	 $p_cat= $_POST['p_cat'];
	 $p_image= $_POST['p_image'];
	 $p_price= $_POST['p_price'];
	 $p_sku= $_POST['p_sku'];
	 $p_dis= $_POST['p_dis'];
	 $p_short_dis= $_POST['p_short_dis'];
	 $p_variation= $_POST['p_variation'];
	 global $wpdb;
	$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' ORDER BY post_id DESC", $p_sku ) );
	$product_status = $wpdb->get_var( $wpdb->prepare( "SELECT post_status FROM $wpdb->posts WHERE ID='%d'", $product_id ) );
	
	
	if ($product_id == null || $product_status != 'publish')
	{
	/* echo '<pre>';
	 print_r($p_variation);
	 
	exit;*/
	echo 'variable';
	$imgurl = $p_image; 
	$new_post = array(
						'post_title' => $p_name,
						'post_content' => ' ',
						'post_status' => 'publish',
						'post_type' => 'product'
						// 'post_category' => array(26)
					);
					$sku = $p_sku;
					$price = $p_price;
					echo $post_id = wp_insert_post($new_post);
					update_post_meta($post_id, '_sku', $sku );
					update_post_meta( $post_id, '_visibility', 'visible' );
					// assign product to category..
					$cat_name = $p_cat;
					$cat_name = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_name);
					$term = get_term_by('name', trim($cat_name) , 'product_cat');
					if($term)
					{
						wp_set_object_terms($post_id, $term->term_id, 'product_cat');
						
					}
					wp_set_object_terms ($post_id,'variable','product_type');
					
		$a =0;				
		foreach($p_variation as $variations)
		{
			foreach($variations as $variation)
			{
				$avail_color[$a] = $variation['color'];
				$avail_size[$a] = $variation['size'];
				$a++;
			}
		}
		// echo '<pre>';
		 print_r($avail_color);
		 print_r($avail_size);
		 print_r(array_unique($avail_color));
		 print_r(array_unique($avail_size));
		// exit;
		$avail_color =  array_unique($avail_color);
		$avail_size =  array_unique($avail_size);
		wp_set_object_terms($post_id, $avail_size, 'pa_size');/*add attribute for products*/
		wp_set_object_terms($post_id, $avail_color, 'pa_color');/*add attribute for products*/
		
		$thedata['pa_size'] = Array(
					'name'=>'pa_size',
					'value'=>'',
					'is_visible' => '1', 
					'is_variation' => '1',
					'is_taxonomy' => '1'
					);
		$thedata['pa_color'] = Array(
					'name'=>'pa_color',
					'value'=>'',
					'is_visible' => '1', 
					'is_variation' => '1',
					'is_taxonomy' => '1'
					);
					
		update_post_meta( $post_id,'_product_attributes',$thedata);/*assign this attribute to new variable products...*/

						foreach ($p_variation as $variations)
						{
							foreach ($variations as $variation)
							{
								$post_name = 'product-' . $post_id . '-color-size-' . $variation['qty'];
								$post_variation_sku = $variation['sku'];
								$my_post = array(
										'post_title' => $post_name,//'Color ' . $color . ' for #' . $post_id,
										'post_name' => $post_name,
										'post_status' => 'publish',
										'post_parent' => $post_id,
										'post_type' => 'product_variation',
										'guid' => home_url() . '/?product_variation=' . $post_name
									);
						
						
								$attID = wp_insert_post($my_post);
								update_post_meta($attID, 'attribute_pa_color', strtolower($variation['color']));
								update_post_meta($attID, 'attribute_pa_size', strtolower($variation['size']));
								//	echo $variation['color'].'-----'.$variation['size'];
					
								//exit;
								update_post_meta($attID, '_price', 100);
								update_post_meta($attID, '_regular_price', 100);
								update_post_meta($attID, '_sku', $post_variation_sku);
								update_post_meta($attID, '_stock', $variation['qty']);
								update_post_meta($attID, '_virtual', 'no');
								update_post_meta($attID, '_downloadable', 'no');
								update_post_meta($attID, '_manage_stock', 'yes');
								update_post_meta($attID, '_stock_status', 'instock');
							//	$i++;
							}
						}
						WC_Product_Variable::sync( $post_id );
										
						echo 'ok';
							
							/*--------image upload--------------*/
						require_once(ABSPATH . 'wp-admin/includes/file.php');
						require_once(ABSPATH . 'wp-admin/includes/media.php');
						$thumb_url = $p_image;

						// Download file to temp location
						$tmp = download_url( $thumb_url );

						// Set variables for storage
						// fix file name for query strings
						preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $thumb_url, $matches);
						$file_array['name'] = basename($matches[0]);
						$file_array['tmp_name'] = $tmp;

						// If error storing temporarily, unlink
						if ( is_wp_error( $tmp ) ) {
						@unlink($file_array['tmp_name']);
						$file_array['tmp_name'] = '';
						$logtxt .= "Error: download_url error - $tmp\n";
						}else{
						$logtxt .= "download_url: $tmp\n";
						}

						//use media_handle_sideload to upload img:
						$thumbid = media_handle_sideload( $file_array, $post_id, 'gallery desc' );
						// If error storing permanently, unlink
						if ( is_wp_error($thumbid) ) {
						@unlink($file_array['tmp_name']);
						//return $thumbid;
						$logtxt .= "Error: media_handle_sideload error - $thumbid\n";
						}else{
						$logtxt .= "ThumbID: $thumbid\n";
						}

						set_post_thumbnail($post_id, $thumbid);
						
						/*----------------------*/		
							
	}
}
?>
