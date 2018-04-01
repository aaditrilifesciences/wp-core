<?php
/**
 * Add element product list for visual composer.
 *
 * @since   1.0.0
 * @package Valey
 */

function fx_valey_vc_map_products() {
	vc_remove_element( 'products' );
	vc_map(
		array(
			'name'        => esc_html__( 'Products', 'valey' ),
			'description' => esc_html__( 'Show multiple products by ID or SKU.', 'valey' ),
			'base'        => 'fx_products',
			'icon'        => 'icon-wpb-woocommerce',
			'category'    => esc_html__( 'WooCommerce', 'valey' ),
			'params'      => array(
				array(
					'param_name' => 'layout',
					'heading'    => esc_html__( 'List product style', 'valey' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Grid', 'valey' )    => 'grid',
						esc_html__( 'Masonry', 'valey' ) => 'masonry',
					),
				),
				array(
					'param_name' => 'title',
					'heading'    => esc_html__( 'Product List Title', 'valey' ),
					'type'       => 'textfield',
					'dependency' => array(
						'element' => 'layout',
						'value'   => 'grid',
					),
				),
				array(
					'param_name' => 'title_position',
					'heading'    => esc_html__( 'Title Position', 'valey' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'valey' )   => 'tl',
						esc_html__( 'Center', 'valey' ) => 'tc',
						esc_html__( 'Right', 'valey' )  => 'tr',
					),
					'std'        => 'center',
					'dependency' => array(
						'element'   => 'title',
						'not_empty' => true,
					),
				),
				array(
					'param_name' => 'filter',
					'heading'    => esc_html__( 'Enable Filter?', 'valey' ),
					'type'       => 'checkbox',
					'dependency' => array(
						'element' => 'layout',
						'value'   => 'masonry',
					),
				),
				array(
					'param_name'  => 'viewall',
					'heading'     => esc_html__( 'Enable View All?', 'valey' ),
					'type'        => 'checkbox',
					'dependency' => array(
						'element'   => 'title',
						'not_empty' => true,
					),
				),
				array(
					'param_name'  => 'id',
					'heading'     => esc_html__( 'Products', 'valey' ),
					'description' => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'valey' ),
					'type'        => 'autocomplete',
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true,
					),
					'save_always' => true,
					'dependency'  => array(
						'element' => 'display',
						'value'   => 'all',
					),
				),
				array(
					'param_name' => 'sku',
					'type'       => 'hidden',
					'dependency' => array(
						'element' => 'display',
						'value'   => 'all',
					),
				),
				array(
					'param_name' => 'style',
					'heading'    => esc_html__( 'Hover Style', 'valey' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Style 1', 'valey' ) => '1',
						esc_html__( 'Style 2', 'valey' ) => '2',
						esc_html__( 'Style 3', 'valey' ) => '3',
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name' => 'display',
					'heading'    => esc_html__( 'Display', 'valey' ),
					'type' 	     => 'dropdown',
					'value'      => array(
						esc_html__( 'All products', 'valey' ) 		   => 'all',
						esc_html__( 'Recent products', 'valey' ) 	   => 'recent',
						esc_html__( 'Featured products', 'valey' ) 	   => 'featured',
						esc_html__( 'Sale products', 'valey' ) 		   => 'sale',
						esc_html__( 'Best selling products', 'valey' ) => 'selling',
						esc_html__( 'Top Rated Products', 'valey' )    => 'rated',
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name'  => 'orderby',
					'heading'     => esc_html__( 'Order By', 'valey' ),
					'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s. Default by Title', 'valey' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'type'        => 'dropdown',
					'value'       => array(
						esc_html__( 'Title', 'valey' )         => 'title',
						esc_html__( 'Date', 'valey' )          => 'date',
						esc_html__( 'ID', 'valey' )            => 'ID',
						esc_html__( 'Author', 'valey' )        => 'author',
						esc_html__( 'Modified', 'valey' )      => 'modified',
						esc_html__( 'Random', 'valey' )        => 'rand',
						esc_html__( 'Comment count', 'valey' ) => 'comment_count',
						esc_html__( 'Menu order', 'valey' )    => 'menu_order',
					),
					'dependency'  => array(
						'element' => 'display',
						'value' => array( 'all', 'featured', 'sale', 'rated' ),
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name'  => 'order',
					'heading'     => esc_html__( 'Order', 'valey' ),
					'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s. Default by ASC', 'valey' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'type'        => 'dropdown',
					'value'       => array(
						esc_html__( 'Ascending', 'valey' ) => 'ASC',
						esc_html__( 'Descending', 'valey' ) => 'DESC',
					),
					'dependency' => array(
						'element' => 'display',
						'value'   => array( 'all', 'featured', 'sale', 'rated' ),
					),
					'edit_field_class' => 'vc_col-xs-6 vc_column pt__15',
				),
				array(
					'param_name'  => 'limit',
					'heading'     => esc_html__( 'Per Page', 'valey' ),
					'description' => esc_html__( 'How much items per page to show (-1 to show all products)', 'valey' ),
					'type'        => 'textfield',
					'value'       => 12,
				),
				array(
					'param_name' => 'columns',
					'heading'    => esc_html__( 'Columns', 'valey' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( '2 columns', 'valey' ) => '2',
						esc_html__( '3 columns', 'valey' ) => '3',
						esc_html__( '4 columns', 'valey' ) => '4',
						esc_html__( '5 columns', 'valey' ) => '5',
					),
					'std' => '4',
					'dependency' => array(
						'element' => 'slider',
						'value'   => '0',
					),
				),
				array(
					'param_name' => 'slider',
					'heading'    => esc_html__( 'Display Products as Slider', 'valey' ),
					'type'       => 'dropdown',
					'value' => array(
						esc_html__( 'Yes, Please', 'valey' )    => 1,
						esc_html__( 'No, I needn\'t', 'valey' ) => 0,
					),
					'std' => 0
				),
				array(
					'param_name' => 'navigation',
					'type'       => 'checkbox',
					'group'      => esc_html__( 'Slider Settings', 'valey' ),
					'heading'    => esc_html__( 'Enable Navigation?', 'valey' ),
					'dependency' => array(
						'element' => 'slider',
						'value'   => '1',
					),
				),
				array(
					'param_name' => 'navigation_position',
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Navigation Position', 'valey' ),
					'group'      => esc_html__( 'Slider Settings', 'valey' ),
					'value' => array(
						esc_html__( 'Top', 'valey' )    => 'top',
						esc_html__( 'Middle', 'valey' ) => 'middle',
					),
					'dependency' => array(
						'element'   => 'navigation',
						'not_empty' => true,
					),
				),
				array(
					'param_name' => 'navigation_style',
					'type'       => 'dropdown',
					'group'      => esc_html__( 'Slider Settings', 'valey' ),
					'heading'    => esc_html__( 'Navigation Style', 'valey' ),
					'value' => array(
						esc_html__( 'Text', 'valey' ) => 'text',
						esc_html__( 'Icon', 'valey' ) => 'icon',
					),
					'dependency' => array(
						'element' => 'navigation_position',
						'value'   => 'middle'
					),
				),
				array(
					'param_name'  => 'items',
					'group'       => esc_html__( 'Slider Settings', 'valey' ),
					'heading'     => esc_html__( 'Items', 'valey' ),
					'description' => esc_html__( 'The number of items you want to see on the screen', 'valey' ),
					'type'        => 'textfield',
					'value'       => 4,
					'dependency'  => array(
						'element' => 'slider',
						'value'   => '1',
					),
				),
				array(
					'param_name' => 'autoplay',
					'type'       => 'checkbox',
					'group'      => esc_html__( 'Slider Settings', 'valey' ),
					'heading'    => esc_html__( 'Autoplay', 'valey' ),
					'dependency' => array(
						'element' => 'slider',
						'value'   => '1',
					),
				),
				array(
					'param_name' => 'hoverpause',
					'type'       => 'checkbox',
					'group'      => esc_html__( 'Slider Settings', 'valey' ),
					'heading'    => esc_html__( 'Pause on mouse hover', 'valey' ),
					'dependency' => array(
						'element'   => 'autoplay',
						'not_empty' => true,
					),
				),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'valey' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'valey' ),
					'type' 	      => 'textfield',
				),
				array(
					'param_name' => 'issc',
					'type'       => 'hidden',
					'value'      => true,
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'fx_valey_vc_map_products' );