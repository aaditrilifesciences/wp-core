<?php
/**
 * Add element blog for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_blog() {
	vc_map(
		array(
			'name'        => esc_html__( 'Blog', 'valey' ),
			'description' => esc_html__( 'Show blog post by ID or title', 'valey' ),
			'base'        => 'fx_blog',
			'icon'        => 'icon-wpb-vc_carousel',
			'category'    => esc_html__( 'Content', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'title',
					'heading'    => esc_html__( 'Blog List Title', 'valey' ),
					'type'       => 'textfield',
				),
				array(
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Include special posts', 'valey' ),
					'description' => esc_html__( 'Enter posts title to display only those records.', 'valey' ),
					'type'        => 'autocomplete',
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true,
					),
				),
				array(
					'param_name' => 'columns',
					'heading'    => esc_html__( 'Columns', 'valey' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( '2 columns', 'valey' ) => '6',
						esc_html__( '3 columns', 'valey' ) => '4',
						esc_html__( '4 columns', 'valey' ) => '3',
					),
					'std' => '6',
					'dependency' => array(
						'element' => 'slider',
						'value'   => '0',
					),
				),
				array(
					'param_name'  => 'limit',
					'heading'     => esc_html__( 'Per Page', 'valey' ),
					'description' => esc_html__( 'How much items per page to show (-1 to show all posts)', 'valey' ),
					'type'        => 'textfield',
					'value'       => 4,
				),
				array(
					'param_name' => 'slider',
					'heading'    => esc_html__( 'Display Blog as Slider', 'valey' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Yes, Please', 'valey' )    => 1,
						esc_html__( 'No, I needn\'t', 'valey' ) => 0,
					),
					'std' => 0
				),
				array(
					'param_name' => 'navigation',
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Enable Navigation?', 'valey' ),
					'dependency' => array(
						'element' => 'slider',
						'value'   => '1',
					),
				),
				array(
					'param_name'  => 'items',
					'heading'     => esc_html__( 'Items', 'valey' ),
					'description' => esc_html__( 'The number of items you want to see on the screen', 'valey' ),
					'type'        => 'textfield',
					'value'       => 2,
					'dependency'  => array(
						'element' => 'slider',
						'value'   => '1',
					),
				),
				array(
					'param_name' => 'autoplay',
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Autoplay', 'valey' ),
					'dependency' => array(
						'element' => 'slider',
						'value'   => '1',
					),
				),
				array(
					'param_name' => 'hoverpause',
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Pause on mouse hover', 'valey' ),
					'dependency' => array(
						'element'   => 'autoplay',
						'not_empty' => true,
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
add_action( 'vc_before_init', 'fx_valey_vc_map_blog' );