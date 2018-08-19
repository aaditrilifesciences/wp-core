<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author      Team <engotheme@gmail.com >
  * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.engotheme.com
  * @support  http://www.engotheme.com/support/
  */
if(!function_exists('engo_create_type_portfolio')  ){
    function engo_create_type_portfolio(){
      $labels = array(
          'name'               => __( 'Portfolios', "engotheme" ),
          'singular_name'      => __( 'Portfolio', "engotheme" ),
          'add_new'            => __( 'Add New Portfolio', "engotheme" ),
          'add_new_item'       => __( 'Add New Portfolio', "engotheme" ),
          'edit_item'          => __( 'Edit Portfolio', "engotheme" ),
          'new_item'           => __( 'New Portfolio', "engotheme" ),
          'view_item'          => __( 'View Portfolio', "engotheme" ),
          'search_items'       => __( 'Search Portfolios', "engotheme" ),
          'not_found'          => __( 'No Portfolios found', "engotheme" ),
          'not_found_in_trash' => __( 'No Portfolios found in Trash', "engotheme" ),
          'parent_item_colon'  => __( 'Parent Portfolio:', "engotheme" ),
          'menu_name'          => __( 'Portfolios', "engotheme" ),
      );

      $args = array(
          'labels'              => $labels,
          'hierarchical'        => true,
          'description'         => 'List Portfolio',
          'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt'  ), //page-attributes, post-formats
          'taxonomies'          => array( 'portfolio_category','gallery_category','post_tag' ),
          'post-formats'      => array( 'aside', 'image', 'quote' ) ,
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'menu_position'       => 5,
          'show_in_nav_menus'   => false,
          'publicly_queryable'  => true,
          'exclude_from_search' => false,
          'has_archive'         => true,
          'query_var'           => true,
          'can_export'          => true,
          'rewrite'             => true,
          'capability_type'     => 'post'
      );
      register_post_type( 'portfolio', $args );

      //Add Port folio Skill
      // Add new taxonomy, make it hierarchical like categories
      //first do the translations part for GUI
      $labels = array(
        'name'              => __( 'Categories', "engotheme" ),
        'singular_name'     => __( 'Category', "engotheme" ),
        'search_items'      => __( 'Search Category',"engotheme" ),
        'all_items'         => __( 'All Categories',"engotheme" ),
        'parent_item'       => __( 'Parent Category',"engotheme" ),
        'parent_item_colon' => __( 'Parent Category:',"engotheme" ),
        'edit_item'         => __( 'Edit Category',"engotheme" ),
        'update_item'       => __( 'Update Category',"engotheme" ),
        'add_new_item'      => __( 'Add New Category',"engotheme" ),
        'new_item_name'     => __( 'New Category Name',"engotheme" ),
        'menu_name'         => __( 'Categories',"engotheme" ),
      );
      // Now register the taxonomy
      register_taxonomy('category_portfolio',array('portfolio'),
          array(
              'hierarchical'      => true,
              'labels'            => $labels,
              'show_ui'           => true,
              'show_admin_column' => true,
              'query_var'         => true,
              'show_in_nav_menus' =>false,
              'rewrite'           => array( 'slug' => 'category-portfolio'
          ),
      ));

       // add_post_type_support( 'portfolio', 'post-formats', array( 'aside', 'image', 'quote' ) );

  }
  add_action( 'init','engo_create_type_portfolio' );
}

/**
 * Register Metabox 
 */



function engo_func_metaboxes_fields(){
   /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */

       // Better has an underscore as last sign
    $prefix = 'portfolio_';
    $fields =  array(
        array(
          'name'        => __( 'Select', 'engotheme' ),
          'id'          => "{$prefix}layout",
          'type'        => 'select_advanced',
          // Array of 'value' => 'Label' pairs for select box
          'options'     => array(
            'default' => __( 'Default'    , 'engotheme' ),
            'fullscreen' => __( 'FullScreen' , 'engotheme' ),
            'video' => __( 'Video'      , 'engotheme' ),
            'gallery' => __( 'Gallery'      , 'engotheme' ),
            'slideshow' => __( 'Slideshow'      , 'engotheme' ),
          ),
          // Select multiple values, optional. Default is false.
          'multiple'    => false,
           'std'         => 'default', // Default value, optional
          'placeholder' => __( 'Select an Item', 'engotheme' ),
        ),


        // COLOR
        array(
          'name' => __( 'Video Link', 'engotheme' ),
          'id'   => "{$prefix}video_link",
          'type' => 'text',
          'description' => __('Support Show Video From Youtube and Vimeo','engotheme')
        ), 
         
         // THICKBOX IMAGE UPLOAD (WP 3.3+)
        // FILE ADVANCED (WP 3.5+)
        array(
          'name'             => __( 'Image Galleries', 'engotheme' ),
          'id'               => "{$prefix}file_advanced",
          'type'             => 'file_advanced',
          'max_file_uploads' => 10,
          'mime_type'        => 'image', // Leave blank for all file types
        ),

         // COLOR
        array(
          'name' => __( 'Author FullName', 'engotheme' ),
          'id'   => "{$prefix}author",
          'type' => 'text',
          'description' => __('Enter Full Name For Author','engotheme')
        ), 

        array(
          'name' => __( 'Showcase Link', 'engotheme' ),
          'id'   => "{$prefix}link",
          'type' => 'text',
          'description' => __('Enter the link to showcase site','engotheme')
        ), 

        array(
          'name' => __( 'Client', 'engotheme' ),
          'id'   => "{$prefix}client",
          'type' => 'text',
          'description' => __('Enter Full Name For Author','engotheme')
        ), 

        array(
          'name' => __( 'Date Created', 'engotheme' ),
          'id'   => "{$prefix}date",
          'type' => 'date',
          'description' => __('Enter date released the project','engotheme')
        ), 

      ); 


     return apply_filters( 'engo_portfolio_metaboxes_fields', $fields );


}
function engotheme_func_portfolios_register_meta_boxes( $meta_boxes ){




 
    // 1st meta box
    $meta_boxes[] = array(
      // Meta box id, UNIQUE per meta box. Optional since 4.1.5
      'id'         => 'standard',
      // Meta box title - Will appear at the drag and drop handle bar. Required.
      'title'      => __( 'Portfolio Setting', 'engotheme' ),
      // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
      'post_types' => array( 'portfolio', 'post' ),
      // Where the meta box appear: normal (default), advanced, side. Optional.
      'context'    => 'normal',
      // Order of meta box: high (default), low. Optional.
      'priority'   => 'high',
      // Auto save: true, false (default). Optional.
      'autosave'   => true,
      // List of meta fields
      'fields'     =>  engo_func_metaboxes_fields()
    );

    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'engotheme_func_portfolios_register_meta_boxes', 16 );

if( !function_exists("engo_fnc_portfolio_information") ){

    function engo_fnc_portfolio_information(){
         engo_theme_get_template_part( 'portfolio/portfolio-information' )  ;
    }
}


if( class_exists("WPBakeryVisualComposerAbstract") ){

    Class Engotheme_Vc_Vendor_Portfolio implements Vc_Vendor_Interface {

        public function load(){ 
            
              vc_map( array(
              "name" => __("ENGO Portfolio",'engotheme'),
              "base" => "engo_portfolio",
              'icon' => 'icon-wpb-application-icon-large',
              'description'=>'Portfolio',
              "class" => "",
              "category" => __('ENGO Widgets', 'engotheme'),
              "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => __("Title", 'edubase'),
                        "param_name" => "title",
                        "value" => '',
                        "admin_label" => true
                      ),
                         array(
                                "type" => "checkbox",
                                "heading" => __("Item No Padding", 'edubase'),
                                "param_name" => "nopadding",
                                "value" => array(
                                    'Yes, It is Ok' => true
                                ),
                                'std' => true
                      ),  
                         
                     
                      array(
                        "type" => "textarea",
                        'heading' => __( 'Description', 'edubase' ),
                        "param_name" => "descript",
                        "value" => ''
                        ),

                      array(
                        'type' => 'dropdown',
                        'heading' => __( 'Display Masonry', 'edubase' ),
                        'param_name' => 'masonry',
                        'value' => array(
                          __( 'No', 'edubase' ) => '0',
                          __( 'Yes', 'edubase' ) => '1',
                        )
                      ),

                      array(
                        "type" => "textfield",
                        "heading" => __("Number of portfolio to show", 'edubase'),
                        "param_name" => "number",
                        "value" => '6'
                      ),

                      array(
                        'type' => 'dropdown',
                        'heading' => __( 'Columns count', 'edubase' ),
                        'param_name' => 'columns_count',
                        'value' => array( 6, 4, 3, 2, 1 ),
                        'std' => 3,
                        'admin_label' => true,
                        'description' => __( 'Select columns count.', 'edubase' )
                      ),
                      array(
                        'type' => 'dropdown',
                        'heading' => __( 'Enable Pagination', 'edubase' ),
                        'param_name' => 'pagination',
                        'value' => array( 'No'=>'0', 'Yes'=>'1'),
                        'std' => 'style-1',
                        'admin_label' => true,
                        'description' => __( 'Select style display.', 'edubase' )
                      ),
                      array(
                        "type" => "textfield",
                        "heading" => __("Extra class name", 'edubase'),
                        "param_name" => "el_class",
                        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'edubase')
                      )
              )
          ));
        }  
    }

    class WPBakeryShortCode_Engo_portfolio   extends WPBakeryShortCode {}
    
    function engotheme_fnc_init_vc_portfolio_vendors(){
       $vendor = new Engotheme_Vc_Vendor_Portfolio();
       add_action( 'vc_after_set_mode', array(
          $vendor,
         'load'
        ), 99 ); 
    }

    engotheme_fnc_init_vc_portfolio_vendors();
   // add_action( 'init', 'engotheme_fnc_init_vc_portfolio_vendors'  );

    /**
     * Get Query Object To Fetch Data In Loop
     */
    function engotheme_fnc_portfolio_query( $args ){
        
        $ds = array(
          'post_type'   => 'portfolio',
          'posts_per_page'  =>  12
        );

        $args = array_merge( $ds , $args );
        $loop = new WP_Query($args);

        return $loop;
    }

    /**
     *
     */
    function engotheme_fnc_profolio_terms(){
       return get_terms( 'category_portfolio',array('orderby'=>'id') );
    }

    /**
     *
     */
    function engotheme_fnc_portfolio_terms_related( $postId ){
        
        $output = array();

        $item_cats = get_the_terms( $postId, 'category_portfolio' );

 
        foreach((array)$item_cats as $item_cat){
            if( !empty($item_cats) && !is_wp_error($item_cats) ){
                $output[] = $item_cat->slug;
            }
        }
        
        return $output;
    }

    /**
     *
     */
    if(!function_exists('engo_fnc_related_post')){

          function engo_fnc_related_post(  ){
              $relate_count = 4;
              $terms = get_the_terms( get_the_ID(),  'category_portfolio' );
              $termids =array();
             
              if(!empty($terms) && !is_wp_error($terms)){
                  foreach($terms as $term){
                      if( is_object($term) ){
                         $termids[] = $term->term_id;
                      }
                  }
              }

              $args = array(
                  'post_type' => 'portfolio',
                  'posts_per_page' => 'category_portfolio',
                  'post__not_in' => array( get_the_ID() ),
                  'tax_query' => array(
                      'relation' => 'AND',
                      array(
                          'taxonomy' => 'category_portfolio',
                          'field' => 'id',
                          'terms' => $termids,
                          'operator' => 'IN'
                      )
                  )
              );
             

            $relates = new WP_Query( $args );
            
            require_once( engo_theme_get_template_part( 'portfolio/portfolio-related', false, false ) );

          }
          
          add_action( 'engo_layout_portfolio_single_template_loop_after', 'engo_fnc_related_post' );
    }

    /**
     *
     */
    function engo_fnc_portfolio_nav(){
        echo '<div class="engo-portfolio-navigator">';
   
            previous_post_link('<p class="btn btn-inverse btn-success radius-6x border-2 text-white">%link</p>', 'Pre.', FALSE); 
            next_post_link('<p class="btn btn-inverse btn-success radius-6x border-2 text-white">%link</p>', 'Next', FALSE); 
 
        echo '</div>';
    }

    add_action( 'engo_layout_portfolio_single_template_loop_before', 'engo_fnc_portfolio_nav' );

}