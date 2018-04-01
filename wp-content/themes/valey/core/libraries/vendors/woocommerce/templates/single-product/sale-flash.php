<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<div class="badge pa cw f__mont tu tc">
	<?php
		if ( $product->is_on_sale() ) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale bgb db">' . esc_html__( 'Sale!', 'valey' ) . '</span>', $post, $product );
		}
	?>

	<?php
		if ( $product->is_featured() ) {
			echo '<span class="hot db">' . esc_html__( 'Hot!', 'valey' ) . '</span>';
		}
	?>

	<?php if ( ! $product->get_price_html() ) echo '<span class="free db">' . esc_html__( 'Free!', 'valey' ) . '</span>'; ?>

	<?php
		$postdate      = get_the_time( 'Y-m-d' );
		$postdatestamp = strtotime( $postdate );

		if ( ( time() - ( 60 * 60 * 24 * 5 ) ) < $postdatestamp ) {
			echo '<span class="new db">' . esc_html__( 'New', 'valey' ) . '</span>';
		}
	?>
</div>
