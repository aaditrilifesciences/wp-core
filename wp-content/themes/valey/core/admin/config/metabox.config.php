<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

if ( isset( $_GET['post'] ) && $_GET['post'] == get_option( 'page_for_posts' ) ) return;

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------
$options[] = array(
	'id'        => '_custom_page_options',
	'title'     => 'Page Options',
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'  => 's1',
			'title' => 'Layout Settings',
			'fields' => array(
				array(
					'id'      => 'layout',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Page Layout', 'valey' ),
					'options' => array(
						'left-sidebar'  => FX_VALEY_URL . '/assets/images/icons/left-sidebar.png',
						'no-sidebar'    => FX_VALEY_URL . '/assets/images/icons/no-sidebar.png',
						'right-sidebar' => FX_VALEY_URL . '/assets/images/icons/right-sidebar.png',
					),
					'default' => 'no-sidebar',
					'radio'   => true
				),
				array(
					'id'      => 'pagehead',
					'type'    => 'switcher',
					'title'   => esc_html__( 'Enable page title', 'valey' ),
					'default' => true
				),
				array(
					'id'         => 'subtitle',
					'type'       => 'switcher',
					'title'      => esc_html__( 'Enable sub-title', 'valey' ),
					'default'    => true,
					'dependency' => array( 'pagehead', '==', 'true' ),
				),
				array(
					'id'         => 'title',
					'type'       => 'text',
					'title'   => esc_html__( 'Sub Title', 'valey' ),
					'attributes' => array(
						'placeholder' => esc_html__( 'Do Stuff', 'valey' )
					),
					'dependency' => array( 'pagehead|subtitle', '==|==', 'true|true' ),
				),
			),
		),
	),
);

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------

// -----------------------------------------
// Product Metabox Options                    -
// -----------------------------------------
$options[]    = array(
	'id'        => '_custom_wc_options',
	'title'     => esc_html__( 'Masonry\'s Product Size', 'valey' ),
	'post_type' => 'product',
	'context'   => 'side',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'   => 'psize',
			'fields' => array(
				array(
					'id'      => 'product_size',
					'type'    => 'select',
					'info'    => sprintf( esc_html__( 'Change list product style <a target="_blank" href="%1$s">here</a> (WooCommerce section).', 'valey' ), esc_url( admin_url( 'admin.php?page=516x-theme-options' ) ) ),
					'options' => array(
						'square'    => esc_html__( 'Square', 'valey' ),
						'rectangle' => esc_html__( 'Rectangle', 'valey' )
					),
					'default' => 'square',
				),
			),
		),
	),
);
CSFramework_Metabox::instance( $options );
