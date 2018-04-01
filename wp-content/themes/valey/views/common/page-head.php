<?php
/**
 * The heading of page.
 *
 * @since   1.0.0
 * @package Valey
 */

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_page_options', true );

if ( function_exists( 'is_product') && is_product() || ( isset( $options['pagehead'] ) && ! $options['pagehead'] ) ) return;

if ( function_exists( 'is_shop' ) && is_shop() ) {
	
	echo fx_valey_wc_head();

} else if ( is_single() ) {

	echo fx_valey_head_single();

} else if ( is_home() ) {

	echo fx_valey_head_blog();

} else {

	echo fx_valey_head_page();

}