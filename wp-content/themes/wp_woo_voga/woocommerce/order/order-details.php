<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$order = wc_get_order( $order_id );

?>
<header class="title-wrapper"><h3 class="heading-title"><?php _e( 'Order Details', 'wpdance' ); ?></h3></header>
<table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><span class="nobr"><?php _e( 'Product', 'wpdance' ); ?></span></th>
			<th class="product-total"><span class="nobr"><?php _e( 'Total', 'wpdance' ); ?></span></th>
		</tr>
	</thead>
	<tfoot>
		<?php
			foreach ( $order->get_order_item_totals() as $key => $total ) {
				?>
				<tr>
					<th scope="row"><?php echo $total['label']; ?></th>
					<td><?php echo $total['value']; ?></td>
				</tr>
				<?php
			}
		?>
	</tfoot>
	<tbody>
		<?php
		foreach( $order->get_items() as $item_id => $item ) {
			wc_get_template( 'order/order-details-item.php', array(
				'order'   => $order,
				'item_id' => $item_id,
				'item'    => $item,
				'product' => apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item )
			) );
		}

		do_action( 'woocommerce_order_items_table', $order );
		?>
	</tbody>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>