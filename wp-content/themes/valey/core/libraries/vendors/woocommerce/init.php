<?php
/**
 * Initialize woocommerce.
 *
 * @since   1.0.0
 * @package Valey
 */

if ( ! class_exists( 'WooCommerce' ) ) return;

// Add this theme support woocommerce
add_theme_support( 'woocommerce' );

// Add image size for masonry style
add_image_size( 'wc-masonry-square', 390, 390, true );
add_image_size( 'wc-masonry-rectangle', 390, 780, true );

// Remove WooCommerce default styles.
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Product archive
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Remove result count & ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Change price's position in single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

// Change meta's position in single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 21 );

// Change layout of cart page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

// Checkout form
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// Change product thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Change number of products displayed per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . cs_get_option( 'wc-per-page' ) . ';' ), 20 );

/**
 * Change pagination position.
 *
 * @since  1.0
 */
$layout = cs_get_option( 'wc-layout' );
if ( $layout != 'no-sidebar' ) {
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
	add_action( 'fx_wc_pagination', 'woocommerce_pagination' );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * @since 1.0.0
 */
function fx_valey_wc_locate_template( $template, $template_name, $template_path ) {
	global $woocommerce;

	$_template = $template;

	if ( ! $template_path ) $template_path = $woocommerce->template_url;

	$theme_path = get_template_directory() . '/core/libraries/vendors/woocommerce/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Modification: Get the template from this folder, if it exists
	if ( ! $template && file_exists( $theme_path . $template_name ) )
	$template = $theme_path . $template_name;

	// Use default template
	if ( ! $template )
	$template = $_template;

	// Return what we found
	return $template;
}
function fx_valey_wc_template_parts( $template, $slug, $name ) {
	$theme_path  = get_template_directory() . '/core/libraries/vendors/woocommerce/templates/';
	if ( $name ) {
		$newpath = $theme_path . "{$slug}-{$name}.php";
	} else {
		$newpath = $theme_path . "{$slug}.php";
	}
	return file_exists( $newpath ) ? $newpath : $template;
}
add_filter( 'woocommerce_locate_template', 'fx_valey_wc_locate_template', 10, 3 );
add_filter( 'wc_get_template_part', 'fx_valey_wc_template_parts', 10, 3 );

/**
 * Register widget area for wc.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_wc_register_sidebars' ) ) {
	function fx_valey_wc_register_sidebars() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'WC Promo', 'valey' ),
				'id'            => 'wc-promo',
				'description'   => esc_html__( 'The promo area for woocommerce, It will display in archive product page', 'valey' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Sidebar', 'valey' ),
				'id'            => 'wc-primary',
				'description'   => esc_html__( 'The primary sidebar for woocommerce.', 'valey' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}
}
add_action( 'widgets_init', 'fx_valey_wc_register_sidebars' );
   
/**
 * Disable page title on archive product.
 *
 * @since 1.0.0
 */
function fx_valey_wc_disable_page_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title', 'fx_valey_wc_disable_page_title' );

/**
 * Custom add to wishlist button.
 *
 * @since 1.0.0
 */
function fx_valey_wc_wishlist_button() {
	global $product, $yith_wcwl, $fxshortcodes;

	// Get product hover style
	$hover = $fxshortcodes ? $fxshortcodes['style'] : cs_get_option( 'wc-hover-style' );
	if ( ! class_exists( 'YITH_WCWL' ) ) return;

	$url          = $yith_wcwl->get_wishlist_url();
	$product_type = $product->product_type;
	$exists       = $yith_wcwl->is_product_in_wishlist( $product->id );
	$classes      = 'class="add_to_wishlist"';
	$add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
	$browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
	$added        = get_option( 'yith_wcwl_product_added_text' );

	if ( '1' == $hover ) {
		$output  = '<div class="yith-wcwl-add-to-wishlist bgb bghp btr-52 db tu f__mont ls__1 ts__03 add-to-wishlist-' . esc_attr( $product->id ) . '">';
			$output .= '<div class="yith-wcwl-add-button';
				$output .= $exists ? ' hide" style="display:none;"' : ' show"';
				$output .= '><a href="' . esc_url( htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->id ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="fa fa-heart mr__10 ml__30"></i>' . esc_html( $add ) . '</a>';
				$output .= '<i class="fa fa-spinner fa-spinner ajax-loading" style="visibility:hidden"></i>';
			$output .= '</div>';

			$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url( $url ) . '"><i class="fa fa-check mr__10 ml__30"></i>' . esc_html( $added ) . '</a></div>';
			$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '"><i class="fa fa-gift mr__10 ml__30"></i>' . esc_html( $browse ) . '</a></div>';
		$output .= '</div>';
	} else if ( '2' == $hover || '3' == $hover ) {
		$output  = '<div class="yith-wcwl-add-to-wishlist bgb bghp bs-58 db ts__03 pr add-to-wishlist-' . esc_attr( $product->id ) . '">';
			$output .= '<div class="yith-wcwl-add-button';
				$output .= $exists ? ' hide" style="display:none;"' : ' show"';
				$output .= '><a href="' . esc_url( htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->id ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="fa fa-heart"></i><span class="tooltips cw f__mont fs__12 ts__03 pa">' . esc_html__( 'Add To Wishlist', 'valey' ) . '</span></a>';
				$output .= '<i class="fa fa-spinner fa-spinner ajax-loading" style="visibility:hidden"></i>';
			$output .= '</div>';

			$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url( $url ) . '"><i class="fa fa-check"></i><span class="tooltips cw f__mont fs__12 ts__03 pa">' . esc_html( $added ) . '</span></a></div>';
			$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '"><i class="fa fa-gift"></i><span class="tooltips cw f__mont fs__12 ts__03 pa">' . esc_html( $browse ) . '</span></a></div>';
		$output .= '</div>';
	} else {

	}

	return $output;
}

/**
 * Add button product quick view after add to cart.
 *
 * @since 1.0.0
 */
function fx_valey_add_buton() {
	global $post, $fxshortcodes;

	// Get product hover style
	$hover = $fxshortcodes ? $fxshortcodes['style'] : cs_get_option( 'wc-hover-style' );

	if ( '1' == $hover ) {
		// Quick view
		echo '<a class="btn-quickview bgb bghp btr-52 db tu f__mont cw ls__1" href="#0" data-prod="' . esc_attr( $post->ID ) . '"><i class="fa fa-eye mr__10 ml__30"></i><span>' . esc_html__( 'Quick View', 'valey' ) . '</span></a>';

		// Wishlist
		echo fx_valey_wc_wishlist_button();
	} else if ( '2' == $hover || '3' == $hover ) {
		// Quick view
		echo '<a class="btn-quickview bgb bghp bs-58 db cw pr" href="#0" data-prod="' . esc_attr( $post->ID ) . '"><i class="fa fa-eye"></i><span class="tooltips cw f__mont fs__12 ts__03 pa">' . esc_html__( 'Quick View', 'valey' ) . '</span></a>';

		// Wishlist
		echo fx_valey_wc_wishlist_button();
	} else {

	}
}
add_action( 'woocommerce_after_shop_loop_item', 'fx_valey_add_buton' );

/**
 * Custom pagination to display product per page.
 *
 * @since 1.0.0
 */
function fx_valey_wc_before_pagination() {
	// Get wc layout
	$layout = cs_get_option( 'wc-layout' );

	$class = '';

	if ( $layout != 'no-sidebar' ) {
		$class = 'hide';
	}

	echo '<div class="flex between-md center-xs middle-xs ' . $class . '">';
}
function fx_valey_wc_after_pagination() {
	echo '</div>';
}
add_action( 'woocommerce_after_shop_loop', 'fx_valey_wc_before_pagination', 5 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 7 );
add_action( 'woocommerce_after_shop_loop', 'fx_valey_wc_after_pagination', 10 );

/**
 * Custom the product title in the product loop.
 *
 * @since 1.0.0
 */
function fx_valey_wc_product_title() {
	echo '<h3 class="product-title pt__20 mt__30 pr fs__14"><a class="cb chp" href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
}
add_action( 'woocommerce_shop_loop_item_title', 'fx_valey_wc_product_title', 15 );

/**
 * Shopping cart.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_wc_shopping_cart' ) ) {
	function fx_valey_wc_shopping_cart() {
		global $woocommerce;
		$output = '';

		$output .= '<div class="fx-cart pr ml__40">';
			$output .= '<a class="pr" href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'valey' ) . '">';
				$output .= '<img src="' . FX_VALEY_URL . '/assets/images/cart.svg" width="16" height="16" alt="Cart" />';
				$output .= '<span class="pa count bgp br__50 cw tc f__mont">' . esc_html( $woocommerce->cart->get_cart_contents_count() ) . '</span>';
			$output .= '</a>';
			$output .= '<div class="widget_shopping_cart_content"></div>';
		$output .= '</div>';

		return apply_filters( 'fx_valey_wc_shopping_cart', $output );
	}
}

/**
 * Add promo sidebar to before archive page.
 *
 * @since 1.0.0
 */
function fx_valey_wc_promo_sidebar() {
	if ( is_active_sidebar( 'wc-promo' ) ) {
		echo '<div class="fx-promo flex center-xs between-xs">';
			dynamic_sidebar( 'wc-promo' );
		echo '</div>';
	}
}
add_action( 'woocommerce_before_shop_loop', 'fx_valey_wc_promo_sidebar' );

/**
 * Load mini cart on header.
 *
 * @since 1.0.0
 */
function fx_valey_wc_render_mini_cart() {
	$output = '';
	wc_clear_notices();

	ob_start();
		$args['list_class'] = '';
		wc_get_template( 'cart/mini-cart.php' );
	$output = ob_get_clean();

	$result = array(
		'cart_total' => WC()->cart->cart_contents_count,
		'cart_html'  => $output
	);
	echo json_encode( $result );
	exit;
}
add_action( 'wp_ajax_load_mini_cart', 'fx_valey_wc_render_mini_cart' );
add_action( 'wp_ajax_nopriv_load_mini_cart', 'fx_valey_wc_render_mini_cart' );

/**
 * Customize product quick view.
 *
 * @since  1.0
 */
function fx_valey_wc_quickview() {
	// Get product from request.
	if ( isset( $_POST['product'] ) && (int) $_POST['product'] ) {
		global $post, $product, $woocommerce;

		$id      = ( int ) $_POST['product'];
		$post    = get_post( $id );
		$product = get_product( $id );

		if ( $product ) {
			// Get quickview template.
			require_once FX_VALEY_PATH . '/core/libraries/vendors/woocommerce/templates/content-quickview-product.php';
		}
	}

	exit;
}
add_action( 'wp_ajax_fx_quickview', 'fx_valey_wc_quickview' );
add_action( 'wp_ajax_nopriv_fx_quickview', 'fx_valey_wc_quickview' );

/**
 * Add some script to header.
 *
 * @since 1.0.0
 */
function fx_valey_wc_header_script() {
	?>
	<script>
		var FXAjaxURL = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';
		var FXSiteURL = '<?php echo get_site_url() . '/index.php'; ?>';
	</script>
	<?php
}
add_action( 'wp_head', 'fx_valey_wc_header_script' );

/**
 * Customize WooCommerce image dimensions.
 *
 * @since  1.0
 */
function fx_valey_wc_customize_image_dimensions() {
	global $pagenow;

	if ( $pagenow != 'themes.php' || ! isset( $_GET['activated'] ) ) {
		return;
	}

	// Update WooCommerce image dimensions.
	update_option(
		'shop_catalog_image_size',
		array( 'width' => '270', 'height' => '345', 'crop' => 1 )
	);

	update_option(
		'shop_single_image_size',
		array( 'width' => '810', 'height' => '1035', 'crop' => 1 )
	);

	update_option(
		'shop_thumbnail_image_size',
		array( 'width' => '60', 'height' => '60', 'crop' => 1 )
	);
}
add_action( 'admin_init', 'fx_valey_wc_customize_image_dimensions', 1 );

/**
 * Render page heading for woocommerce.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'fx_valey_wc_head' ) ) {
	function fx_valey_wc_head() {
		$output = $mask = '';

		// WooCommcerce page title background
		$wc_pagehead_bg = cs_get_option( 'wc-pagehead-bg' );
		if ( ! empty( $wc_pagehead_bg['image'] ) ) {
			$mask = ' mask';
		}

		$output .= '<div id="fx-page-head" class="head-wc pt__75 pr tc' . esc_attr( $mask ) . '">';
			$output .= '<div class="fx-container pr">';
				$output .= fx_valey_page_sub_title();
				$output .= fx_valey_page_title();
				$output .= fx_valey_breadcrumb();
			$output .= '</div>';
		$output .= '</div>';

		return apply_filters( 'fx_valey_wc_head', $output );
	}
}

/**
 * Change product thumbnail size.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		global $post, $fxshortcodes;

		// Get product list style
		$style = $fxshortcodes ? $fxshortcodes['layout'] : cs_get_option( 'wc-style' );

		// Get product image size for masonry layour
		$size = get_post_meta( get_the_ID(), '_custom_wc_options', true );

		if ( has_post_thumbnail() ) {
			if ( 'grid' == $style ) {
				echo get_the_post_thumbnail( $post->ID, 'shop_catalog' );
			} else {
				foreach ( $size as $value ) {
					echo get_the_post_thumbnail( $post->ID, 'wc-masonry-' . $value );
				}
			}
		} elseif ( wc_placeholder_img_src() ) {
			echo wc_placeholder_img( $size );
		}
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 15 );