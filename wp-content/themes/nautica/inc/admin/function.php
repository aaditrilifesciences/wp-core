<?php 
/**
 *
 */
function nautica_setup_admin_setting(){

	global $pagenow; 
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
		/**
		 *
		 */
		$pts = array( 'brands', 'testimonials', 'portfolio', 'faq', 'footer', 'megamenu','woobrand');

		$options = array();	

		foreach( $pts as $key ){
			$options['enable_'.$key] = 'on'; 
		}
	
		update_option( 'engo_themer_posttype', $options );
	}

	wp_enqueue_style( 'custom-admin-css', get_template_directory_uri() . '/css/custom-admin.css', array(), '3.0.3' );	
}
add_action( 'init', 'nautica_setup_admin_setting'  );