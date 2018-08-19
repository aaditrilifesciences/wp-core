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
if(!function_exists('engo_create_type_gallery')   ){
    function engo_create_type_gallery(){
      $labels = array(
          'name'               => __( 'Gallerys', "engotheme" ),
          'singular_name'      => __( 'Gallery', "engotheme" ),
          'add_new'            => __( 'Add New Gallery', "engotheme" ),
          'add_new_item'       => __( 'Add New Gallery', "engotheme" ),
          'edit_item'          => __( 'Edit Gallery', "engotheme" ),
          'new_item'           => __( 'New Gallery', "engotheme" ),
          'view_item'          => __( 'View Gallery', "engotheme" ),
          'search_items'       => __( 'Search Gallerys', "engotheme" ),
          'not_found'          => __( 'No Gallerys found', "engotheme" ),
          'not_found_in_trash' => __( 'No Gallerys found in Trash', "engotheme" ),
          'parent_item_colon'  => __( 'Parent Gallery:', "engotheme" ),
          'menu_name'          => __( 'Gallerys', "engotheme" ),
      );

      $args = array(
          'labels'              => $labels,
          'hierarchical'        => false,
          'description'         => 'List Gallery',
          'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt','custom-fields' ), //page-attributes, post-formats
          'taxonomies'          => array( 'gallery_category','skills','post_tag' ),
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'menu_position'       => 5,
          'menu_icon'           => '',
          'show_in_nav_menus'   => false,
          'publicly_queryable'  => true,
          'exclude_from_search' => false,
          'has_archive'         => true,
          'query_var'           => true,
          'can_export'          => true,
          'rewrite'             => array('slug'=>'gallery'),
          'capability_type'     => 'post',
      );
      register_post_type( 'gallery', $args );

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
      register_taxonomy('gallery_category',array('gallery'),
          array(
              'hierarchical'      => true,
              'labels'            => $labels,
              'show_ui'           => true,
              'show_admin_column' => true,
              'query_var'         => true,
              'show_in_nav_menus' => false,
              'rewrite'           => array( 'slug' => 'gallery-category'
          ),
      ));



      

  }
  add_action( 'init','engo_create_type_gallery' );
}