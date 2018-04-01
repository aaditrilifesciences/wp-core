<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $fxshortcodes;

// Get product hover style
$hover = $fxshortcodes ? $fxshortcodes['style'] : cs_get_option( 'wc-hover-style' );

$icon = '<i class="fa fa-cart-arrow-down mr__10 ml__30"></i>';

if ( '1' == $hover ) {
	$classes = 'btr-52 tu f__mont ls__1';
	$text = esc_html( $product->add_to_cart_text() );
} else if ( '2' == $hover ) {
	$classes = 'bs-58';
	$text = '<span class="tooltips cw pa f__mont fs__12 ts__03">' . esc_html( $product->add_to_cart_text() ) . '</span>';
} else {
	$classes = 'bs-58';
	$text = '<span class="tooltips cw pa f__mont fs__12 ts__03">' . esc_html( $product->add_to_cart_text() ) . '</span>';
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="bgb bghp db cw pr %s %s">%s%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_attr( $classes ),
		$icon,
		$text
	),
$product );
