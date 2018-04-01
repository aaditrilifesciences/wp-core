<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="engo-cart-collaterals row">
	<div class="engo-shipping-calculator col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h4><?php esc_html_e( 'Calculate shipping', 'woocommerce' ); ?></h4>
		<?php if ( WC()->cart->needs_shipping() ) : ?>
			<?php woocommerce_shipping_calculator(); ?>
		<?php elseif ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
		<?php  endif; ?>
	</div>
	<div class="cart_totals col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
		<?php do_action( 'woocommerce_before_cart_totals' ); ?>
			<h4><?php esc_html_e( 'Cart Totals', 'woocommerce' ); ?></h4>
			<div class="cart-table">
				<div class="cart-tr cart-subtotal">
					<div class="cart-th"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
					<div class="cart-td"><?php wc_cart_totals_subtotal_html(); ?></div>
				</div>
				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<div class="cart-tr cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<div class="cart-th"><?php nautica_wc_cart_totals_coupon_label( $coupon ); ?></div>
						<div class="cart-td"><?php nautica_wc_cart_totals_coupon_html( $coupon ); ?></div>
					</div>
				<?php endforeach; ?>


				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<div class="cart-tr fee">
						<div class="cart-th"><?php echo esc_html( $fee->name ); ?></div>
						<div class="cart-td"><?php wc_cart_totals_fee_html( $fee ); ?></div>
					</div>
				<?php endforeach; ?>

				<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart == 'excl' ) : ?>
					<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
						<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
							<div class="cart-tr tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
								<div class="cart-th"><?php echo esc_html( $tax->label ); ?></div>
								<div class="cart-td"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="cart-tr tax-total">
							<div class="cart-th"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
							<div class="cart-td"><?php wc_cart_totals_taxes_total_html(); ?></div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<div class="cart-tr order-total">
					<div class="cart-th"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
					<div class="cart-td"><?php wc_cart_totals_order_total_html(); ?></div>
				</div>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

			</div>
		</div>


		<?php if ( WC()->cart->get_cart_tax() ) : ?>
			<p class="wc-cart-shipping-notice"><small><?php

				$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' ' . esc_html__( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . WC()->countries->countries[ WC()->countries->get_base_country() ] )
					: '';

				printf( esc_html__( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information', 'woocommerce' ), $estimated_text );

			?></small></p>
		<?php endif; ?>

		<div class="wc-proceed-to-checkout col-sm-6 col-xs-12">

			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

		</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>
