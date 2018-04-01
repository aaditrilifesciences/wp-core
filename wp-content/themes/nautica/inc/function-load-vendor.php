<?php 

/**
 * Check and load to support visual composer
 */
if(  in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && class_exists('WPBakeryVisualComposerAbstract') ){
	nautica_engo_includes(  get_template_directory() . '/inc/vendors/visualcomposer/*.php' );
}

/**
 * Check to support woocommerce
 */
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	add_theme_support( 'woocommerce');
	nautica_engo_includes(  get_template_directory() . '/inc/vendors/woocommerce/*.php' );
}


/** Check to support mailchimp **/
if( in_array( 'mailchimp-for-wp/mailchimp-for-wp.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	nautica_engo_includes(  get_template_directory() . '/inc/vendors/mailchimp/*.php' );
}