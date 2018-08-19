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

if(!function_exists('engo_create_type_brand')  ){
  function engo_create_type_brand(){
    $labels = array(
      'name' => __( 'Brand Logos', "engotheme" ),
      'singular_name' => __( 'Brand', "engotheme" ),
      'add_new' => __( 'Add New Brand', "engotheme" ),
      'add_new_item' => __( 'Add New Brand', "engotheme" ),
      'edit_item' => __( 'Edit Brand', "engotheme" ),
      'new_item' => __( 'New Brand', "engotheme" ),
      'view_item' => __( 'View Brand', "engotheme" ),
      'search_items' => __( 'Search Brands', "engotheme" ),
      'not_found' => __( 'No Brands found', "engotheme" ),
      'not_found_in_trash' => __( 'No Brands found in Trash', "engotheme" ),
      'parent_item_colon' => __( 'Parent Brand:', "engotheme" ),
      'menu_name' => __( 'Brands', "engotheme" ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Brand',
        'supports' => array( 'title', 'thumbnail'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'brands', $args );
    
  }

  add_action('init','engo_create_type_brand');


///////
function engo_func_metaboxes_brands_fields(){
     
     /**
       * prefix of meta keys (optional)
       * Use underscore (_) at the beginning to make keys hidden
       * Alt.: You also can make prefix empty to disable it
       */

         // Better has an underscore as last sign
      $prefix = 'brands_';
      $fields =  array(
     
           // COLOR
          array(
            'name' => __( 'Brand Link', 'engotheme' ),
            'id'   => "{$prefix}_brank_link",
            'type' => 'text',
            'default' => '#',
            'description' => __('Enter Link To','engotheme')
          ), 

          
          
        ); 
       return apply_filters( 'engo_brand_metaboxes_fields', $fields );
  }

  /**
   *
   */
  function engotheme_func_brand_register_meta_boxes( $meta_boxes ){

      // 1st meta box
      $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id'         => 'standard',
        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title'      => __( 'Brand Setting', 'engotheme' ),
        // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
        'post_types' => array( 'brands' ),
        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context'    => 'normal',
        // Order of meta box: high (default), low. Optional.
        'priority'   => 'low',
        // Auto save: true, false (default). Optional.
        'autosave'   => true,
        // List of meta fields
        'fields'     =>  engo_func_metaboxes_brands_fields()
      );


      return $meta_boxes;
  }

  /**
   * Register Metabox 
   */

  add_filter( 'rwmb_meta_boxes', 'engotheme_func_brand_register_meta_boxes', 11);


}



/*********************************************************************************************************************
 *  Brands Carousel
 *********************************************************************************************************************/

if( class_exists("WPBakeryVisualComposerAbstract") ){

    Class Engotheme_Vc_Vendor_Brands implements Vc_Vendor_Interface {

         public function load(){ 

                  vc_map( array(
                      "name" => __("ENGO Brands Carousel",'engotheme'),
                      "base" => "engo_brands",
                      'icon' => 'engo-vc-icon',
                      'description'=>'Show Brand Logos, Manufacture Logos From Source: Brands',
                      "class" => "",
                      "category" => __('ENGO Widgets', 'engotheme'),
                      "params" => array(
                        array(
                        "type" => "textfield",
                        "heading" => __("Title", 'engotheme'),
                        "param_name" => "title",
                        "value" => '',
                      ),

                      array(
                        "type" => "textarea",
                        "heading" => __('Descriptions', 'engotheme'),
                        "param_name" => "descript",
                        "value" => ''
                      ),

                      array(
                  'type' => 'attach_images',
                  'heading' => __( 'Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library.', 'js_composer' )
                ),
                array(
                  'type' => 'dropdown',
                  'heading' => __( 'Columns count', 'engotheme' ),
                  'param_name' => 'columns_count',
                  'value' => array(
                    __( '2 Items', 'engotheme' ) => 2,
                    __( '3 Items', 'engotheme' ) => 3,
                    __( '4 Items', 'engotheme' ) => 4,
                    __( '5 Items', 'engotheme' ) => 5,
                    __( '6 Items', 'engotheme' ) => 6,
                  ),
                  'std' => 6
                ),
                array(
                  "type" => "textfield",
                  "heading" => __("Extra class name", 'engotheme'),
                  "param_name" => "el_class",
                  "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'engotheme')
                )
                )
            ));   

         }
    }
    






    class WPBakeryShortCode_Engo_brands   extends WPBakeryShortCode {}

      function engotheme_fnc_init_vc_brands_vendors(){
         $vendor = new Engotheme_Vc_Vendor_Brands();
         add_action( 'vc_after_set_mode', array(
            $vendor,
           'load'
          ), 99 ); 
      }
    
    engotheme_fnc_init_vc_brands_vendors();

}    