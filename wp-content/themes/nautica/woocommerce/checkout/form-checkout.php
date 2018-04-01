<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="">
	<ul id="order_step" class="step process-steps process-steps-v1 process-3 clearfix">
		<li class="step_done first">
			<a href="#">
				<span><i class="icons icons-lg radius-x icons-darker icons-bodered">01</i> <br><?php esc_html_e('SHOPPING CART','nautica'); ?></span>
			</a>
		</li>
		<li class="step_current second">
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

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		
	<?php endif; ?>
	</div>


</div>
	<div class="row">
		<h3 id="order_review_heading" class="engo-order-review-heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
		<div class="col-md-6 col-lg-6 col-sm-6">
			<div class="order-review">
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-6">
			<?php do_action('nautica_do_checkout_payment');?>
		</div>
	</div>

	

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
