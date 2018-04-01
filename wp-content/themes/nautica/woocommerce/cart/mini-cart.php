<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="cart_list <?php echo esc_attr( $args['list_class'] ); ?>">

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>
					<div class="media widget-product">
						<a href="<?php echo get_permalink( $product_id ); ?>" class="image pull-left">
							<?php echo trim($thumbnail); ?>
						</a>
						<div class="cart-main-content media-body">
							<h3 class="name">
								<a href="<?php echo get_permalink( $product_id ); ?>">
									<?php echo trim($product_name); ?>
								</a>
							</h3>
							<div class="cart-item">
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">'.esc_html__('QTY: ','nautica') . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							</div>

							<?php
							    echo apply_filters(
							        'woocommerce_cart_item_remove_link',
							        sprintf(
							            '<a href="%s" class="remove" title="%s">&times;</a>',
							            esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ),
							            esc_html__( 'Remove this item', 'woocommerce' )
							        ),
							        $cart_item_key
							    );
							?>


						</div>
						<div class="clearfix"></div>
					</div>
					<?php
				}
			}
		?>
		

	<?php else : ?>

		<div class="empty"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></div>

	<?php endif; ?>

</div><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<p class="total"><strong><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons clearfix">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="btn btn-default pull-left wc-forward"><span><?php esc_html_e( 'View Cart', 'woocommerce' ); ?></span></a>
		<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="btn btn-primary pull-right checkout wc-forward"><span><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></span></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>