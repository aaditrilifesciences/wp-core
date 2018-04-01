<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo '<a href="' . esc_url( WC()->cart->get_checkout_url() ) . '" class="checkout-button btn btn-primary-border alt wc-forward">' . esc_html__( 'Proceed to Checkout', 'woocommerce' ) . '</a>';
