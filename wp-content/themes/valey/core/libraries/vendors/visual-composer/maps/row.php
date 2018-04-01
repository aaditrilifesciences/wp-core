<?php
/**
 * Custom row for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_add_params_to_row() {
	vc_remove_param( 'vc_row', 'full_width' );

	vc_add_params(
		'vc_row',
		array(
			array(
				'heading'     => esc_html__( 'Full width row?', 'valey' ),
				'description' => esc_html__( 'If checked row will be set to full width.', 'valey' ),
				'type'        => 'checkbox',
				'param_name'  => 'fullwidth',
				'weight'      => 1,
				'value'       => array(
					esc_html__( 'Yes', 'valey' ) => 'yes'
				),
			),
			array(
				'heading'     => esc_html__( 'Wrap Content', 'valey' ),
				'description' => esc_html__( 'Wrap content to 1170px (You can change wrapper\'s width in theme options.', 'valey' ),
				'type'        => 'checkbox',
				'param_name'  => 'wrap',
				'weight'      => 1,
				'value'       => array(
					esc_html__( 'Yes', 'valey' ) => 'yes'
				),
				'dependency' => array(
					'element'   => 'fullwidth',
					'not_empty' => true
				)
			),
			array(
				'heading'          => esc_html__( 'Background Position', 'valey' ),
				'description'      => esc_html__( 'Sets the starting position of a background image.', 'valey' ),
				'group'            => esc_html__( 'Design Options', 'valey' ),
				'type'             => 'dropdown',
				'param_name'       => 'background_position',
				'edit_field_class' => 'vc_col-xs-6',
				'value'            => array(
					esc_html__( 'Left Top', 'valey' )      => 'default',
					esc_html__( 'Left Center', 'valey' )   => 'left center',
					esc_html__( 'Left Bottom', 'valey' )   => 'left bottom',
					esc_html__( 'Right Top', 'valey' )     => 'right top',
					esc_html__( 'Right Center', 'valey' )  => 'right center',
					esc_html__( 'Right Bottom', 'valey' )  => 'right bottom',
					esc_html__( 'Center Top', 'valey' )    => 'center top',
					esc_html__( 'Center Center', 'valey' ) => 'center center',
					esc_html__( 'Center Bottom', 'valey' ) => 'center bottom',
				),
			),
		)
	);

	vc_add_params(
		'vc_row_inner',
		array(
			array(
				'heading'          => esc_html__( 'Background Position', 'valey' ),
				'description'      => esc_html__( 'Sets the starting position of a background image.', 'valey' ),
				'group'            => esc_html__( 'Design Options', 'valey' ),
				'type'             => 'dropdown',
				'param_name'       => 'background_position',
				'edit_field_class' => 'vc_col-xs-6',
				'value'            => array(
					esc_html__( 'Left Top', 'valey' )      => 'default',
					esc_html__( 'Left Center', 'valey' )   => 'left center',
					esc_html__( 'Left Bottom', 'valey' )   => 'left bottom',
					esc_html__( 'Right Top', 'valey' )     => 'right top',
					esc_html__( 'Right Center', 'valey' )  => 'right center',
					esc_html__( 'Right Bottom', 'valey' )  => 'right bottom',
					esc_html__( 'Center Top', 'valey' )    => 'center top',
					esc_html__( 'Center Center', 'valey' ) => 'center center',
					esc_html__( 'Center Bottom', 'valey' ) => 'center bottom',
				),
			),
		)
	);
}
add_action( 'vc_after_init', 'fx_valey_vc_add_params_to_row' );