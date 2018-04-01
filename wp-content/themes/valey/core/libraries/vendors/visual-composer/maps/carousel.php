<?php
/**
 * Add element blog for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_carousel() {
	vc_map(
		array(
			'name'                    => esc_html__( 'Carousel', 'valey' ),
			'description'             => esc_html__( 'Animated carousel', 'valey' ),
			'base'                    => 'fx_carousel',
			'icon'                    => 'icon-wpb-images-carousel',
			'category'                => esc_html__( 'Content', 'valey' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'as_parent'               => array( 'only' => 'vc_row' ),
			'params'      => array(
				array(
					'param_name'  => 'items',
					'heading'     => esc_html__( 'Items (Number only)', 'valey' ),
					'description' => esc_html__( 'Set the maximum amount of items displayed at a time with the widest browser width', 'valey' ),
					'type'        => 'textfield',
					'value'       => 1,
				),
				array(
					'param_name' => 'navigation',
					'heading'    => esc_html__( 'Enable Navigation', 'valey' ),
					'type'       => 'checkbox',
				),
				array(
					'param_name' => 'pagination',
					'heading'    => esc_html__( 'Enable Pagination', 'valey' ),
					'type'       => 'checkbox',
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
add_action( 'vc_before_init', 'fx_valey_vc_map_carousel' );
class WPBakeryShortCode_Fx_Carousel extends WPBakeryShortCodesContainer {};