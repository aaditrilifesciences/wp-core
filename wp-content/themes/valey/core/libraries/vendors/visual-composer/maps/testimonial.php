<?php
/**
 * Add element testimonial for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_testimonial() {
	vc_map(
		array(
			'name'        => esc_html__( 'Testimonial', 'valey' ),
			'description' => esc_html__( 'Make a testimonial', 'valey' ),
			'base'        => 'fx_testimonial',
			'category'    => esc_html__( 'Content', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'image',
					'heading'    => esc_html__( 'Image Background', 'valey' ),
					'type'       => 'attach_image',
				),
				array(
					'param_name' => 'testimonial',
					'heading'    => esc_html__( 'Testimonial', 'valey' ),
					'type'       => 'param_group',
					'params'     => array(
						array(
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'valey' ),
							'type'       => 'textarea',
						),
						array(
							'param_name' => 'author',
							'heading'    => esc_html__( 'Author', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'job',
							'heading'    => esc_html__( 'Job', 'valey' ),
							'type'       => 'textfield',
						),
					),
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
add_action( 'vc_before_init', 'fx_valey_vc_map_testimonial' );