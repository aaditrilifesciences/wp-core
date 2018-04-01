<?php
/**
 * Register the required plugins for this theme.
 *
 * @since   1.0.0
 * @package Valey
 */
// Include the TGM_Plugin_Activation class.
require_once FX_VALEY_PATH . '/core/libraries/vendors/tgmpa/class-tgmpa.php';

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function fx_valey_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'FX Addons',
			'slug'     => 'FXAddons',
			'source'   => 'http://www.516x.co/plugins/FXAddons.zip',
			'required' => true,
		),
		array(
			'name'     => 'Visual Composer',
			'slug'     => 'js_composer',
			'source'   => 'http://www.516x.co/plugins/js_composer.zip',
			'required' => true,
		),
		array(
			'name'     => 'Valey Sample Data',
			'slug'     => 'valey-sample',
			'source'   => 'http://www.516x.co/plugins/valey-sample.zip',
			'required' => true,
		),
		array(
			'name'   => 'Envato WordPress Toolkit',
			'slug'   => 'envato-wordpress-toolkit',
			'source' => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip',
		),
		array(
			'name'   => 'Revolution Slider',
			'slug'   => 'revslider',
			'source' => 'http://www.516x.co/plugins/revslider.zip',
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => 'YITH WooCommerce Wishlist',
			'slug'      => 'yith-woocommerce-wishlist',
			'required'  => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => '516x-install-plugins',
		'parent_slug'  => 'fosx',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'fx_valey_register_required_plugins' );