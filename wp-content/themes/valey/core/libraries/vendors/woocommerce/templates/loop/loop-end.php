<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $fxshortcodes;

// Get wc layout
$layout = cs_get_option( 'wc-layout' );
$class = '';
if ( $layout == 'right-sidebar' ) {
	$class = 'fx-col-md-3 fx-col-sm-12 fx-col-xs-12';
} elseif ( $layout == 'left-sidebar' ) {
	$class = 'fx-col-md-3 fx-col-sm-12 fx-col-xs-12 first-md';
}

echo '</div>';
if ( $layout !== 'no-sidebar' && ! $fxshortcodes ) {
		// Render pagination
		do_action( 'fx_wc_pagination' );

		echo '</div>';

		echo '<div class="' . esc_attr( $class ) . '">';
			echo '<div class="sidebar-wc">';
				if ( is_active_sidebar( 'wc-primary' ) ) {
					dynamic_sidebar( 'wc-primary' );
				}
			echo '</div>';
		echo '</div>';
	echo '</div>';
}