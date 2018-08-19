<?php 
/*
  Plugin Name: Engo Themes
  Plugin URI: http://www.engotheme.com/
  Description: Implement rick functions for themes base on Engotheme wordpress framework and load widgets for theme used, this is required.
  Version: 1.0
  Author: EngoTheme
  Author URI: http://www.engotheme.com
  License: GPLv2 or later
 */

 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author     EngoTheme  Team <engotheme@gmail.com, support@engotheme.com>
  * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.engotheme.com
  * @support  http://www.engotheme.com/support/
  */
  define( 'ENGO_THEME_PLUGIN_THEMER_URL', plugin_dir_url( __FILE__ ) );
  define( 'ENGO_THEME_PLUGIN_THEMER_DIR', plugin_dir_path( __FILE__ )  );
  define( 'ENGO_THEME_PLUGIN_THEMER_TEMPLATE_DIR', ENGO_THEME_PLUGIN_THEMER_DIR.'metabox_templates/' );


  /**
   * Loading Widgets
   */
  function engo_theme_widgets_init(){
    
      if( !defined('ENGO_THEME_DIR') ){
        return ;
      }  


      require( ENGO_THEME_PLUGIN_THEMER_DIR.'function.templates.php' );
      require( ENGO_THEME_PLUGIN_THEMER_DIR.'setting.class.php' );
      require( ENGO_THEME_PLUGIN_THEMER_DIR.'widget.class.php' );

      
      define( "ENGO_THEME_PLUGIN_THEMER", true );
      define( 'ENGO_THEME_PLUGIN_THEMER_WIDGET_TEMPLATES', get_template_directory().'/'  );

      $widgets = apply_filters( 'engo_theme_load_widgets', array( 'contact-info', 'twitter','posts','featured_post','top_rate','sliders','recent_comment','recent_post','tabs','flickr', 'video', 'socials', 'menu_vertical', 'socials_siderbar') );


      if( !empty($widgets) ){
          foreach( $widgets as $opt => $key ){

              $file = str_replace( 'enable_', '', $key );
              $filepath = ENGO_THEME_PLUGIN_THEMER_DIR.'widgets/'.$file.'.php';
              if( file_exists($filepath) ){ 
                  require_once( $filepath );
              }
          }  
      }
  }
  add_action( 'widgets_init', 'engo_theme_widgets_init' );

    
  /**
   * Loading Post Types
   */
  function engo_theme_load_posttypes_setup(){
      
      if( !defined('ENGO_THEME_DIR') ){
        return ;
      }  

      $opts = apply_filters( 'engo_theme_load_posttypes', get_option( 'engo_theme_posttype' ) );
      if( !empty($opts) ){

     

          foreach( $opts as $opt => $key ){

              $file = str_replace( 'enable_', '', $opt );
              $filepath = ENGO_THEME_PLUGIN_THEMER_DIR.'posttypes/'.$file.'.php';
              if( file_exists($filepath) ){
                  require_once( $filepath );
              }
          }  
      }
  }   
  add_action( 'init', 'engo_theme_load_posttypes_setup', 1 );
  
  ?>