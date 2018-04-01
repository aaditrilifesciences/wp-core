<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
	<div class="">
		<ul id="order_step" class="step process-steps process-steps-v1 process-3 clearfix">
			<li class="step_current first">
				<a href="#">
					<span><i class="icons icons-lg radius-x icons-darker icons-bodered">01</i> <br><?php esc_html_e('SHOPPING CART','nautica'); ?></span>
				</a>
			</li>
			<li class=" second">
				<a href="#">
					<span><i class="icons icons-lg radius-x icons-darker icons-bodered">02</i><br><?php esc_html_e('CHECK OUT','nautica'); ?></span></a>
			</li>
			<li class="step_todo last" id="step_end">
				<span><i class="icons icons-lg radius-x icons-darker icons-bodered">03</i><br><?php esc_html_e('ORDER COMPLETE','nautica'); ?></span>
			</li>
		</ul>
	</div>
<?php
wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<div class="widget">

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<div class="table-responsive">

<table class="table cart">
	<thead>
		<tr>
			<th style="width: 7%">&nbsp;</th>
			<th class="product-name" colspan="2"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
						?>
					</td>

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() ) {
								echo trim($thumbnail);
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
							}
						?>
					</td>

					<td class="product-name">
						<?php
							if ( ! $_product->is_visible() ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</td>

					<td class="product-price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity );
						?>
					</td>

					<td class="product-subtotal price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions" style="padding: 0;">
				<div class="clearfix cart-button-group">
					<?php if ( WC()->cart->coupons_enabled() ) { ?>
						<div class="coupon coupon-form col-lg-6 col-sm-6">
							<label for="coupon_code"><?php esc_html_e( 'Coupon', 'woocommerce' ); ?>:</label>
							<div class="coupon-input-text col-lg-8 col-sm-6">
								<input type="text" name="coupon_code" class="input-text " id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'woocommerce' ); ?>" />
							</div>
							<div class="coupon-submit-btn col-lg-4 col-sm-6">
								<input type="submit" class="btn btn-primary-border" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'woocommerce' ); ?>" />
							</div>
							<?php do_action('woocommerce_cart_coupon'); ?>
						</div>
					<?php } ?>
					<div class="update-cart-btn col-lg-6 col-sm-6">
						<input type="submit" class="btn btn-primary" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_actions' ); ?>
						<?php wp_nonce_field( 'woocommerce-cart' ); ?>
					</div>
				</div>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

</div>

<div class="cart-collaterals widget">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>


</div>



<?php do_action( 'woocommerce_after_cart' ); ?>