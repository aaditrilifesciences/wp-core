<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart product-simple-form" method="post" enctype='multipart/form-data'>
		<div class="product-signle-options">
			<?php
			if ( ! $product->is_sold_individually() ) {
					/**
					 * engo_woocommerce_variation hook. Used to output the quantity box.
					 *
					 * @hooked engo_single_variation_quantity
					 */
					do_action( 'nautica_woocommerce_quantity' );

			}
			?>
		</div>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<div class="product-single-action">
			<?php do_action( 'nautica_woocommerce_actions_before_add_to_cart_button' ); ?>
			<div class="variations_button">
				<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
				<button type="submit" data-product_id="<?php echo esc_attr( $product->id ); ?>" data-product_sku="<?php echo esc_attr( $product->sku ); ?>" data-quantity="1"  class="button product_type_simple add_to_cart_button ajax_add_to_cart product_type_simple engo-add-to-cart-btn button alt single_add_to_cart_button"><i class="cart-icon"></i> <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			</div>
			<?php do_action( 'nautica_woocommerce_actions_after_add_to_cart_button' ); ?>
			<div class="clearfix"></div>
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php endif; ?>
