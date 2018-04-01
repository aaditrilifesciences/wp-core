<?php 

class Nautica_VC_Elements implements Vc_Vendor_Interface {

	public function load(){

		/*********************************************************************************************************************
		 *  Our Service
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("ENGO Featured Box", 'nautica'),
		    "base" => "engo_featuredbox",
				'icon' => 'engo-vc-icon',
		
		    "description"=> esc_html__('Decreale Service Info', 'nautica'),
		    "class" => "",
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => '',    "admin_label" => true,
				),
                        array(
					"type" => "textfield",
					"heading" => esc_html__("Link url", 'nautica'),
					"param_name" => "link_url",
					"value" => '',
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'nautica' ),
				    'param_name' => 'title_color',
				    'description' => esc_html__( 'Select font color', 'nautica' )
				),

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Sub Title", 'nautica'),
					"param_name" => "subtitle",
					"value" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'nautica'),
					"param_name" => "style",
					'value' 	=> array(
						esc_html__('Default', 'nautica') => '',
						esc_html__('Version 1', 'nautica') => 'v1',
						esc_html__('Version 2', 'nautica') => 'v2',
						esc_html__('Version 3', 'nautica' )=> 'v3',
						esc_html__('Version 4', 'nautica') => 'v4'
					),
					'std' => ''
				),

				array(
					'type'                           => 'dropdown',
					'heading'                        => esc_html__( 'Title Alignment', 'nautica' ),
					'param_name'                     => 'title_align',
					'value'                          => array(
					esc_html__( 'Align left', 'nautica' )   => 'separator_align_left',
					esc_html__( 'Align center', 'nautica' ) => 'separator_align_center',
					esc_html__( 'Align right', 'nautica' )  => 'separator_align_right'
					),
					'std' => 'separator_align_left'
				),

			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'nautica'),
					"param_name" => "icon",
					"value" => 'fa fa-gear',
					'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'nautica' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'nautica' ) . '</a>'
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Icon Color', 'nautica' ),
				    'param_name' => 'color',
				    'description' => esc_html__( 'Select font color', 'nautica' )
				),	
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background Icon', 'nautica' ),
					'param_name' => 'background',
					'value' => array(
						esc_html__( 'None', 'nautica' ) => 'nostyle',
						esc_html__( 'Success', 'nautica' ) => 'bg-success',
						esc_html__( 'Info', 'nautica' ) => 'bg-info',
						esc_html__( 'Danger', 'nautica' ) => 'bg-danger',
						esc_html__( 'Warning', 'nautica' ) => 'bg-warning',
						esc_html__( 'Light', 'nautica' ) => 'bg-default',
					),
					'std' => 'nostyle',
				),

				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'nautica'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textarea",
					"heading" => esc_html__("information", 'nautica'),
					"param_name" => "information",
					"value" => 'Your Description Here',
					'description'	=> esc_html__('Allow  put html tags', 'nautica' )
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
				"name" => esc_html__("Engo Inactive banner", 'nautica'),
				"base" => "engo_interactive_banner",
				'icon' => 'engo-vc-icon',

				"description"=> esc_html__('Insert banner with effect', 'nautica'),
				"class" => "",
				"category" => esc_html__('ENGO Widgets', 'nautica'),
				"params" => array(

						array(
								"type" => "textfield",
								"heading" => esc_html__("Title", 'nautica'),
								"param_name" => "title",
								"value" => '',    "admin_label" => true,
						),
						array(
								"type" => "textfield",
								"heading" => esc_html__("Link url", 'nautica'),
								"param_name" => "link_url",
								"value" => '',
						),
						array(
								'type' => 'colorpicker',
								'heading' => esc_html__( 'Title Color', 'nautica' ),
								'param_name' => 'title_color',
								'description' => esc_html__( 'Select font color', 'nautica' )
						),
						array(
								"type" => "textfield",
								"heading" => esc_html__("Sub Title", 'nautica'),
								"param_name" => "subtitle",
								"value" => '',
						),
						array(
								"type" => "dropdown",
								"heading" => esc_html__("Effect", 'nautica'),
								"param_name" => "style",
								'value' 	=> array(
										esc_html__('Default', 'nautica') => '',
										esc_html__('Version 1', 'nautica') => 'v1',
										esc_html__('Version 2', 'nautica') => 'v2',
										esc_html__('Version 3', 'nautica' )=> 'v3',
										esc_html__('Version 4', 'nautica') => 'v4'
								),
								'std' => ''
						),

						array(
								'type'                           => 'dropdown',
								'heading'                        => esc_html__( 'Title Alignment', 'nautica' ),
								'param_name'                     => 'title_align',
								'value'                          => array(
										esc_html__( 'Align left', 'nautica' )   => 'separator_align_left',
										esc_html__( 'Align center', 'nautica' ) => 'separator_align_center',
										esc_html__( 'Align right', 'nautica' )  => 'separator_align_right'
								),
								'std' => 'separator_align_left'
						),

						array(
								"type" => "attach_image",
								"heading" => esc_html__("Banner", 'nautica'),
								"param_name" => "banner",
								"value" => '',
								'description'	=> ''
						),
						array(
								'type'                           => 'dropdown',
								'heading'                        => esc_html__( 'Banner Alignment', 'nautica' ),
								'param_name'                     => 'banner_alignment',
								'value'                          => array(
										esc_html__( 'Left', 'nautica' )   => 'left',
										esc_html__( 'Center', 'nautica' ) => 'center',
										esc_html__( 'Right', 'nautica' )  => 'right'
								),
						),
						array(
								"type" => "textarea",
								"heading" => esc_html__("Banner Description", 'nautica'),
								"param_name" => "description",
								"value" => 'Your Description Here',
								'description'	=> esc_html__('Allow  put html tags', 'nautica' )
						),

						array(
								"type" => "textfield",
								"heading" => esc_html__("Extra class name", 'nautica'),
								"param_name" => "el_class",
								"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
						),
						array(
								'type' => 'css_editor',
								'heading' => esc_html__( 'Css', 'nautica' ),
								'param_name' => 'css',
								'group' => esc_html__( 'Design options', 'nautica' ),
						)
				)
		));
		 
	   	/*********************************************************************************************************************
		 * Pricing Table
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("ENGO Pricing", 'nautica'),
		    "base" => "engo_pricing",
				'icon' => 'engo-vc-icon',
		    "description" => esc_html__('Make Plan for membership', 'nautica' ),
		    "class" => "",
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
					"type" => "textfield",
					"heading" => esc_html__("Price", 'nautica'),
					"param_name" => "price",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'nautica'),
					"param_name" => "currency",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Period", 'nautica'),
					"param_name" => "period",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'nautica'),
					"param_name" => "subtitle",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Is Featured", 'nautica'),
					"param_name" => "featured",
					'value' 	=> array(  esc_html__('No', 'nautica') => 0,  esc_html__('Yes', 'nautica') => 1 ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Skin", 'nautica'),
					"param_name" => "skin",
					'value' 	=> array(  esc_html__('Skin 1', 'nautica') => 'v1',  esc_html__('Skin 2', 'nautica') => 'v2', esc_html__('Skin 3', 'nautica') => 'v3' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Box Style", 'nautica'),
					"param_name" => "style",
					'value' 	=> array( 'boxed' => esc_html__('Boxed', 'nautica')),
				),

				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'nautica'),
					"param_name" => "content",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'nautica')
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Link Title", 'nautica'),
					"param_name" => "linktitle",
					"value" => 'SignUp',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Link", 'nautica'),
					"param_name" => "link",
					"value" => 'http://yourdomain.com',
					'description'	=> ''
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
		 *  ENGO Counter
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("ENGO Counter", 'nautica'),
		    "base" => "engo_counter",
				'icon' => 'engo-vc-icon',
		    "class" => "",
		    "description"=> esc_html__('Counting number with your term', 'nautica'),
		    "category" => esc_html__('ENGO Widgets', 'nautica'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nautica'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'nautica'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'nautica'),
					"param_name" => "number",
					"value" => ''
				),

			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'nautica'),
					"param_name" => "icon",
					"value" => '',
					'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'nautica' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'nautica' ) . '</a>'
				),


				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'nautica'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'nautica' )
				),

		 

				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Text Color", 'nautica'),
					"param_name" => "text_color",
					'value' 	=> '',
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
		 *  Engo Instagram
		 *********************************************************************************************************************/
		vc_map( array(
				"name" => esc_html__("Engo Instagram", 'nautica'),
				"base" => "engo_instagram",
				'icon' => 'engo-vc-icon',
				"class" => "",
				"description"=> esc_html__('Instagram widget', 'nautica'),
				"category" => esc_html__('ENGO Widgets', 'nautica'),
				"params" => array(
						array(
								"type" => "textfield",
								"heading" => esc_html__("Title", 'nautica'),
								"param_name" => "title",
								"value" => '',
								"admin_label"	=> true
						),
						array(
								"type" => "textarea",
								"heading" => esc_html__("Description", 'nautica'),
								"param_name" => "description",
								"value" => '',
						),
						array(
								"type" => "textfield",
								"heading" => esc_html__("Instagram username", 'nautica'),
								"param_name" => "username",
								"value" => ''
						),
						array(
								"type" => "textfield",
								"heading" => esc_html__("Number photos", 'nautica'),
								"param_name" => "number",
								"value" => ''
						),
						array(
								"type" => "dropdown",
								"heading" => esc_html__("Image size", 'nautica'),
								"param_name" => "size",
								'value' 	=> array(
										esc_html__('Thumbnail', 'nautica') => 'thumbnail',
										esc_html__('Small', 'nautica') => 'small',
										esc_html__('Large', 'nautica') => 'large' ),
										esc_html__('Original', 'nautica') => 'original' )
						),
						array(
								"type" => "textfield",
								"heading" => esc_html__("FontAwsome Icon", 'nautica'),
								"param_name" => "icon",
								"value" => '',
								'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'nautica' )
										. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
										. esc_html__( 'here to see the list', 'nautica' ) . '</a>'
						),

						array(
								"type" => "textfield",
								"heading" => esc_html__("Extra class name", 'nautica'),
								"param_name" => "el_class",
								"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
						)
		));
		 
	}
}