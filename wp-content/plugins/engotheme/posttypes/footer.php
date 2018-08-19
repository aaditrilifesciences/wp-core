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

if(!function_exists('engo_create_type_footer')   ){
function engo_create_type_footer(){
  $labels = array(
    'name' => __( 'Footers', "engotheme" ),
    'singular_name' => __( 'Footer', "engotheme" ),
    'add_new' => __( 'Add Profile Footer', "engotheme" ),
    'add_new_item' => __( 'Add Profile Footer', "engotheme" ),
    'edit_item' => __( 'Edit Footer', "engotheme" ),
    'new_item' => __( 'New Profile', "engotheme" ),
    'view_item' => __( 'View Footer Profile', "engotheme" ),
    'search_items' => __( 'Search Footer Profiles', "engotheme" ),
    'not_found' => __( 'No Footer Profiles found', "engotheme" ),
    'not_found_in_trash' => __( 'No Footer Profiles found in Trash', "engotheme" ),
    'parent_item_colon' => __( 'Parent Footer:', "engotheme" ),
    'menu_name' => __( 'Footers', "engotheme" ),
  );

  $args = array(
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'List Footer',
      'supports' => array( 'title', 'editor' ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_nav_menus' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => false,
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false
  );
  register_post_type( 'footer', $args );

  if($options = get_option('wpb_js_content_types')){
    $check = true;
    foreach ($options as $key => $value) {
      if($value=='footer') $check=false;
    }
    if($check)
      $options[] = 'footer';
    update_option( 'wpb_js_content_types',$options );
  }else{
    $options = array('page','footer');
  }

}

add_action('init','engo_create_type_footer');

}