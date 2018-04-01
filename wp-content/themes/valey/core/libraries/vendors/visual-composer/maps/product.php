<?php
/**
 * Add element product for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_product() {
	vc_remove_element( 'product' );
	vc_map(
		array(
			'name'        => esc_html__( 'Product', 'valey' ),
			'description' => esc_html__( 'Show a single product by ID or SKU', 'valey' ),
			'base'        => 'fx_product',
			'icon'        => 'icon-wpb-woocommerce',
			'category'    => esc_html__( 'WooCommerce', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'style',
					'heading'    => esc_html__( 'Hover Style', 'valey' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Style 1', 'valey' ) => '1',
						esc_html__( 'Style 2', 'valey' ) => '2',
						esc_html__( 'Style 3', 'valey' ) => '3',
					),
				),
				array(
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Select identificator', 'valey' ),
					'type'        => 'autocomplete',
					'description' => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'valey' ),
				),
				array(
					'param_name' => 'sku',
					'type'       => 'hidden',
					'dependency' => array(
						'element' => 'order',
						'value'   => 'all',
					),
				),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'valey' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'valey' ),
					'type' 	      => 'textfield',
					'edit_field_class' => 'vc_col-xs-12 vc_column pt__15',
				),
				array(
					'param_name' => 'issc',
					'type'       => 'hidden',
					'value'      => true,
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'fx_valey_vc_map_product' );