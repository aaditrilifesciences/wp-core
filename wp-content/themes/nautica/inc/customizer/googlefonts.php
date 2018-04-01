<?php 



function nautica_google_fonts_customizer( $wp_customize ){

	$wp_customize -> add_section( 'typography_options', array(
		'title' => esc_html__( 'Typography Options', 'nautica' ),
		'description' => esc_html__('Modify Fonts', 'nautica'),
		'priority' => 6
	));

	//Header Font
	/* $wp_customize->add_setting( 'heading_font', array(
		'default'		=> 'none',
		'type'			=> 'option',
		'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'heading_font', array(
		'label'		=> esc_html__( 'Header Font', 'my_theme', 'my_theme-text-domain' ),
		'section'	=> 'typography_options',
		'settings'	=> 'heading_font',
		'type'		=> 'select',
		'choices'	=> array(
	               'arial' => array(
	                       'label' => 'Arial'
	                  ),
	                'open-sans' => array(
	                       'label' => 'Open Sans',
	                       'google_font' => 'Open+Sans:400italic,700italic,400,700'
	                  ),
	                'pt-sans' => array(
	                        'label' => 'PT Sans',
	                        'google_font' => 'PT+Sans:400,700,400italic,700italic'
	                   )
	              ),
	)); */
}
add_action( 'customize_register', 'nautica_google_fonts_customizer' );