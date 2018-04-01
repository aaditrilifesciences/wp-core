<?php

 /**
  * Register Woocommerce Vendor which will register list of shortcodes
  */
function nautica_fnc_init_vc_vendors(){
	
	$vendor = new Nautica_VC_News();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );


	$vendor = new Nautica_VC_Theme();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );

	$vendor = new Nautica_VC_Elements();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );

	
}
add_action( 'after_setup_theme', 'nautica_fnc_init_vc_vendors' , 99 );

/**
 * Add parameters for row
 */
function nautica_fnc_add_params(){

 	/**
	 * add new params for row
	 */
	vc_add_param( 'vc_row', array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Parallax", 'nautica'),
	    "param_name" => "parallax",
	    "value" => array(
	        'Yes, please' => true
	    )
	));

	$row_class =  array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Background Styles', 'nautica' ),
        'param_name' => 'bgstyle',
        'description'	=> esc_html__('Use Styles Supported In Theme, Select No Use For Customizing on Tab Design Options', 'nautica'),
        'value' => array(
			esc_html__( 'No Use', 'nautica' ) => '',
			esc_html__( 'Background Color Primary', 'nautica' ) => 'bg-primary',
			esc_html__( 'Background Color Info', 'nautica' ) 	 => 'bg-info',
			esc_html__( 'Background Color Danger', 'nautica' )  => 'bg-danger',
			esc_html__( 'Background Color Warning', 'nautica' ) => 'bg-warning',
			esc_html__( 'Background Color Success', 'nautica' ) => 'bg-success',
			esc_html__( 'Background Color Theme', 'nautica' ) 	 => 'bg-theme',
		    esc_html__( 'Background Image 1 Dark', 'nautica' ) => 'bg-style-v1',
			esc_html__( 'Background Image 2 Dark', 'nautica' ) => 'bg-style-v2',
			esc_html__( 'Background Image 3 Blue', 'nautica' ) => 'bg-style-v3',
			esc_html__( 'Background Image 4 Red', 'nautica' ) => 'bg-style-v4',
        )
    ) ;

	vc_add_param( 'vc_row', $row_class );
	vc_add_param( 'vc_row_inner', $row_class );


	/** ManhTienpt - Set Animate to columns  **/
	$column_class = array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Animate effect', 'nautica' ),
			'param_name' => 'animate_effect',
			'description'	=> esc_html__('Use Animate effect for this column', 'nautica'),
			'value' => array(
					esc_html__( 'No Use', 'nautica' ) => '',
					esc_html__( 'Fade in', 'nautica' ) => 'fade-in',
					esc_html__( 'Short from left', 'nautica' ) 	 => 'fade-left',
					esc_html__( 'Short from right', 'nautica' )  => 'fade-right',
			)
	) ;
	vc_add_param( 'vc_column',  $column_class);
	vc_add_param( 'vc_column_inner',  $column_class);
	vc_add_param( 'vc_row',  $column_class);
	vc_add_param( 'vc_row_inner', $column_class );

	$column_screen_support = array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Show/Hide only screen width', 'nautica' ),
			'param_name' => 'column_screen_support',
			'description'	=> esc_html__('Select screen minimum for this column support', 'nautica'),
			'value' => array(
					esc_html__( 'Default', 'nautica' ) => '',
					esc_html__( 'Large screen / wide desktop', 'nautica' ) => 'lg',
					esc_html__( 'Medium screen / desktop', 'nautica' ) 	 => 'md',
					esc_html__( 'Small screen / tablet', 'nautica' )  => 'sm',
			)
	) ;
	vc_add_param( 'vc_column',  $column_screen_support);
	vc_add_param( 'vc_column_inner',  $column_screen_support);
 

	 vc_add_param( 'vc_row', array(
	     "type" => "dropdown",
	     "heading" => esc_html__("Is Boxed", 'nautica'),
	     "param_name" => "isfullwidth",
	     "value" => array(
	     				esc_html__('Yes, Boxed', 'nautica') => '1',
	     				esc_html__('No, Wide', 'nautica') => '0'
	     			)
	));

	vc_add_param( 'vc_row', array(
	    "type" => "textfield",
	    "heading" => esc_html__("Icon", 'nautica'),
	    "param_name" => "icon",
	    "value" => '',
		'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'nautica' )
						. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
						. esc_html__( 'here to see the list, and use class icons-lg, icons-md, icons-sm to change its size', 'nautica' ) . '</a>'
	));

	/** add new field to call to action element **/
	$attributes_cta_template =  array(
			'type' => 'dropdown',
			'heading' => "Templates",
			'param_name' => 'cta_templates',
			'value' => array(
					esc_html__('Default', 'nautica') => '',
					esc_html__('Version 1', 'nautica') => 'cta-v1',
					esc_html__('Version 2', 'nautica') => 'cta-v2',
					esc_html__('Version 3', 'nautica') => 'cta-v3'
			),
			'description' => esc_html__( "Choose an exist templates", 'nautica' )
	);

	$attributes_cta_photo =  array(
			"type" => "attach_image",
			"heading" => esc_html__("Photo", 'nautica'),
			"param_name" => "photo",
			"value" => '',
			'description'	=> ''
	);
	$attributes_cta_photo_align =  array(
			'type' => 'dropdown',
			'heading' => "Photo position",
			'param_name' => 'cta_photo_position',
			'value' => array(
					esc_html__('Default', 'nautica') => '',
					esc_html__('Align Top', 'nautica') => 'top',
					esc_html__('Align Bottom', 'nautica') => 'bottom',
					esc_html__('Align Left', 'nautica') => 'left',
					esc_html__('Align Right', 'nautica') => 'right'
			),
			'description' => esc_html__( "Choose an exist position for photo", 'nautica' )
	);
	vc_add_param( 'vc_cta', $attributes_cta_photo );
	vc_add_param( 'vc_cta', $attributes_cta_photo_align );
	vc_add_param( 'vc_cta', $attributes_cta_template );


	/** Add new param type - Datetime Picker **/
	WpbakeryShortcodeParams::addField( 'datetime_picker', 'datetime_picker_settings_field', get_template_directory_uri().'/inc/vendors/visualcomposer/assets/DateTimePicker/engo_datetimepicker.js' );
	function datetime_picker_settings_field( $settings, $value ) {
		return '<div class="datetime_picker_block">'
		.'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput engo_datetime_picker ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />'
		.'</div>'
		.'<link type="text/css" rel="stylesheet" href="'.get_template_directory_uri().'/inc/vendors/visualcomposer/assets/DateTimePicker/jquery.datetimepicker.css"/>';
	}

}
add_action( 'after_setup_theme', 'nautica_fnc_add_params', 99 );
 
 /** 
  * Replace pagebuilder columns and rows class by bootstrap classes
  */
function nautica_wpo_change_bootstrap_class( $class_string,$tag ){
 
	if ($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
		$class_string = preg_replace('/vc_hidden-(\w)/', 'hidden-$1', $class_string);
		$class_string = preg_replace('/vc_col-(\w)/', 'col-$1', $class_string);
		$class_string = str_replace('wpb_column', '', $class_string);
		$class_string = str_replace('column_container', '', $class_string);
	}
	return $class_string;
}

add_filter( 'vc_shortcodes_css_class', 'nautica_wpo_change_bootstrap_class',10,2);
