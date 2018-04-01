<?php
/**
 * Add element lookbook for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_lookbook() {
	vc_map(
		array(
			'name'        => esc_html__( 'Lookbook', 'valey' ),
			'description' => esc_html__( 'Create a lookbook for your online store', 'valey' ),
			'base'        => 'fx_lookbook',
			'icon'        => 'icon-wpb-woocommerce',
			'category'    => esc_html__( 'WooCommerce', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'lookbook',
					'heading'    => esc_html__( 'Lookbook', 'valey' ),
					'type'       => 'param_group',
					'params'     => array(
						array(
							'param_name' => 'sub_title',
							'heading'    => esc_html__( 'Lookbook Sub-title', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'title',
							'heading'    => esc_html__( 'Lookbook Title', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'description',
							'heading'    => esc_html__( 'Description', 'valey' ),
							'type'       => 'textarea',
						),
						array(
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image Full', 'valey' ),
							'description' => esc_html__( 'Select full image on this collection.', 'valey' ),
							'type'        => 'attach_image',
						),
						array(
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'valey' ),
							'description' => esc_html__( 'Select images used on this collection.', 'valey' ),
							'type'        => 'attach_images',
						),
						array(
							'param_name' => 'button',
							'heading'    => esc_html__( 'Button Text', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link To', 'valey' ),
							'type'       => 'textfield',
							'dependency' => array(
								'element'   => 'button',
								'not_empty' => true
							),
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
add_action( 'vc_before_init', 'fx_valey_vc_map_lookbook' );