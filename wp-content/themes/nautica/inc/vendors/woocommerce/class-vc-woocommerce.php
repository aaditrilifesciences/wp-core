<?php 
if( class_exists("WPBakeryShortCode") ){
	/**
	 * Class Nautica_VC_Woocommerces
	 *
	 */
	class Nautica_VC_Woocommerce  implements Vc_Vendor_Interface  {

		/**
		 * register and mapping shortcodes
		 */
		public function product_category_field_search( $search_string ) { die ;
			$data = array();
			$vc_taxonomies_types = array('product_cat');
			$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
				'hide_empty' => false,
				'search' => $search_string
			) );
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = vc_get_term_object( $t );
					}
				}
			}
			return $data;
		}
		

		public function product_category_render($query) {  
			$category = get_term_by('id', (int)$query['value'], 'product_cat');
			if ( ! empty( $query ) && !empty($category)) {
				$data = array();
				$data['value'] = $category->term_id;
				$data['label'] = $category->name;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}

		/**
		 * Autocomplete suggester to search product category by name/slug or id.
		 * @since 4.4
		 *
		 * @param $query
		 * @param bool $slug - determines what output is needed
		 *      default false - return id of product category
		 *      true - return slug of product category
		 *
		 * @return array
		 */
		public function productCategoryCategoryAutocompleteSuggester( $query, $slug = false ) {
			global $wpdb;
			$cat_id = (int) $query;
			$query = trim( $query );
			$post_meta_infos = $wpdb->get_results(
				$wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
						FROM {$wpdb->term_taxonomy} AS a
						INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
						WHERE a.taxonomy = 'product_cat' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )",
					$cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A
			);

			$result = array();
			if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
				foreach ( $post_meta_infos as $value ) {
					$data = array();
					$data['value'] = $slug ? $value['slug'] : $value['id'];
					$data['label'] = esc_html__( 'Id', 'js_composer' ) . ': ' .
						$value['id'] .
						( ( strlen( $value['name'] ) > 0 ) ? ' - ' . esc_html__( 'Name', 'js_composer' ) . ': ' .
							$value['name'] : '' ) .
						( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . esc_html__( 'Slug', 'js_composer' ) . ': ' .
							$value['slug'] : '' );
					$result[] = $data;
				}
			}

			return $result;
		}

		/**
		 * Suggester for autocomplete to find product category by id/name/slug but return found product category SLUG
		 * @since 4.4
		 *
		 * @param $query
		 *
		 * @return array - slug of products categories.
		 */
		public function productCategoryCategoryAutocompleteSuggesterBySlug( $query ) {
			$result = $this->productCategoryCategoryAutocompleteSuggester( $query, true );

			return $result;
		}

		/**
		 * Search product category by slug.
		 * @since 4.4
		 *
		 * @param $query
		 *
		 * @return bool|array
		 */
		public function productCategoryCategoryRenderBySlugExact( $query ) {
			$query = $query['value'];
			$query = trim( $query );
			$term = get_term_by( 'slug', $query, 'product_cat' );

			return $this->productCategoryTermOutput( $term );
		}

		/**
		 * Return product category value|label array
		 *
		 * @param $term
		 *
		 * @since 4.4
		 * @return array|bool
		 */
		protected function productCategoryTermOutput( $term ) {
			$term_slug = $term->slug;
			$term_title = $term->name;
			$term_id = $term->term_id;

			$term_slug_display = '';
			if ( ! empty( $term_slug ) ) {
				$term_slug_display = ' - ' . esc_html__( 'Sku', 'js_composer' ) . ': ' . $term_slug;
			}

			$term_title_display = '';
			if ( ! empty( $term_title ) ) {
				$term_title_display = ' - ' . esc_html__( 'Title', 'js_composer' ) . ': ' . $term_title;
			}

			$term_id_display = esc_html__( 'Id', 'js_composer' ) . ': ' . $term_id;

			$data = array();
			$data['value'] = $term_id;
			$data['label'] = $term_id_display . $term_title_display . $term_slug_display;

			return ! empty( $data ) ? $data : false;
		}

		/**
		 * register and mapping shortcodes
		 */
		public function load(){
//Filters For autocomplete param:
			//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
			$shortcodes = array(
				'engo_categoriestabs' => 'categories',
			);

			foreach( $shortcodes as $shortcode => $param_name ){
				add_filter( 'vc_autocomplete_'.$shortcode .'_'.$param_name.'_callback', array($this, 'productCategoryCategoryAutocompleteSuggesterBySlug'), 10, 1 );// Get suggestion(find). Must return an array
			 	add_filter( 'vc_autocomplete_'.$shortcode .'_'.$param_name.'_render', array($this, 'productCategoryCategoryRenderBySlugExact'), 10, 1 );// Render exact category by Slug. Must return an array (label,value)
			}
			$order_by_values = array(
				'',
				esc_html__( 'Date', 'js_composer' ) => 'date',
				esc_html__( 'ID', 'js_composer' ) => 'ID',
				esc_html__( 'Author', 'js_composer' ) => 'author',
				esc_html__( 'Title', 'js_composer' ) => 'title',
				esc_html__( 'Modified', 'js_composer' ) => 'modified',
				esc_html__( 'Random', 'js_composer' ) => 'rand',
				esc_html__( 'Comment count', 'js_composer' ) => 'comment_count',
				esc_html__( 'Menu order', 'js_composer' ) => 'menu_order',
			);

			$order_way_values = array(
				'',
				esc_html__( 'Descending', 'js_composer' ) => 'DESC',
				esc_html__( 'Ascending', 'js_composer' ) => 'ASC',
			);
			$product_categories_dropdown = array('none'=> esc_html__('None', 'nautica') );
			$block_styles = nautica_fnc_get_widget_block_styles();
			
			$product_layout = array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel', 'Special'=>'special', 'List-v1' => 'list-v1');
			$product_type = array('Best Selling'=>'best_selling','Featured Products'=>'featured_product','Top Rate'=>'top_rate','Recent Products'=>'recent_product','On Sale'=>'on_sale','Recent Review' => 'recent_review' );
			$product_columns = array('6 items' => 6 ,'4 items' => 4 , '3 items' => 3, '2 items' => 2, '1 items' => 1, 'Custom responsive' => 'custom_responsive');
			$nautica_product_columns_responsive = array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Columns', 'js_composer' ),
					'value' => $product_columns,
					'param_name' => 'columns',
					'std' => 4,
					'description' => __( 'How much columns grid', 'js_composer' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Large screen (Full HD)', 'js_composer' ),
					'param_name' => 'columns_lg',
					'description' => __( 'Select items for large screen', 'js_composer' ),
					'dependency' => array(
						'element' => 'columns',
						'value' => 'custom_responsive',
					),
					'value' => array(1,2,3,4,6),
					'std' => 6
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Medium screen (Desktop)', 'js_composer' ),
					'param_name' => 'columns_md',
					'description' => __( 'Select items for medium screen', 'js_composer' ),
					'dependency' => array(
						'element' => 'columns',
						'value' => 'custom_responsive',
					),
					'value' => array(1,2,3,4,6),
					'std' => 4
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Small screen (Tablet)', 'js_composer' ),
					'param_name' => 'columns_sm',
					'description' => __( 'Select items for small screen', 'js_composer' ),
					'dependency' => array(
						'element' => 'columns',
						'value' => 'custom_responsive',
					),
					'value' => array(1,2,3,4,6),
					'std' => 2
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Extra small screen (Phone)', 'js_composer' ),
					'param_name' => 'columns_xs',
					'description' => __( 'Select items for medium screen', 'js_composer' ),
					'dependency' => array(
						'element' => 'columns',
						'value' => 'custom_responsive',
					),
					'value' => array(1,2,3,4,6),
					'std' => 1
				),
			);

			if( is_admin() ){
					$args = array(
						'type' => 'post',
						'child_of' => 0,
						'parent' => '',
						'orderby' => 'name',
						'order' => 'ASC',
						'hide_empty' => false,
						'hierarchical' => 1,
						'exclude' => '',
						'include' => '',
						'number' => '',
						'taxonomy' => 'product_cat',
						'pad_counts' => false,

					);

					$categories = get_categories( $args );
					nautica_fnc_woocommerce_getcategorychilds( 0, 0, $categories, 0, $product_categories_dropdown );
					
			}
		    vc_map( array(
		        "name" => esc_html__("ENGO Product Deals", 'nautica'),
		        "base" => "engo_product_deals",

					'icon' => 'engo-vc-icon',
		        "class" => "",
		    	"category" => esc_html__('ENGO Woocommerce', 'nautica'),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'nautica' ),
		        "params" => array_merge(array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title', 'nautica'),
		                "param_name" => "title",
		            ),

		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),

		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'nautica'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'nautica'),
		                "param_name" => "number",
		                'std' => '1',
		                "description" => esc_html__("Number items to show", 'nautica')
		            ),

		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Layout", 'nautica'),
		                "param_name" => "layout",
		                "value" => array(esc_html__('Carousel', 'nautica') => 'carousel', esc_html__('Grid', 'nautica') =>'grid' ),
		                "admin_label" => true,
		                "description" => esc_html__("Select columns count.", 'nautica')
		            )
		        ), $nautica_product_columns_responsive)
		    ));
			vc_map( array(
					"name" => esc_html__("ENGO Custom Deal", 'nautica'),
					"base" => "engo_custom_deals",
					'icon' => 'engo-vc-icon',

					"category" => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
					"description" => esc_html__( 'Display custom deals in sale campaign', 'js_composer' ),
					"class"		=> '',
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
									"type" => "attach_image",
									"heading" => esc_html__("Photo", 'nautica'),
									"param_name" => "photo",
									"value" => '',
									'description'	=> ''
							),
							array(
									'type' => 'colorpicker',
									'heading' => esc_html__( 'Background color', 'nautica' ),
									'param_name' => 'background_color',
									'description' => esc_html__( 'Select background color', 'nautica' )
							),
							array(
									"type" => "datetime_picker",
									"holder" => "div",
									"class" => "",
									"heading" => esc_html__("End date in", 'nautica'),
									"param_name" => "end_date_countdown",
									"value" => '',
									"description" => esc_html__( "Select end date", 'nautica' ),
							),
							array(
									"type" => "textfield",
									"heading" => esc_html__("Extra class name", 'nautica'),
									"param_name" => "el_class",
									"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
							)
					),
					'admin_enqueue_js' => array(
							get_template_directory_uri().'/inc/vendors/visualcomposer/assets/DateTimePicker/jquery.datetimepicker.full.min.js'
					),
			));

			vc_map( array(
					"name" => esc_html__("ENGO product intro", 'nautica'),
					"base" => "engo_product_intro",
					'icon' => 'engo-vc-icon',

					"category" => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
					"description" => esc_html__( 'Display product intro in carosel', 'js_composer' ),
					"class"		=> '',
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
									"type" => "attach_image",
									"heading" => esc_html__("Photo", 'nautica'),
									"param_name" => "photo",
									"value" => '',
									'description'	=> ''
							),
							array(
									'type' => 'colorpicker',
									'heading' => esc_html__( 'Background color', 'nautica' ),
									'param_name' => 'background_color',
									'description' => esc_html__( 'Select background color', 'nautica' )
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
					'name' => esc_html__( 'Pageable Container sections', 'js_composer' ),
					'base' => 'engo_pageable_container_sections',
					'icon' => 'engo-vc-icon',
					'is_container' => true,
					'show_settings_on_create' => false,
					'as_parent' => array(
							'only' => 'vc_tta_section',
					),
					'category' => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
					'description' => esc_html__( 'Pageable content container', 'js_composer' ),
					'params' => array_merge(array(
							array(
									'type' => 'textfield',
									'param_name' => 'title',
									'heading' => esc_html__( 'Widget title', 'js_composer' ),
									'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'js_composer' ),
							),
							array(
									"type" => "textfield",
									"heading" => esc_html__("Number items to show", 'nautica'),
									"param_name" => "number",
									'std' => '12',
									"description" => esc_html__("Enter number items to get in this wiget", 'nautica'),
									"admin_label" => true
							),
							array(
									"type" => "dropdown",
									"heading" => esc_html__("Style", 'nautica'),
									"param_name" => "style",
									"value" => array('Carousel'=>'carousel')
							),
							array(
									"type" => "dropdown",
									"heading" => esc_html__("Carousel control effect", 'nautica'),
									"param_name" => "carousel_control_effect",
									"value" => array(
											esc_html__( "Default", 'nautica' ) =>'animate',
											esc_html__( "Fixed", 'nautica' ) =>'fixed',
											esc_html__( "Animate", 'nautica' ) =>'animate'
									)
							),
							array(
									'type' => 'textfield',
									'heading' => esc_html__( 'Extra class name', 'js_composer' ),
									'param_name' => 'el_class',
									'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
							),
							array(
									'type' => 'css_editor',
									'heading' => esc_html__( 'CSS box', 'js_composer' ),
									'param_name' => 'css',
									'group' => esc_html__( 'Design Options', 'js_composer' ),
							),
					), $nautica_product_columns_responsive),
					'js_view' => 'VcBackendTtaPageableView',
					'custom_markup' => '
								<div class="vc_tta-container vc_tta-o-non-responsive" data-vc-action="collapse">
									<div class="vc_general vc_tta vc_tta-tabs vc_tta-pageable vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
										<div class="vc_tta-tabs-container">'
															. '<ul class="vc_tta-tabs-list">'
															. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
															. '</ul>
										</div>
										<div class="vc_tta-panels vc_clearfix {{container-class}}">
										  {{ content }}
										</div>
									</div>
								</div><style type="text/css">.vc_controls>.vc_controls-cc {top:20% !important;}</style>',
													'default_content' => '
								[vc_tta_section title="' . sprintf( '%s %d', esc_html__( 'Section', 'js_composer' ), 1 ) . '"][/vc_tta_section]
								[vc_tta_section title="' . sprintf( '%s %d', esc_html__( 'Section', 'js_composer' ), 2 ) . '"][/vc_tta_section]
									',
					'admin_enqueue_js' => array(
							vc_asset_url( 'lib/vc_tabs/vc-tabs.js' )
					),
			) );

			vc_map( array(
		        "name" => esc_html__("ENGO Timing Deals", 'nautica'),
		        "base" => "engo_timing_deals",
					'icon' => 'engo-vc-icon',
		        "class" => "",
		    	"category" => esc_html__('ENGO Woocommerce', 'nautica'),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'nautica' ),
		        "params" => array_merge(array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title', 'nautica'),
		                "param_name" => "title",
		                "admin_label" => true
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Desciption', 'nautica'),
		                "param_name" => "description",
		                "admin_label" => false
		            ),
						array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'End Date In %s Days', 'nautica' ),
								'param_name' => 'date_countdown',
								'description' => esc_html__( 'Enter Date Count down', 'nautica' ),
								"value" => array( 30,20,15,7, 3)

						),

		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'nautica'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
		            )

		            
		        ), $nautica_product_columns_responsive)
		    ));
	 
		    //// 
		    vc_map( array(
		        "name" => esc_html__( "ENGO Products On Sale", 'nautica' ),
		        "base" => "engo_products_onsale",
					'icon' => 'engo-vc-icon',
		        "class" => "",
		    	"category" => esc_html__( 'ENGO Woocommerce', 'nautica' ),
		    	'description'	=> esc_html__( 'Display Products Sales With Pagination', 'nautica' ),
		        "params" => array_merge(array(
		            array(
		                "type" 		  => "textfield",
		                "class" 	  => "",
		                "heading" 	  => esc_html__( 'Title', 'nautica' ),
		                "param_name"  => "title",
		                "admin_label" => true
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'nautica'),
		                "param_name" => "number",
		                'std' => '9',
		                "description" => esc_html__("Number items to show", 'nautica'),
		                  "admin_label" => true
		            ),

		            array(
		                "type" 		  => "textfield",
		                "heading" 	  => esc_html__( "Extra class name", 'nautica' ),
		                "param_name"  => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
		            )
		        ), $nautica_product_columns_responsive)
		    ));
		  
			/**
			 * engo_productcategory
			 */
		 


			$show_tab = array(
			                array('recent', esc_html__('Latest Products', 'nautica')),
			                array( 'featured_product', esc_html__('Featured Products', 'nautica' )),
			                array('best_selling', esc_html__('BestSeller Products', 'nautica' )),
			                array('top_rate', esc_html__('TopRated Products', 'nautica' )),
			                array('on_sale', esc_html__('Special Products', 'nautica' ))
			            );

			vc_map( array(
			    "name" => esc_html__("ENGO Product Category", 'nautica'),
			    "base" => "engo_productcategory",
					'icon' => 'engo-vc-icon',
			    "class" => "",
			 "category" => esc_html__('ENGO Woocommerce', 'nautica'),
			     'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special', 'nautica' ),
			    "params" => array_merge(array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'nautica'),
						"param_name" => "title",
						"value" =>''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Category', 'nautica'),
						"param_name" => "category",
						"value" => $product_categories_dropdown,
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'nautica'),
						"param_name" => "style",
						"value" => $product_layout,
						"admin_label" => true
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'nautica'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'nautica' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'nautica'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon", 'nautica'),
						"param_name" => "icon"
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Block Styles", 'nautica'),
						"param_name" => "block_style",
						"value" => $block_styles,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'nautica')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'nautica'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
					)
			   	), $nautica_product_columns_responsive)
			));
			 
			vc_map( array(
			    "name" => esc_html__("ENGO Products Category Index", 'nautica'),
			    "base" => "engo_productcategory_index",
					'icon' => 'engo-vc-icon',
			    "class" => "",
				 "category" => esc_html__('ENGO Woocommerce', 'nautica'),
			     'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special', 'nautica' ),
			    "params" => array_merge(array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'nautica'),
						"param_name" => "title",
						"value" =>''
					),

					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Category', 'nautica'),
						"param_name" => "category",
						"value" => $product_categories_dropdown,
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'nautica'),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'nautica'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'nautica' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'nautica'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Block Styles", 'nautica'),
						"param_name" => "block_style",
						"value" => $block_styles,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'nautica')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon", 'nautica'),
						"param_name" => "icon",
						'value'	=> 'fa-gear'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'nautica'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
					)
			   	), $nautica_product_columns_responsive)
			));
			 
			/**
			* engo_category_filter
			*/
		 
			vc_map( array(
					"name"     => esc_html__("ENGO Product Categories Filter", 'nautica'),
					"base"     => "engo_category_filter",
					'icon' => 'engo-vc-icon',
					'description' => esc_html__( 'Show images and links of sub categories in block', 'nautica' ),
					"class"    => "",
					"category" => esc_html__('ENGO Woocommerce', 'nautica'),
					"params"   => array(

					array(
						"type" => "dropdown",
						"heading" => esc_html__('Category', 'nautica'),
						"param_name" => "term_id",
						"value" =>$product_categories_dropdown,	"admin_label" => true
					),

					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'nautica'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'nautica' )
					),

					array(
						"type"       => "textfield",
						"heading"    => esc_html__("Number of categories to show", 'nautica'),
						"param_name" => "number",
						"value"      => '5',

					),

					array(
						"type"        => "textfield",
						"heading"     => esc_html__("Extra class name", 'nautica'),
						"param_name"  => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
					)
			   	)
			));

			/**
			 * engo_products
			 */
			vc_map( array(
			    "name" => esc_html__("ENGO Products", 'nautica'),
			    "base" => "engo_products",
					'icon' => 'engo-vc-icon',
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'nautica' ),
			    "class" => "",
			   "category" => esc_html__('ENGO Woocommerce', 'nautica'),
			    "params" => array_merge(array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'nautica'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type", 'nautica'),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'nautica')
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'nautica'),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button templates", 'nautica'),
						"param_name" => "button_template",
						"value" => array(
								esc_html__( 'Default', 'nautica' ) => '',
								esc_html__( 'Mini button', 'nautica' ) => 'mini',
								esc_html__( 'Normal button', 'nautica' ) => 'normal'
						),
						"admin_label" => true,
						"description" => esc_html__("Select button templates.", 'nautica')
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'nautica'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'nautica'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
					)
			   	), $nautica_product_columns_responsive)
			));
			 

			/**
			 * engo_all_products
			 */
			vc_map( array(
			    "name" => esc_html__("ENGO Products Tabs", 'nautica'),
			    "base" => "engo_tabs_products",
					'icon' => 'engo-vc-icon',
			    'description'	=> esc_html__( 'Display BestSeller, TopRated ... Products In tabs', 'nautica' ),
			    "class" => "",
			   "category" => esc_html__('ENGO Woocommerce', 'nautica'),
			    "params" => array_merge(array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'nautica'),
						"param_name" => "title",
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
					array(
			            "type" => "sorted_list",
			            "heading" => esc_html__("Show Tab", "js_composer"),
			            "param_name" => "show_tab",
			            "description" => esc_html__("Control teasers look. Enable blocks and place them in desired order.", 'nautica'),
			            "value" => "recent,featured_product,best_selling",
			            "options" => $show_tab
			        ),
			        array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'nautica'),
						"param_name" => "style",
						"value" => $product_layout
					),
						array(
								"type" => "dropdown",
								"heading" => esc_html__("Button templates", 'nautica'),
								"param_name" => "button_template",
								"value" => array(
										esc_html__( 'Default', 'nautica' ) => '',
										esc_html__( 'Mini button', 'nautica' ) => 'mini',
										esc_html__( 'Normal button', 'nautica' ) => 'normal'
								),
								"admin_label" => true,
								"description" => esc_html__("Select button templates.", 'nautica')
						),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'nautica'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'nautica'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
					)
			   	), $nautica_product_columns_responsive)
			));

			vc_map( array(
				"name"     => esc_html__("ENGO Product Categories List", 'nautica'),
				"base"     => "engo_category_list",
					'icon' => 'engo-vc-icon',
				"class"    => "",
				"category" => esc_html__('ENGO Woocommerce', 'nautica'),
				'description' => esc_html__( 'Show Categories as menu Links', 'nautica' ),
				"params"   => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__('Title', 'nautica'),
					"param_name" => "title",
					"value"      => '',
				),
				 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'nautica'),
		                "param_name" => "subtitle",
		            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post counts', 'nautica' ),
					'param_name' => 'show_count',
					'description' => esc_html__( 'Enables show count total product of category.', 'nautica' ),
					'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
				),
				array(
					"type"       => "checkbox",
					"heading"    => esc_html__("show children of the current category", 'nautica'),
					"param_name" => "show_children",
					'description' => esc_html__( 'Enables show children of the current category.', 'nautica' ),
					'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
				),
				array(
					"type"       => "checkbox",
					"heading"    => esc_html__("Show dropdown children of the current category ", 'nautica'),
					"param_name" => "show_dropdown",
					'description' => esc_html__( 'Enables show dropdown children of the current category.', 'nautica' ),
					'value' => array( esc_html__( 'Yes, please', 'nautica' ) => 'yes' )
				),

				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra class name", 'nautica'),
					"param_name"  => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)
		   	)
		));
	 


		/**
		 * engo_all_products
		 */
		 
		vc_map( array(
				'name' => esc_html__( 'ENGO Product categories ', 'js_composer' ),
				'base' => 'engo_special_product_categories',
				'icon' => 'engo-vc-icon',
				'category' => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'js_composer' ),
				'params' => array_merge(array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'js_composer' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'js_composer' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'js_composer' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'js_composer' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'js_composer' ),
						'value' => $product_categories_dropdown,
						'param_name' => 'category',
						"admin_label" => true,
						'description' => esc_html__( 'Product category list', 'js_composer' ),
					),
				), $nautica_product_columns_responsive)
			) );
	
		/**
		 * engo_productcats_tabs
		 */
		vc_map( array(
				'name' => esc_html__( 'Categories Tabs ', 'js_composer' ),
				'base' => 'engo_categoriestabs',
				'icon' => 'engo-vc-icon',
				'category' => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
				'description' => esc_html__( 'Display  categories in Tabs', 'js_composer' ),
				'params' => array_merge(array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'js_composer' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'js_composer' ),
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'nautica'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'nautica' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'js_composer' ),
						'param_name' => 'orderby',
						'std' => 'date',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'js_composer' ),
						'param_name' => 'order',
						'std' => 'DESC',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					 array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'nautica' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'nautica' ),
					    'settings' => array(
					     'multiple' => true,
					     'unique_values' => true,
					     // In UI show results except selected. NB! You should manually check values in backend
					    ),
						 'save_always' => true,
				   	),


				), $nautica_product_columns_responsive)
			) );


		/**
		 * engo_productcats_tabs
		 */
		vc_map( array(
				'name' => esc_html__( 'Product Categories Tabs ', 'js_composer' ),
				'base' => 'engo_productcats_tabs',
				'icon' => 'engo-vc-icon',
				'category' => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'js_composer' ),
				'params' => array_merge(array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'js_composer' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'js_composer' ),
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'nautica'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'nautica' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'js_composer' ),
						'param_name' => 'orderby',
						'std' => 'date',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'js_composer' ),
						'param_name' => 'order',
						'std' => 'DESC',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'js_composer' ),
						'value' => $product_categories_dropdown,
						"admin_label" => true,
						'param_name' => 'category',
						'description' => esc_html__( 'Product category list', 'js_composer' ),
					),
				), $nautica_product_columns_responsive)
			) );
		 
		/**
		 * engo_productcats_normal
		 */

		vc_map( array(
				'name' => esc_html__( 'Product Categories Style 1 ', 'js_composer' ),
				'base' => 'engo_productcats_normal',
				'icon' => 'engo-vc-icon',
				'category' => esc_html__( 'ENGO Woocommerce', 'js_composer' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'js_composer' ),

				'params' => array_merge( array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'js_composer' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'js_composer' ),
						
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'nautica'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'nautica' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Float', 'js_composer' ),
						'param_name' => 'image_float',
						'value' => array( esc_html__('Left', 'nautica') =>'pull-left', esc_html__('Right', 'nautica') =>'pull-right' ),
						'description' =>  esc_html__( 'Display banner image on left or right', 'nautica' ),
						'std' => 'pull-left'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'js_composer' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'std' => 'date',
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'js_composer' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'std' => 'DESC',
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'js_composer' ),
						'value' => $product_categories_dropdown,
						'param_name' => 'category',
						'description' => esc_html__( 'Product category list', 'js_composer' ),'admin_label'	=> true
					),
					array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra class name", 'nautica'),
					"param_name"  => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nautica')
				)
				), $nautica_product_columns_responsive)
			) );


		}
	}	

	/**
	  * Register Woocommerce Vendor which will register list of shortcodes
	  */
	function nautica_fnc_init_vc_woocommerce_vendor(){

		$vendor = new Nautica_VC_Woocommerce();
		add_action( 'vc_after_set_mode', array(
			$vendor,
			'load'
		) );

	}
	add_action( 'after_setup_theme', 'nautica_fnc_init_vc_woocommerce_vendor' , 9 );
}		