<?php 
/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function nautica_func_register_meta_boxes( $meta_boxes )
{
	global $wp_registered_sidebars;	 // echo '<pre>'.print_r($wp_registered_sidebars, 1 ); die; 
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	$sidebars = array();
	if( $wp_registered_sidebars){
		foreach( $wp_registered_sidebars  as $key => $value ){
			$sidebars[$key] = $value['name'];
		}
	}

	$layouts = array(
	    '' => esc_html__('Auto', 'nautica'),
	    'leftmain' => esc_html__('Left - Main Sidebar', 'nautica'),
	    'mainright' => esc_html__('Main - Right Sidebar', 'nautica'),
	    'leftmainright' => esc_html__('Left - Main - Right Sidebar', 'nautica'),

	);
	$positions = array(
			'' => esc_html__('Auto', 'nautica'),
			'relative' => esc_html__('Relative', 'nautica'),
			'absolute' => esc_html__('Absolute', 'nautica'),
			'fixed' => esc_html__('Fixed', 'nautica'),
			'inherit' => esc_html__('Inherit', 'nautica'),
	);

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'standard',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Page Layout Setting', 'nautica' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array(  'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
	 	
			// CHECKBOX
			array(
				'name' => esc_html__( 'Enable Fullwidth Layout', 'nautica' ),
				'id'   => NAUTICA_PREFIX."enable_fullwidth_layout",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),		
			// HEADER SELECT BOX
			array(
				'name'        => esc_html__( 'Header Layout', 'nautica' ),
				'id'          => NAUTICA_PREFIX."header_layout",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     =>  nautica_fnc_get_header_layouts(),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => esc_html__( 'Global', 'nautica' ),
			),

				array(
						'name'        => esc_html__( 'Header position', 'nautica' ),
						'id'          => NAUTICA_PREFIX."header_position",
						'type'        => 'select',
					// Array of 'value' => 'Label' pairs for select box
						'options'     =>  $positions,
					// Select multiple values, optional. Default is false.
						'multiple'    => false,
						'std'         => '',
				),

			array(
				'name'        => esc_html__( 'Footer Layout', 'nautica' ),
				'id'          => NAUTICA_PREFIX."footer_profile",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     =>   nautica_fnc_get_footer_profiles(),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => esc_html__( 'Global', 'nautica' ),
			),

			// CHECKBOX
			array(
				'name' => esc_html__( 'Disable Breadscrumb', 'nautica' ),
				'id'   => NAUTICA_PREFIX."disable_breadscrumb",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 1,
			),	

			// COLOR
			array(
				'name' => esc_html__( 'Breadcrumbs Text Color', 'nautica' ),
				'id'   => NAUTICA_PREFIX."color_breadscrumb",
				'type' => 'color',
				'description' => esc_html__('Custom Text Color for breadscrumb', 'nautica')
			), 
			 

			// COLOR
			array(
				'name' => esc_html__( 'Breadcrumbs Background Color', 'nautica' ),
				'id'   => NAUTICA_PREFIX."bgcolor_breadscrumb",
				'type' => 'color',
				'description' => esc_html__('Custom Background for breadscrumb', 'nautica')
			), 
			 
			 // THICKBOX IMAGE UPLOAD (WP 3.3+)
			// FILE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Breadscrumb Background', 'nautica' ),
				'id'               => NAUTICA_PREFIX."image_breadscrumb",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image', // Leave blank for all file types
			),

			array(
				'name'        => esc_html__( 'Layout', 'nautica' ),
				'id'          => NAUTICA_PREFIX."page_layout",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     =>   $layouts,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',

			),

			// HEADER SELECT BOX
			array(
				'name'        => esc_html__( 'Left Sidebar', 'nautica' ),
				'id'          => NAUTICA_PREFIX."leftsidebar",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => $sidebars,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => esc_html__( 'Global', 'nautica' ),
			),

			// HEADER SELECT BOX
			array(
				'name'        => esc_html__( 'Right Sidebar', 'nautica' ),
				'id'          => NAUTICA_PREFIX."rightsidebar",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => $sidebars,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => esc_html__( 'Global', 'nautica' ),
			),


		),
		'validation' => array(
			 
		)
	);

	// 2nd meta box
	$meta_boxes[] = array(
			'title'      => 'Footer meta data',
			'post_types' => 'footer',
			'fields'     => array(
					array(
							'name' => 'Footer key',
							'id'   => NAUTICA_PREFIX.'footer_key',
							'type' => 'text',
					),
			)
	);
 	 
	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'nautica_func_register_meta_boxes' , 99 );