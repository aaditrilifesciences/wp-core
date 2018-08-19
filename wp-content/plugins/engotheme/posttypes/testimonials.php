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

if(!function_exists('engo_create_type_testimonial')   ){
    function engo_create_type_testimonial(){
      $labels = array(
        'name' => __( 'Testimonial', "engotheme" ),
        'singular_name' => __( 'Testimonial', "engotheme" ),
        'add_new' => __( 'Add New Testimonial', "engotheme" ),
        'add_new_item' => __( 'Add New Testimonial', "engotheme" ),
        'edit_item' => __( 'Edit Testimonial', "engotheme" ),
        'new_item' => __( 'New Testimonial', "engotheme" ),
        'view_item' => __( 'View Testimonial', "engotheme" ),
        'search_items' => __( 'Search Testimonials', "engotheme" ),
        'not_found' => __( 'No Testimonials found', "engotheme" ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash', "engotheme" ),
        'parent_item_colon' => __( 'Parent Testimonial:', "engotheme" ),
        'menu_name' => __( 'Testimonials', "engotheme" ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => true,
          'description' => 'List Testimonial',
          'supports' => array( 'title', 'editor', 'thumbnail','excerpt'),
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
      register_post_type( 'testimonial', $args );
    }

    add_action( 'init','engo_create_type_testimonial' );
}



function engo_func_metaboxes_testimonial_fields(){
     /**
       * prefix of meta keys (optional)
       * Use underscore (_) at the beginning to make keys hidden
       * Alt.: You also can make prefix empty to disable it
       */

         // Better has an underscore as last sign
      $prefix = 'testimonials_';
      $fields =  array(
          // COLOR
          array(
            'name' => __( 'Job', 'engotheme' ),
            'id'   => "{$prefix}job",
            'type' => 'text',
            'description' => __('Enter Job example CEO, CTO','engotheme')
          ), 
           
        
          array(
            'name' => __( 'Link', 'engotheme' ),
            'id'   => "{$prefix}link",
            'type' => 'text',
            'description' => __('Enter Link to this personal','engotheme')
          ), 

 
          
        ); 
       return apply_filters( 'engo_team_metaboxes_fields', $fields );
  }

  /**
   *
   */
  function engotheme_func_testimonials_register_meta_boxes( $meta_boxes ){

      // 1st meta box
      $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id'         => 'standard',
        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title'      => __( 'Testimonials Info', 'engotheme' ),
        // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
        'post_types' => array( 'testimonial' ),
        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context'    => 'normal',
        // Order of meta box: high (default), low. Optional.
        'priority'   => 'low',
        // Auto save: true, false (default). Optional.
        'autosave'   => true,
        // List of meta fields
        'fields'     =>  engo_func_metaboxes_testimonial_fields()
      );

      return $meta_boxes;
  }

  /**
   * Register Metabox 
   */

  add_filter( 'rwmb_meta_boxes', 'engotheme_func_testimonials_register_meta_boxes', 12);


if( class_exists("WPBakeryVisualComposerAbstract") ){

    Class Engotheme_Vc_Vendor_Testimonials implements Vc_Vendor_Interface {

        public function load(){ 
            /**********************************************************************************************************************
             * Testimonials
             **********************************************************************************************************************/
            vc_map( array(
                "name" => __("ENGO Testimonials",'engotheme'),
                "base" => "engo_testimonials",
                'icon' => 'engo-vc-icon',
                'description'=> __('Play Testimonials In Carousel', 'engotheme'),
                "class" => "",
                "category" => __('ENGO Widgets', 'engotheme'),
                "params" => array(
                  array(
                  "type" => "textfield",
                  "heading" => __("Title", 'engotheme'),
                  "param_name" => "title",
                  "admin_label" => true,
                  "value" => '',
                    "admin_label" => true
                ),
                      array(
                  "type" => "textfield",
                  "heading" => __("Number to show", 'engotheme'),
                  "param_name" => "number",
                  "value" => '4',
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Limit item", 'engotheme'),
                    "param_name" => "limit",
                    "value" => '5',
                ),
                array(
                  "type" => "dropdown",
                  "heading" => __("Skin", 'engotheme'),
                  "param_name" => "skin",
                  "value" => array('Version Style 1'=>'v1', 'Version Style 2'=>'v2'),
                  "admin_label" => true,
                  "description" => __("Select Skin layout.", 'engotheme')
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

    class WPBakeryShortCode_Engo_testimonials   extends WPBakeryShortCode {}
    
    function engotheme_fnc_init_vc_testimonials_vendors(){
       $vendor = new Engotheme_Vc_Vendor_Testimonials();
       add_action( 'vc_after_set_mode', array(
          $vendor,
         'load'
        ), 99 ); 
    }
    
    engotheme_fnc_init_vc_testimonials_vendors();
}      
