<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( $order ) : ?>
	<div class="">
		<ul id="order_step" class="step process-steps process-steps-v1 process-3 clearfix">
			<li class="step_done first">
				<a href="#">
					<span><i class="icons icons-lg radius-x icons-darker icons-bodered">01</i> <br><?php esc_html_e('SHOPPING CART','nautica'); ?></span>
				</a>
			</li>
			<li class="step_done second">
				<a href="#">
					<span><i class="icons icons-lg radius-x icons-darker icons-bodered">02</i><br><?php esc_html_e('CHECK OUT','nautica'); ?></span></a>
			</li>
			<li class="step_current last" id="step_end">
				<span><i class="icons icons-lg radius-x icons-darker icons-bodered">03</i><br><?php esc_html_e('ORDER COMPLETE','nautica'); ?></span>
			</li>
		</ul>
	</div>
	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				esc_html_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
			else
				esc_html_e( 'Please attempt your purchase again.', 'woocommerce' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<div class="order-complate">
			<p>
				<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you for shopping with us. Your order has been received.', 'woocommerce' ), $order ); ?>
			</p>
			<div class="thankyou-action">
				<a href="<?php echo esc_url( home_url('/') );?>" class="btn btn-primary-border"><?php esc_html_e('Home page','nautica'); ?></a>
				<a href="<?php echo esc_url(get_permalink( woocommerce_get_page_id( 'shop' ) ));?>" class="btn btn-primary"><?php esc_html_e('Continue shopping','nautica'); ?></a>
			</div>
			<div class="engo-order-detail-overview">
				<ul class="order_details">
					<li class="order">
						<?php esc_html_e( 'Order Number:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_order_number(); ?></strong>
					</li>
					<li class="date">
						<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
						<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
					</li>
					<li class="total">
						<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_formatted_order_total(); ?></strong>
					</li>
					<?php if ( $order->payment_method_title ) : ?>
						<li class="method">
							<?php esc_html_e( 'Payment Method:', 'woocommerce' ); ?>
							<strong><?php echo $order->payment_method_title; ?></strong>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<div class="clear"></div>




	<?php endif; ?>
	<div class="engo-notice-order">
		<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	</div>
	<div class="engo-thankyou-order-detail-recheck">
		<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
	</div>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
