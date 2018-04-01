<?php 
class Nautica_VC_News implements Vc_Vendor_Interface  {
	
	public function load(){
		 
		$newssupported = true; 
 
			/**********************************************************************************
			 * Front Page Posts
			 **********************************************************************************/
/// Front Page default
		vc_map( array(
			'name' => esc_html__( '(News) FrontPage Default', 'nautica' ),
			'base' => 'engo_frontpageposts_default',
			'icon' => 'icon-wpb-news-2',
			"category" => esc_html__('ENGO News', 'nautica'),
			'description' => esc_html__( 'Create Post having blog styles default', 'nautica' ),

			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'js_composer' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
					"admin_label" => true
				),



				array(
					'type' => 'loop',
					'heading' => esc_html__( 'Grids content', 'js_composer' ),
					'param_name' => 'loop',
					'settings' => array(
						'size' => array( 'hidden' => false, 'value' => 4 ),
						'order_by' => array( 'value' => 'date' ),
					),
					'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout", 'nautica' ),
					"param_name" => "layout",
					"value" => array( esc_html__('Grid default', 'nautica' ) => 'news_grid' , esc_html__('List default', 'nautica' ) => 'news_list'  ,  esc_html__('Grid masonry', 'nautica' ) => 'news_masonry'),
					"std" => 3,
					'admin_label'=> true
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Grid Columns", 'js_composer'),
					"param_name" => "grid_columns",
					"value" => array( 1 , 2 , 3 , 4 , 6),
					"std" => 5
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
					'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: post-thumbnail, nautica-post-fullwidth, thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Thumbnail position", 'js_composer'),
					"param_name" => "thumbnai_position",
					"value" => array( esc_html__('Default', 'nautica' ) => '' , esc_html__('Left', 'nautica' ) => 'image_left'  ,  esc_html__('Right', 'nautica' ) => 'image_right'),
					"std" => 4
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
				)
			)
		) );



			/// Front Page 1
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 1', 'nautica' ),
				'base' => 'engo_frontpageposts',
				'icon' => 'icon-wpb-news-1',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

					 
					 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'js_composer'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
			// front page 2
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 2', 'nautica' ),
				'base' => 'engo_frontpageposts2',
				'icon' => 'icon-wpb-news-8',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

			 
					 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'js_composer'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
			// front page 3
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 3', 'nautica' ),
				'base' => 'engo_frontpageposts3',
				'icon' => 'icon-wpb-news-3',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

					 

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'js_composer'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
			// front page 2
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 4', 'nautica' ),
				'base' => 'engo_frontpageposts4',
				'icon' => 'icon-wpb-news-4',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

				 
				 

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
			
				// front page 12
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 12', 'nautica' ),
				'base' => 'engo_frontpageposts12',
				'icon' => 'icon-wpb-news-12',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

				 
					 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
		// frontpage 13
			vc_map( array(
				'name' => esc_html__( '(News) FontPage 13', 'nautica' ),
				'base' => 'engo_frontpageposts13',
				'icon' => 'icon-wpb-news-13',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Categories Tab Hovering to show post', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

					

					 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );	

				/**********************************************************************************
			 * FontPage News 14
			 **********************************************************************************/
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 14', 'nautica' ),
				'base' => 'engo_frontpageposts14',
				'icon' => 'icon-wpb-news-1',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

				 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'js_composer'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
			
		vc_map( array(
				'name' => esc_html__( '(News) Categories Post', 'nautica' ),
				'base' => 'engo_categoriespost',
				'icon' => 'icon-wpb-news-3',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

					 

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					 

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );	

		// front page 9
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 9', 'nautica' ),
				'base' => 'engo_frontpageposts9',
				'icon' => 'icon-wpb-news-9',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),
 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Grid Columns", 'js_composer'),
						"param_name" => "grid_columns",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );

			// front page 3
			vc_map( array(
				'name' => esc_html__( '(Blog) TimeLine Post', 'nautica' ),
				'base' => 'engo_timelinepost',
				'icon' => 'icon-wpb-news-10',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),
 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					 

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Enable Pagination', 'nautica' ),
						'param_name' => 'pagination',
						'value' => array( 'No'=>'0', 'Yes'=>'1'),
						'std' => '0',
						'admin_label' => true,
						'description' => esc_html__( 'Select style display.', 'nautica' )
					)
				)
			) );

			/****/
			vc_map( array(
				'name' => esc_html__( '(News) Categories Tab Post', 'nautica' ),
				'base' => 'engo_categorytabpost',
				'icon' => 'icon-wpb-application-icon-large',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

				 
					 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),

				 

					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'js_composer'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
			

			$layout_image = array(
				esc_html__('Grid', 'nautica')             => 'grid-1',
				esc_html__('List', 'nautica')             => 'list-1',
				esc_html__('List not image', 'nautica')   => 'list-2',
			);
			
			vc_map( array(
				'name' => esc_html__( '(News) Grid Posts', 'nautica' ),
				'base' => 'engo_gridposts',
				'icon' => 'icon-wpb-news-2',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Post having news,managzine style', 'nautica' ),
			 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),
 
				 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'js_composer'),
						"param_name" => "layout",
						"layout_images" => $layout_image,
						"value" => $layout_image,
						"admin_label" => true,
						"description" => esc_html__("Select Skin layout.", 'js_composer')
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),

					array(
						"type" => "dropdown",
						"heading" => esc_html__("Grid Columns", 'js_composer'),
						"param_name" => "grid_columns",
						"value" => array( 1 , 2 , 3 , 4 , 6),
						"std" => 3
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );


			
			/**********************************************************************************
			 * Mega Blogs
			 **********************************************************************************/

			/// Front Page 1
			vc_map( array(
				'name' => esc_html__( '(Blog) FrontPage', 'nautica' ),
				'base' => 'engo_frontpageblog',
				'icon' => 'icon-wpb-news-1',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),
		 			 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'js_composer'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );


			vc_map( array(
				'name' => esc_html__('(Blog) Grids ', 'nautica' ),
				'base' => 'engo_megablogs',
				'icon' => 'icon-wpb-news-2',
				"category" => esc_html__('ENGO News', 'nautica'),
				'description' => esc_html__( 'Create Post having blog styles', 'nautica' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
						"admin_label" => true
					),

				 

				 
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'nautica' ),
						'param_name' => 'descript',
						"value" => ''
					),

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'js_composer' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 10 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout", 'nautica' ),
						"param_name" => "layout",
						"value" => array( esc_html__('Default Style', 'nautica' ) => 'blog' , esc_html__('Default Style 2', 'nautica' ) => 'blog-v2'  ,  esc_html__('Special Style 1', 'nautica' ) => 'special-1',  esc_html__('Special Style 2', 'nautica' ) => 'special-2',  esc_html__('Special Style 3', 'nautica' ) => 'special-3' ),
						"std" => 3,
						'admin_label'=> true
					),

					array(
						"type" => "dropdown",
						"heading" => esc_html__("Grid Columns", 'js_composer'),
						"param_name" => "grid_columns",
						"value" => array( 1 , 2 , 3 , 4 , 6),
						"std" => 3
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
						'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
		 

			/**********************************************************************************
			 * Slideshow Post Widget Gets
			 **********************************************************************************/
				vc_map( array(
					'name' => esc_html__( '(News) Slideshow Post', 'nautica' ),
					'base' => 'engo_slideshoengost',
					'icon' => 'icon-wpb-news-slideshow',
					"category" => esc_html__('ENGO News', 'nautica'),
					'description' => esc_html__( 'Play Posts In slideshow', 'nautica' ),
					 
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Widget title', 'js_composer' ),
							'param_name' => 'title',
							'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
							"admin_label" => true
						),

					 

						array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Heading Description', 'nautica' ),
							'param_name' => 'descript',
							"value" => ''
						),

						array(
							'type' => 'loop',
							'heading' => esc_html__( 'Grids content', 'js_composer' ),
							'param_name' => 'loop',
							'settings' => array(
								'size' => array( 'hidden' => false, 'value' => 10 ),
								'order_by' => array( 'value' => 'date' ),
							),
							'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
						),

						array(
							"type" => "dropdown",
							"heading" => esc_html__("Layout", 'nautica' ),
							"param_name" => "layout",
							"value" => array( esc_html__('Default Style', 'nautica' ) => 'blog'  ,  esc_html__('Special Style 1', 'nautica' ) => 'style1' ,  esc_html__('Special Style 2', 'nautica' ) => 'style2' ),
							"std" => 3
						),

						array(
							"type" => "dropdown",
							"heading" => esc_html__("Grid Columns", 'js_composer'),
							"param_name" => "grid_columns",
							"value" => array( 1 , 2 , 3 , 4 , 6),
							"std" => 3
						),
						array(
							'type' => 'checkbox',
							'heading' => esc_html__( 'Show Pagination Links', 'nautica' ),
							'param_name' => 'show_pagination',
							'description' => esc_html__( 'Enables to show paginations to next new page.', 'nautica' ),
							'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Thumbnail size', 'js_composer' ),
							'param_name' => 'thumbsize',
							'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Extra class name', 'js_composer' ),
							'param_name' => 'el_class',
							'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
						)
					)
				) );
 
	}
}