<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author      Team <engotheme@gmail.com >
  * @copyright  Copyright (C) 2015  engotheme.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.engotheme.com
  * @support  http://www.engotheme.com/support/
  */

if(!function_exists('engo_create_type_video')   ){
  function engo_create_type_video(){
    $labels = array(
      'name' => __( 'Video', "engotheme" ),
      'singular_name' => __( 'Video', "engotheme" ),
      'add_new' => __( 'Add New Video', "engotheme" ),
      'add_new_item' => __( 'Add New Video', "engotheme" ),
      'edit_item' => __( 'Edit Video', "engotheme" ),
      'new_item' => __( 'New Video', "engotheme" ),
      'view_item' => __( 'View Video', "engotheme" ),
      'search_items' => __( 'Search Videos', "engotheme" ),
      'not_found' => __( 'No Videos found', "engotheme" ),
      'not_found_in_trash' => __( 'No Videos found in Trash', "engotheme" ),
      'parent_item_colon' => __( 'Parent Video:', "engotheme" ),
      'menu_name' => __( 'Videos', "engotheme" ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Video',
        'supports' => array( 'title', 'editor', 'thumbnail','comments', 'excerpt' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'video', $args );

    $labels = array(
        'name'              => __( 'Categories Video', "engotheme" ),
        'singular_name'     => __( 'Category', "engotheme" ),
        'search_items'      => __( 'Search Category',"engotheme" ),
        'all_items'         => __( 'All Categories',"engotheme" ),
        'parent_item'       => __( 'Parent Category',"engotheme" ),
        'parent_item_colon' => __( 'Parent Category:',"engotheme" ),
        'edit_item'         => __( 'Edit Category',"engotheme" ),
        'update_item'       => __( 'Update Category',"engotheme" ),
        'add_new_item'      => __( 'Add New Category',"engotheme" ),
        'new_item_name'     => __( 'New Category Name',"engotheme" ),
        'menu_name'         => __( 'Categories Video',"engotheme" ),
      );
      // Now register the taxonomy
      register_taxonomy('category_video',array('video'),
          array(
              'hierarchical'      => true,
              'labels'            => $labels,
              'show_ui'           => true,
              'show_admin_column' => true,
              'query_var'         => true,
              'rewrite'           => array( 'slug' => 'video'
          ),
      ));
  }
  add_action( 'init', 'engo_create_type_video' );
}


