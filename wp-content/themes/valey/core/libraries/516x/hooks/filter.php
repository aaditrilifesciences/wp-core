<?php
/**
 * Filter hooks.
 *
 * @since   1.0.0
 * @package Valey
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fx_valey_body_class( $classes ) {
	// Add class of header layout
	$layout = cs_get_option( 'header-layout' );
	if ( isset( $_GET['header'] ) ) {
		$classes[] = 'header-lateral';
	}

	$classes[] = 'header-' . $layout;

	// Add class boxed layout
	if ( cs_get_option( 'boxed' ) ) {
		$classes[] = 'boxed';
	}

	// Add class for canvas sidebar
	if ( is_active_sidebar( 'canvas-sidebar' ) ) {
		$classes[] = 'sidebar-actived';
	}

	return $classes;
}
add_filter( 'body_class', 'fx_valey_body_class' );