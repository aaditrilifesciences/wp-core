<?php 

class Nautica_VC_Theme implements Vc_Vendor_Interface {

	public function load(){
		/*********************************************************************************************************************
		 *  Vertical menu
		 *********************************************************************************************************************/
		$option_menu  = array(); 
		if( is_admin() ){
			$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
		    $option_menu = array('---Select Menu---'=>'');
		    foreach ($menus as $menu) {
		    	$option_menu[$menu->name]=$menu->term_id;
		    }
		}    
		vc_map( array(
		    "name" => esc_html__("ENGO Quick Links Menu", 'nautica'),
		    "base" => "engo_quicklinksmenu",
				'icon' => 'engo-vc-icon',
		    "class" => "",
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    'description'	=> esc_html__( 'Show Quick Links To Access', 'nautica'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => 'Quick To Go'
				),
		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'nautica'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'nautica')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'nautica'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)
		   	)
		));
		 
		vc_map( array(
          "name" => esc_html__("ENGO Brands Carousel", 'nautica'),
          "base" => "engo_brands",
				'icon' => 'engo-vc-icon',
          'description'=>'Show Brand Logos, Manufacture Logos From Source: Brands',
          "class" => "",
          "category" => esc_html__('ENGO Widgets', 'nautica'),
          "params" => array(
            array(
            "type" => "textfield",
            "heading" => esc_html__("Title", 'nautica'),
            "param_name" => "title",
            "value" => '',
          ),

          array(
            "type" => "textarea",
            "heading" => esc_html__('Descriptions', 'nautica'),
            "param_name" => "descript",
            "value" => ''
          ),

	        array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'js_composer' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'js_composer' )
		),
          array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Columns count', 'nautica' ),
            'param_name' => 'columns_count',
            'value' => array(
              esc_html__( '2 Items', 'nautica' ) => 2,
              esc_html__( '3 Items', 'nautica' ) => 3,
              esc_html__( '4 Items', 'nautica' ) => 4,
              esc_html__( '5 Items', 'nautica' ) => 5,
              esc_html__( '6 Items', 'nautica' ) => 6,
            ),
            'std' => 6
          ),
          array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", 'nautica'),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
          )
          )
      ));
                /*********************************************************************************************************************
		 *  Horizontal menu
		 *********************************************************************************************************************/
	 
		vc_map( array(
		    "name" => esc_html__("ENGO Horizontal MegaMenu", 'nautica'),
		    "base" => "engo_horizontal_menu",
				'icon' => 'engo-vc-icon',
		    "class" => "",
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    "params" => array(

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => 'Horizontal Menu',
					"admin_label"	=> true
				),

		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'nautica'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'nautica')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Position", 'nautica'),
					"param_name" => "text_align",
					"value" => array(
							'left'=>'left',
							'right'=>'right',
							'center'=>'center'
						),
					'std' => 'left',
					"description" => esc_html__("Text align Horizontal menu.", 'nautica')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'nautica'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)
		   	)
		));
                
		/*********************************************************************************************************************
		 *  Vertical menu
		 *********************************************************************************************************************/
	 
		vc_map( array(
		    "name" => esc_html__("ENGO Vertical MegaMenu", 'nautica'),
		    "base" => "engo_verticalmenu",
				'icon' => 'engo-vc-icon',
		    "class" => "",
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    "params" => array(

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => 'Vertical Menu',
					"admin_label"	=> true
				),

		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'nautica'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'nautica')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Position", 'nautica'),
					"param_name" => "postion",
					"value" => array(
							'left'=>'left',
							'right'=>'right'
						),
					'std' => 'left',
					"description" => esc_html__("Postion Menu Vertical.", 'nautica')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'nautica'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)
		   	)
		));
		 
		vc_map( array(
		    "name" => esc_html__("Fixed Show Vertical Menu ", 'nautica'),
		    "base" => "engo_verticalmenu_show",
				'icon' => 'engo-vc-icon',
		    "class" => "",
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    "description" => esc_html__( 'Always showing vertical menu on top', 'nautica' ),
		    "params" => array(
		  
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"description" => esc_html__("When enabled vertical megamenu widget on main navition and its menu content will be showed by this module. This module will work with header:Martket, Market-V2, Market-V3" , 'nautica')
				)
		   	)
		));
	 

		/******************************
		 * Our Team
		 ******************************/
		vc_map( array(
		    "name" => esc_html__("ENGO Our Team Grid Style", 'nautica'),
		    "base" => "engo_team",
				'icon' => 'engo-vc-icon',
		    "class" => "",
		    "description" => 'Show Personal Profile Info',
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => '',
						"admin_label" => true
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'nautica'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Job", 'nautica'),
					"param_name" => "job",
					"value" => 'CEO',
					'description'	=>  ''
				),

				array(
					"type" => "textarea",
					"heading" => esc_html__("information", 'nautica'),
					"param_name" => "information",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'nautica')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Phone", 'nautica'),
					"param_name" => "phone",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus", 'nautica'),
					"param_name" => "google",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook", 'nautica'),
					"param_name" => "facebook",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter", 'nautica'),
					"param_name" => "twitter",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Pinterest", 'nautica'),
					"param_name" => "pinterest",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Linked In", 'nautica'),
					"param_name" => "linkedin",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'nautica'),
					"param_name" => "style",
					'value' 	=> array( 'circle' => esc_html__('circle', 'nautica'), 'vertical' => esc_html__('vertical', 'nautica') , 'horizontal' => esc_html__('horizontal', 'nautica') ),
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'nautica'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)
		   	)
		));
	 
		/******************************
		 * Our Team
		 ******************************/
		vc_map( array(
			"name" => esc_html__("ENGO Our Team List Style", 'nautica'),
			"base" => "engo_team_list",
				'icon' => 'engo-vc-icon',
			"class" => "",
			"description" => esc_html__('Show Info In List Style', 'nautica'),
			"category" => esc_html__('ENGO Widgets', 'nautica'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => '',
						"admin_label" => true
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'nautica'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Phone", 'nautica'),
					"param_name" => "phone",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Job", 'nautica'),
					"param_name" => "job",
					"value" => 'CEO',
					'description'	=>  ''
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Information", 'nautica'),
					"param_name" => "content",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'nautica')
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Blockquote", 'nautica'),
					"param_name" => "blockquote",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Email", 'nautica'),
					"param_name" => "email",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook", 'nautica'),
					"param_name" => "facebook",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter", 'nautica'),
					"param_name" => "twitter",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Linked In", 'nautica'),
					"param_name" => "linkedin",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'nautica'),
					"param_name" => "style",
					'value' 	=> array( 'circle' => esc_html__('circle', 'nautica'), 'vertical' => esc_html__('vertical', 'nautica') , 'horizontal' => esc_html__('horizontal', 'nautica') ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'nautica'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)

		   	)
		));
	 
		
	 

		/* Heading Text Block
		---------------------------------------------------------- */
		vc_map( array(
			'name'        => esc_html__( 'ENGO Widget Heading', 'nautica'),
			'base'        => 'engo_title_heading',
				'icon' => 'engo-vc-icon',
			"class"       => "",
			"category" => esc_html__('ENGO Widgets', 'nautica'),
			'description' => esc_html__( 'Create title for one Widget', 'nautica' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'nautica' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'nautica' ),
					'description' => esc_html__( 'Enter heading title.', 'nautica' ),
					"admin_label" => true
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'nautica' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'nautica' )
				),
				 
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'nautica' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'nautica' )
			    ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'nautica' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nautica' )
				)
			),
		));
		
	}
}