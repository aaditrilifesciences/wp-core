<?php
/**
 * Add element team for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_team() {
	vc_map(
		array(
			'name'        => esc_html__( 'Team Member', 'valey' ),
			'description' => esc_html__( 'Make team member with carousel', 'valey' ),
			'base'        => 'fx_team',
			'category'    => esc_html__( 'Content', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'title',
					'heading'    => esc_html__( 'Team Title', 'valey' ),
					'type'       => 'textfield',
				),
				array(
					'param_name' => 'member',
					'heading'    => esc_html__( 'Member', 'valey' ),
					'type'       => 'param_group',
					'params'     => array(
						array(
							'param_name' => 'avatar',
							'heading'    => esc_html__( 'Avatar', 'valey' ),
							'type'       => 'attach_image',
						),
						array(
							'param_name' => 'name',
							'heading'    => esc_html__( 'Name', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'job',
							'heading'    => esc_html__( 'Job', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'description',
							'heading'    => esc_html__( 'Biographical Info', 'valey' ),
							'type'       => 'textarea',
						),
						array(
							'param_name' => 'facebook',
							'heading'    => esc_html__( 'Facebook', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'twitter',
							'heading'    => esc_html__( 'Twitter', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'linkedin',
							'heading'    => esc_html__( 'Linkedin', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'instagram',
							'heading'    => esc_html__( 'Instagram', 'valey' ),
							'type'       => 'textfield',
						),
						array(
							'param_name' => 'dribbble',
							'heading'    => esc_html__( 'Dribbble', 'valey' ),
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
add_action( 'vc_before_init', 'fx_valey_vc_map_team' );