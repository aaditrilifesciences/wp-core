<?php
/**
 * Initialize viusal composer.
 *
 * @since   1.0.0
 * @package Valey
 */

if ( ! class_exists( 'VC_Manager' ) ) return;

// Remove "Design options", "Custom CSS" tabs and prompt message.
vc_set_as_theme();

// Disable frontend editor.
vc_disable_frontend();

// Change default template directory.
vc_set_shortcodes_templates_dir( get_template_directory() . '/core/libraries/vendors/visual-composer/shortcodes' );

// Include custom functions of vc element
$maps = 'row, column, product, products, blog, pagination, lookbook, testimonial, carousel, team';
$maps = array_map( 'trim', explode( ',', $maps ) );
foreach ( $maps as $file ) {
	require_once FX_VALEY_PATH . '/core/libraries/vendors/visual-composer/maps/' . $file . '.php';
}

/**
 * Suggester for autocomplete by id/name/title/sku
 *
 * @param $query
 *
 * @return array - id's from products with title/sku.
 */
function fx_addons_autocomplete( $query ) {
	$filter = current_filter();

	switch ( $filter ) {
		case 'vc_autocomplete_fx_product_id_callback' :
		case 'vc_autocomplete_fx_products_id_callback' :
			$suggestions = apply_filters( 'vc_autocomplete_product_id_callback', $query );

		break;

		case 'vc_autocomplete_fx_blog_id_callback':
			$query = array(
				'query' => 'post',
				'term'  => $query
			);
			$suggestions = apply_filters( 'vc_autocomplete_vc_basic_grid_exclude_callback', $query );

		break;

	}

	if ( is_array( $suggestions ) && ! empty( $suggestions ) ) {
		die( json_encode( $suggestions ) );
	}

	die( '' ); // if nothing found..

}
add_filter( 'vc_autocomplete_fx_product_id_callback', 'fx_addons_autocomplete', 1, 1 );
add_filter( 'vc_autocomplete_fx_products_id_callback', 'fx_addons_autocomplete', 1, 1 );
add_filter( 'vc_autocomplete_fx_blog_id_callback', 'fx_addons_autocomplete', 1, 1 );