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
if ( class_exists( 'RWMB_Field' ) ) {

  class RWMB_skills_Field extends RWMB_Field
  {
      /**
       * Get field HTML
       *
       * @param mixed $meta
       * @param array $field
       *
       * @return string
       */
      static public function html( $meta, $field )
      {
          return sprintf(
            '<input type="tel" name="%s" id="%s" value="%s" pattern="\d{3}-\d{4}">',
            $field['field_name'],
            $field['id'],
            $meta
          );
      }
  }
}

if(!function_exists('engo_create_type_team')   ){
    function engo_create_type_team(){
      $labels = array(
        'name' => __( 'Team', "engotheme" ),
        'singular_name' => __( 'Team', "engotheme" ),
        'add_new' => __( 'Add New Team', "engotheme" ),
        'add_new_item' => __( 'Add New Team', "engotheme" ),
        'edit_item' => __( 'Edit Team', "engotheme" ),
        'new_item' => __( 'New Team', "engotheme" ),
        'view_item' => __( 'View Team', "engotheme" ),
        'search_items' => __( 'Search Teams', "engotheme" ),
        'not_found' => __( 'No Teams found', "engotheme" ),
        'not_found_in_trash' => __( 'No Teams found in Trash', "engotheme" ),
        'parent_item_colon' => __( 'Parent Team:', "engotheme" ),
        'menu_name' => __( 'Teams', "engotheme" ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => false,
          'description' => 'List Team',
          'supports' => array( 'title', 'editor', 'thumbnail','excerpt'),
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'show_in_nav_menus' => false,
          'publicly_queryable' => true,
          'exclude_from_search' => true,
          'has_archive' => true,
          'query_var' => true,
          'can_export' => true,
          'rewrite' => false,
          'capability_type' => 'post'
      );
      register_post_type( 'team', $args );

      $labels = array(
        'name'              => __( 'Teacher Categories', "engotheme" ),
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
      register_taxonomy('category_teachers',array('team'),
          array(
              'hierarchical'      => true,
              'labels'            => $labels,
              'show_ui'           => true,
              'show_admin_column' => true,
              'query_var'         => true,
              'show_in_nav_menus' =>true,
              'rewrite'           => array( 'slug' => 'team-category'
          ),
      ));



}

add_action( 'init','engo_create_type_team' );




function engo_func_metaboxes_team_fields(){
     /**
       * prefix of meta keys (optional)
       * Use underscore (_) at the beginning to make keys hidden
       * Alt.: You also can make prefix empty to disable it
       */

         // Better has an underscore as last sign
      $prefix = 'team_';
      $fields =  array(
          // COLOR
          array(
            'name' => __( 'Job', 'engotheme' ),
            'id'   => "{$prefix}job",
            'type' => 'text',
            'description' => __('Enter Job example CEO, CTO','engotheme')
          ), 
           
           // THICKBOX IMAGE UPLOAD (WP 3.3+)
          // FILE ADVANCED (WP 3.5+)
          array(
            'name'             => __( 'Phone Number', 'engotheme' ),
            'id'               => "{$prefix}phone_number",
            'type'             => 'text',
            'max_file_uploads' => 10,
            'mime_type'        => 'image', // Leave blank for all file types
          ),

           // COLOR
          array(
            'name' => __( 'Google Plus Link', 'engotheme' ),
            'id'   => "{$prefix}google",
            'type' => 'text',
            'description' => __('Enter google','engotheme')
          ), 

          array(
            'name' => __( 'Facebook Link', 'engotheme' ),
            'id'   => "{$prefix}facebook",
            'type' => 'text',
            'description' => __('Enter facebook','engotheme')
          ), 

          array(
            'name' => __( 'Twitter', 'engotheme' ),
            'id'   => "{$prefix}twitter",
            'type' => 'text',
            'description' => __('Enter Twitter','engotheme')
          ), 

          array(
            'name' => __( 'Printest', 'engotheme' ),
            'id'   => "{$prefix}pinterest",
            'type' => 'text',
            'description' => __('Enter pinterest','engotheme')
          ), 
          
        ); 
       return apply_filters( 'engo_team_metaboxes_fields', $fields );
  }

  /**
   *
   */
  function engotheme_func_team_register_meta_boxes( $meta_boxes ){

      // 1st meta box
      $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id'         => 'standard',
        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title'      => __( 'Team Setting', 'engotheme' ),
        // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
        'post_types' => array( 'team' ),
        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context'    => 'normal',
        // Order of meta box: high (default), low. Optional.
        'priority'   => 'low',
        // Auto save: true, false (default). Optional.
        'autosave'   => true,
        // List of meta fields
        'fields'     =>  engo_func_metaboxes_team_fields()
      );

      return $meta_boxes;
  }

  /**
   * Register Metabox 
   */

  add_filter( 'rwmb_meta_boxes', 'engotheme_func_team_register_meta_boxes', 9);

  if( class_exists("WPBakeryVisualComposerAbstract") ){
      /******************************
       * Our Team
       ******************************/
      vc_map( array(
          "name" => __("Team Grid (Team Source)",'engotheme'),
          "base" => "engo_posttype_team",
          "class" => "",
          "description" => 'Get data from post type Team',
          "category" => __('ENGO Widgets', 'engotheme'),
          "params" => array(
            array(
            "type" => "textfield",
            "heading" => __("Title", 'engotheme'),
            "param_name" => "title",
            "value" => '',
              "admin_label" => true
          ),
          array(
            "type" => "textfield",
            "heading" => __("Column", 'engotheme'),
            "param_name" => "column",
            "value" => '4',
            'description' =>  ''
          ),
         
          )
      ));
      class WPBakeryShortCode_Engo_posttype_team   extends WPBakeryShortCode {}
  }

  function engo_fnc_team_query(){

      $args = array(
            'post_type' => 'team'           
        );
       
      return new WP_Query( $args );  
  }    
}


