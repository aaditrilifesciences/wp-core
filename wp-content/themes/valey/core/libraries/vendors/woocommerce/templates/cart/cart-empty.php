<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>

<div class="tc cart-empty bgb cw fx-col-md-6 fx-col-md-offset-3 pt__50 pb__50 mt__100 mb__100">
	<p>
		<?php _e( 'Your cart is currently empty.', 'valey' ) ?>
	</p>

	<?php do_action( 'woocommerce_cart_is_empty' ); ?>

	<p class="return-to-shop mg__0">
		<a class="dib f__mont fs__12 cw pr__20 pl__20 tu bgp bghp" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Return To Shop', 'valey' ) ?>
		</a>
	</p>
</div>
