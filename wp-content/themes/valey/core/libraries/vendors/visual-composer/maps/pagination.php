<?php
/**
 * Add element pagination for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_pagination() {
	vc_map(
		array(
			'name'        => esc_html__( 'Pagination', 'valey' ),
			'description' => esc_html__( 'Add custom pagination', 'valey' ),
			'base'        => 'fx_pagination',
			'icon'        => 'icon-wpb-ui-pageable',
			'category'    => esc_html__( 'Content', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'pagination',
					'heading'    => esc_html__( 'Pagination', 'valey' ),
					'type'       => 'param_group',
					'params'     => array(
						array(
							'param_name'  => 'target',
							'heading'     => esc_html__( 'Target', 'valey' ),
							'description' => esc_html__( 'Example #section-1, #section-2', 'valey' ),
							'type'        => 'textfield',
						),
					),
				),
				array(
					'param_name'  => 'speed',
					'heading'     => esc_html__( 'Scroll Speed', 'valey' ),
					'description' => esc_html__( 'Speed at which the page will scroll upon clicking on the nav. Defaults to 750.', 'valey' ),
					'type'        => 'textfield',
				),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'valey' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'valey' ),
					'type' 	      => 'textfield',
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'fx_valey_vc_map_pagination' );