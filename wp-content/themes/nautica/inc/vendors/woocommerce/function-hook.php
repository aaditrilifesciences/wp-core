<?php

function nautica_woocommerce_enqueue_scripts() {
	wp_enqueue_script( 'nautica-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'suggest' ), '20131022', true );
}
add_action( 'wp_enqueue_scripts', 'nautica_woocommerce_enqueue_scripts' );


/**
 * Engo Custom mini basket fragments
 **/
add_filter('add_to_cart_fragments',	'nautica_fnc_woocommerce_header_add_to_cart_fragment' );
//add_filter('woocommerce_add_to_cart_fragments',	'nautica_fnc_woocommerce_header_add_to_cart_fragment' );
function nautica_fnc_woocommerce_header_add_to_cart_fragment( $fragments ){
	global $woocommerce;
	$fragments['#cart .mini-cart-items'] =  sprintf(_n(' <span class="mini-cart-items"> %d  </span> ', ' <span class="mini-cart-items"> %d <em>item</em> </span> ', $woocommerce->cart->cart_contents_count, 'woocommerce'), $woocommerce->cart->cart_contents_count);
 	$fragments['#cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
    return $fragments;
}

/**
 * Mini Basket
 */
if(!function_exists('nautica_fnc_minibasket')){
    function nautica_fnc_minibasket( $style='' ){
        $template =  apply_filters( 'nautica_fnc_minibasket_template', nautica_fnc_wc_mini_cart_templates()  );
        
		switch ($template) {
			case "white_version":
				return get_template_part( 'woocommerce/cart/mini-cart-version-white', $template );
				break;
			case "black_version":
				return get_template_part( 'woocommerce/cart/mini-cart-version-black', $template );
				break;
			case "fit_white_version":
				return get_template_part( 'woocommerce/cart/mini-cart-version-fit-white', $template );
				break;
			case "fit_black_version":
				return get_template_part( 'woocommerce/cart/mini-cart-version-fit-black', $template );
				break;
			default:
				return get_template_part( 'woocommerce/cart/mini-cart-button', $template );
				break;
		}
       	

    }
}

add_action( 'nautica_template_header_right', 'nautica_fnc_minibasket', 30, 0 );

/******************************************************
 * 												   	  *
 * Hook functions applying in archive, category page  *
 *												      *
 ******************************************************/
function nautica_template_woocommerce_main_container_class( $class ){
	if( is_product() ){
		$class .= ' '.  nautica_fnc_theme_options('woocommerce-single-layout') ;
	}else if( is_product_category() || is_archive()  ){ 
		$class .= ' '.  nautica_fnc_theme_options('woocommerce-archive-layout') ;
	}
	return $class;
}

add_filter( 'nautica_template_woocommerce_main_container_class', 'nautica_template_woocommerce_main_container_class' );
function nautica_fnc_get_woocommerce_sidebar_configs( $configs='' ){
	global $post; 
	$right = null; $left = null;
	if(is_archive()) {
		if( is_shop() ) {
			$shop = get_option('woocommerce_shop_page_id');
			$left  =  get_post_meta( $shop, 'nautica_leftsidebar', 1 );
			$right =  get_post_meta( $shop, 'nautica_rightsidebar', 1 );
		}
	}
	if( is_product() ){
		$left  =  nautica_fnc_theme_options( 'woocommerce-single-left-sidebar' );
		$right =  nautica_fnc_theme_options( 'woocommerce-single-right-sidebar' );
	}else if( is_product_category() || is_archive() ){
		$left  =  nautica_fnc_theme_options( 'woocommerce-archive-left-sidebar' );
		$right =  nautica_fnc_theme_options( 'woocommerce-archive-right-sidebar' );
	}
	return nautica_fnc_get_layout_configs( $left, $right );
}

add_filter( 'nautica_fnc_get_woocommerce_sidebar_configs', 'nautica_fnc_get_woocommerce_sidebar_configs', 1, 1 );


function nautica_woocommerce_breadcrumb_defaults( $args ){
	if( is_product_category()) {
		$position_archive_image = nautica_fnc_theme_options('woo-archive-image-position-init');
		if ($position_archive_image == 'breadcrumbs') {
			$thumb = get_woocommerce_term_meta(get_queried_object()->term_id, 'thumbnail_id', true);
			if ($thumb) {
				$img = wp_get_attachment_image_src($thumb, 'full');
				$args['wrap_before'] = '<div class="engo-breadscrumb has-image"><p class="category-banner"><img src="' . $img[0] . '"></p><div class="container-fluid"><ol class="engo-woocommerce-breadcrumb breadcrumb container" ' . (is_single() ? 'itemprop="breadcrumb"' : '') . '>';
				$args['wrap_after'] = '</ol></div></div>';
			} else {
				$args['wrap_before'] = '<div class="engo-breadscrumb"><div class="container"><ol class="engo-woocommerce-breadcrumb breadcrumb" ' . (is_single() ? 'itemprop="breadcrumb"' : '') . '>';
				$args['wrap_after'] = '</ol></div></div>';
			}
		} else {
			$args['wrap_before'] = '<div class="engo-breadscrumb"><div class="container"><ol class="engo-woocommerce-breadcrumb breadcrumb" ' . (is_single() ? 'itemprop="breadcrumb"' : '') . '>';
			$args['wrap_after'] = '</ol></div></div>';
		}
	} elseif (is_shop()) {
			$shop = get_option( 'woocommerce_shop_page_id' );
			$disable = get_post_meta( $shop, 'nautica_disable_breadscrumb', 1 );
			if($disable){
				$args['wrap_before'] = '<div class="engo-breadscrumb"><div class="container"><ol class="engo-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
				$args['wrap_after'] = '</ol></div></div>';
			} else {
				$bgimage = get_post_meta( $shop, 'nautica_image_breadscrumb', 1 );
				$img = wp_get_attachment_image_src( $bgimage, 'full' );
				$args['wrap_before'] = '<div class="engo-breadscrumb has-image"><p class="category-banner"><img src="'.$img[0].'"></p><div class="container-fluid"><ol class="engo-woocommerce-breadcrumb breadcrumb container" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
				$args['wrap_after'] = '</ol></div></div>';
			}
	} else {
		$args['wrap_before'] = '<div class="engo-breadscrumb"><div class="container"><ol class="engo-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
		$args['wrap_after'] = '</ol></div></div>';
	}
	return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'nautica_woocommerce_breadcrumb_defaults' );
add_action( 'nautica_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

function nautica_fnc_woocommerce_archive_image(){
	$position_archive_image = nautica_fnc_theme_options('woo-archive-image-position-init');
	if($position_archive_image == 'before_list') {
		$thumb = get_woocommerce_term_meta(get_queried_object()->term_id, 'thumbnail_id', true);
		if ($thumb) {
			$img = wp_get_attachment_image_src($thumb, 'full');
			echo '<p class="category-banner"><img src="' . $img[0] . '"></p>';

		}
	}
}
add_action( 'woocommerce_archive_description', 'nautica_fnc_woocommerce_archive_image', 5 );

/** Change woo loop shop per page by engo_options **/
function products_per_achive_page( $count = 12 ) {
	if(nautica_fnc_wc_items_perpage()) :
		return nautica_fnc_wc_items_perpage();
	else :
		return $count;
	endif;
}
add_filter( 'loop_shop_per_page', 'products_per_achive_page', 20 );


/**
 * Remove show page results which display on top left of listing products block.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );


function nautica_fnc_woocommerce_after_shop_loop_start(){
	echo '<div class="products-bottom-wrap clearfix">';
}

add_action( 'woocommerce_after_shop_loop', 'nautica_fnc_woocommerce_after_shop_loop_start', 1 );

function nautica_fnc_woocommerce_after_shop_loop_after(){
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', 'nautica_fnc_woocommerce_after_shop_loop_after', 10000 );


/**
 * Wrapping all elements are wrapped inside Div Container which rendered in woocommerce_before_shop_loop hook
 */
function woocommerce_before_shop_loop_start(){
	echo '<div class="products-top-wrap clearfix">';
}

function woocommerce_before_shop_loop_end(){
	echo '</div>';
}


add_action( 'woocommerce_before_shop_loop', 'woocommerce_before_shop_loop_start' , 0 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_before_shop_loop_end' , 1000 );


function nautica_fnc_woocommerce_display_modes(){

	echo '<form class="display-mode" method="get">';
		echo '<button title="'.esc_html__('Grid', 'nautica').'" class="btn " value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';
		echo '<button title="'.esc_html__( 'List', 'nautica' ).'" class="btn " value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';
	echo '</form>'; 
}

add_action( 'woocommerce_before_shop_loop', 'nautica_fnc_woocommerce_display_modes' , 1 );


/**
 * Processing hook layout content
 */
function nautica_fnc_layout_main_class( $class ){
	$sidebar = nautica_fnc_theme_options( 'woo-sidebar-show', 1 ) ;
	if( is_single() ){
		$sidebar = nautica_fnc_theme_options('woo-single-sidebar-show'); ;
	}
	else {
		$sidebar = nautica_fnc_theme_options('woo-sidebar-show');
	}

	if( $sidebar ){
		return $class;
	}

	return 'col-lg-12 col-md-12 col-xs-12';
}
add_filter( 'nautica_woo_layout_main_class', 'nautica_fnc_layout_main_class', 4 );



/**
 * Add action to init parameter before processing
 */

function nautica_fnc_before_woocommerce_init(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'nautica_woo_display', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['nautica_woo_display'] = trim($_GET['display']);
	}
}

add_action( 'init', 'nautica_fnc_before_woocommerce_init' );


/***************************************************
 * 												   *
 *     Engo hock for product items achive page     *
 *												   *
 ***************************************************/


/** Image hover with rotate **/
function nautica_fnc_add_product_placeholder_image() {
	global $product;
	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		$attachment_id = $attachment_ids[0];
		$image_title = esc_attr( get_the_title( $attachment_id ) );
		$image       = wp_get_attachment_image( $attachment_id, 'shop_catalog', 0, $attr = array(
				'title' => $image_title,
				'alt'   => $image_title,
				'class' => 'image-catalog-hover'
		) );

		echo $image;
	}
}
add_action( 'woocommerce_before_shop_loop_item_title','nautica_fnc_add_product_placeholder_image',15);

/***************************************************
 * 												   *
 * Hook functions applying in single product page  *
 *												   *
 ***************************************************/


/** 
 * Remove review to products tabs. and display this as block below the tab.
 */
function nautica_fnc_woocommerce_product_tabs( $tabs ){

	if( isset($tabs['reviews']) ){
		unset( $tabs['reviews'] ); 
	}
	return $tabs;
}
//add_filter( 'woocommerce_product_tabs','nautica_fnc_woocommerce_product_tabs', 99 );

function nautica_rename_tabs( $tabs ) {
	global $product;
	if($product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
		$tabs['additional_information']['title'] = esc_html__( 'Info', 'nautica' );	// Rename the additional information tab
	}


	return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'nautica_rename_tabs', 98 );
 
 /**
  * Rehook product review products in woocommerce_after_single_product_summary
  */
function nautica_fnc_product_reviews(){
	return comments_template();
}
//add_action('woocommerce_after_single_product_summary','nautica_fnc_product_reviews', 10 );

/**
 *
 */
function nautica_woocommerce_scripts(){
	wp_enqueue_script( 'engotheme-jquery-zoom', get_template_directory_uri() . '/js/jquery.zoom.js', array( 'jquery' ), '20151128', false );
}
/**
 *
 */
function nautica_woocommerce_show_product_images(){
	$layout = apply_filters( 'nautica_woocommerce_show_product_images', 'product-image' );
	if(is_file( get_template_directory().'/inc/vendors/woocommerce/templates/product-images/'.$layout.'.php')){
		get_template_part('/inc/vendors/woocommerce/templates/product-images/'.$layout);
	}
}
/**
 *
 */
function nautica_woocommerce_show_product_thumbnails(){
	$layout = apply_filters( 'nautica_woocommerce_show_product_thumbnails', 'product-thumbnails' );
	if(is_file( get_template_directory().'/inc/vendors/woocommerce/templates/product-images/'.$layout.'.php')){
		get_template_part('/inc/vendors/woocommerce/templates/product-images/'.$layout);
	}

}
add_action( 'wp_enqueue_scripts', 'nautica_woocommerce_scripts', 999 );

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);


add_action('woocommerce_before_single_product_summary', 'nautica_woocommerce_show_product_images', 20);
add_action('woocommerce_product_thumbnails', 'nautica_woocommerce_show_product_thumbnails', 20);

function nautica_woo_show_product_thumbnails( $layout ){
	$layout = $layout.'-v1';
	return $layout;
}

add_filter( 'nautica_woocommerce_show_product_thumbnails', 'nautica_woo_show_product_thumbnails'  );


function nautica_woo_show_product_images( $layout ){
	$layout = $layout.'-v1';
	return $layout;
}

add_filter( 'nautica_woocommerce_show_product_images', 'nautica_woo_show_product_images'  );


function nautica_pre_get_quantity_input($args = array()) {
	global $product;
	if($product) {
		$product_id = absint( $product->id );
		$args['product_id'] = $product_id;
	}
	return $args;
}
add_filter('woocommerce_quantity_input_args','nautica_pre_get_quantity_input',5);

function nautica_single_product_variation_quantity(){
	global $product;
	echo '<div class="selector-wrapper"><label for="quantity">'.esc_html__('Qty', 'nautica').'</label>';
	woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );
	echo '</div>';
}
add_action('nautica_woocommerce_quantity','nautica_single_product_variation_quantity', 10);

function nautica_single_product_variation_add_to_cart_button() {
	global $product;
	?>

	<div class="variations_button">
		<button type="submit" data-product_id="<?php echo esc_attr( $product->id ); ?>" data-product_sku="<?php echo esc_attr( $product->sku ); ?>" data-quantity="1" class="product-type-variable add_to_cart_button single_add_to_cart_button variation_add_to_cart_button button alt"><i class="cart-icon"></i> <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
		<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
		<input type="hidden" name="variation_id" class="variation_id" value=""/>
	</div>
	<?php
}
add_action('nautica_woocommerce_variation','nautica_single_product_variation_add_to_cart_button', 20);

function nautica_wishlist_button_show() {
	if( class_exists( 'YITH_WCWL' ) ) {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
}
add_action('nautica_woocommerce_actions_after_add_to_cart_button','nautica_wishlist_button_show', 30);

function nautica_compare_button_show() {
	global $product;
	if( class_exists( 'YITH_Woocompare' ) ) {
		$action_add = 'yith-woocompare-add-product';
		$url_args = array(
				'action' => $action_add,
				'id' => $product->id
		);
		?>
		<div class="yith-compare">
			<a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>" class="compare" data-product_id="<?php echo esc_attr($product->id); ?>">
				<em class="fa fa-exchange"></em>
				<!-- <span><?php //echo esc_html__('add to compare', 'nautica'); ?></span> -->
			</a>
		</div>
		<?php
	}
}
add_action('nautica_woocommerce_actions_after_add_to_cart_button','nautica_compare_button_show', 40);


//add_action('nautica_woocommerce_variation','woocommerce_single_variation', 10);




/**
 * Get a coupon label
 *
 * @access public
 * @param string $coupon
 */
function nautica_wc_cart_totals_coupon_label( $coupon ) {
	if ( is_string( $coupon ) )
		$coupon = new WC_Coupon( $coupon );

	echo apply_filters( 'woocommerce_cart_totals_coupon_label', esc_html__( 'Coupon:', 'woocommerce' ) . ' <div class="engo-cart-coupon-code-added"><span>' . $coupon->code.'</span> <a href="' . esc_url( add_query_arg( 'remove_coupon', urlencode( $coupon->code ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? WC()->cart->get_checkout_url() : WC()->cart->get_cart_url() ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->code ) . '">' . esc_html__( '[Remove]', 'woocommerce' ) . '</a></div>' , $coupon );
}

/**
 * Get a coupon value
 *
 * @access public
 * @param string $coupon
 */
function nautica_wc_cart_totals_coupon_html( $coupon ) {
	if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
	}

	$value  = array();

	if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->code, WC()->cart->display_cart_ex_tax ) ) {
		$discount_html = '-' . wc_price( $amount );
	} else {
		$discount_html = '';
	}

	$value[] = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_html, $coupon );

	if ( $coupon->enable_free_shipping() ) {
		$value[] = esc_html__( 'Free shipping coupon', 'woocommerce' );
	}

	// get rid of empty array elements
	$value = array_filter( $value );
	$value = implode( ', ', $value );

	echo apply_filters( 'woocommerce_cart_totals_coupon_html', $value, $coupon );
}


remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action('nautica_do_checkout_payment', 'woocommerce_checkout_payment', 20);

/** Social share button **/
add_action('woocommerce_share','nautica_fnc_single_social_share',30);

add_filter( 'woocommerce_get_availability', 'custom_get_stock', 1, 2);
function custom_get_stock( $availability, $_product ) {
	if ( !$_product->is_in_stock() ) $availability['availability'] = esc_html__('Backorder', 'woocommerce');
	return $availability;
}
/**
 * Login form
 **/
function nautica_wc_before_login_form() {
	echo '<p>'. esc_html__("Hello, welcome to your account.", 'nautica').'</p>';
}
add_action('woocommerce_login_form_start', 'nautica_wc_before_login_form', 10);

function nautica_wc_login_with_social_button() {
	echo '<div class="engo-social-login row">';
	echo '<div class="col-sm-6 col-xs-12"><a class="engo-social-button engo-social-fb" href="javascript://"><i class="fa fa-facebook"></i> '.esc_html__('Sign in with Facebook', 'nautica').'</a></div>';
	echo '<div class="col-sm-6 col-xs-12"><a class="engo-social-button engo-social-tw" href="javascript://"><i class="fa fa-twitter"></i> '.esc_html__('Sign in with Twitter', 'nautica').'</a></div>';
	echo '</div>';
}
add_action('woocommerce_login_form_start', 'nautica_wc_login_with_social_button', 15);

/**
 * Register form
 **/
function nautica_wc_before_register_form() {
	echo '<p>'. esc_html__("Create your own Rimbus account.", 'nautica').'</p>';
}
add_action('woocommerce_register_form_start', 'nautica_wc_before_login_form', 10);
?>