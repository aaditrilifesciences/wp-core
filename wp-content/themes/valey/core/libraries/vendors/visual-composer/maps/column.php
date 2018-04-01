<?php
/**
 * Custom column for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_add_params_to_column() {
	vc_add_params(
		'vc_column',
		array(
			array(
				'heading'          => esc_html__( 'Background  Position', 'valey' ),
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
		'vc_column_inner',
		array(
			array(
				'heading'          => esc_html__( 'Background  Position', 'valey' ),
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
add_action( 'vc_after_init', 'fx_valey_vc_add_params_to_column' );