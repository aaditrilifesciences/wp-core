<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$type = 'add_submenu';
$settings = array(
	'menu_title'  => esc_html__( 'Theme Options', 'valey' ),
	'menu_parent' => 'fosx',
	'menu_icon' => 'dashicons-admin-appearance',
	'menu_type'   => $type . '_page',
	'menu_slug'   => '516x-theme-options',
	'ajax_save'   => true,
);

// Get list all menu
$menus = wp_get_nav_menus();
$menu  = array();
if ( $menus ) {
	foreach ( $menus as $key => $value ) {
		$menu[$value->term_id] = $value->name;
	}
}

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// ----------------------------------------
// a option section for options header    -
// ----------------------------------------
$options[] = array(
	'name'  => 'header',
	'title' => esc_html__( 'Header', 'valey' ),
	'icon'  => 'fa fa-home',
	'fields' => array(
		array(
			'id'    => 'header-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'valey' ),
			'options' => array(
				'classic' => FX_VALEY_URL . '/assets/images/icons/header_01.png',
				'double'  => FX_VALEY_URL . '/assets/images/icons/header_02.png',
				'lateral' => FX_VALEY_URL . '/assets/images/icons/header_03.png',
			),
			'radio'   => true,
			'default' => 'classic'
		),
		array(
			'id'         => 'header-content-left',
			'type'       => 'textarea',
			'title'      => esc_html__( 'Content Left', 'valey' ),
			'desc'       => esc_html__( 'HTML is allowed', 'valey' ),
			'dependency' => array( 'header-layout_double', '==', 'true' ),
		),
		array(
			'id'         => 'header-content-center',
			'type'       => 'textarea',
			'title'      => esc_html__( 'Content Center', 'valey' ),
			'dependency' => array( 'header-layout_double', '==', 'true' ),
		),
		array(
			'id'        => 'logo',
			'type'      => 'image',
			'title'     => esc_html__( 'Logo', 'valey' ),
			'add_title' => esc_html__( 'Upload', 'valey' ),
		),
		array(
			'id'        => 'logo-retina',
			'type'      => 'image',
			'title'     => esc_html__( 'Logo Retina', 'valey' ),
			'desc'      => esc_html__( 'Add @2x after the logo file, example logo@2x.png', 'valey' ),
			'add_title' => esc_html__( 'Upload', 'valey' ),
		),
		array(
			'id'      => 'logo-width',
			'type'    => 'number',
			'title'   => esc_html__( 'Logo Max Width', 'valey' ),
			'desc'    => esc_html__( 'Set the maximum allowed width for logo', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '88'
		),
	),
);

// ----------------------------------------
// a option section for options layout    -
// ----------------------------------------
$options[] = array(
	'name'  => 'layout',
	'title' => esc_html__( 'Layout', 'valey' ),
	'icon'  => 'fa fa-building-o',
	'fields' => array(
		array(
			'id'      => 'content-width',
			'type'    => 'number',
			'title'   => esc_html__( 'Content Width', 'valey' ),
			'desc'    => esc_html__( 'Set the maximum allowed width for content', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '1170'
		),
		array(
			'id'    => 'boxed',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Boxed Layout', 'valey' ),
		),
		array(
			'id'         => 'boxed-bg',
			'type'       => 'background',
			'title'      => esc_html__( 'Background', 'valey' ),
			'dependency' => array( 'boxed', '==', 'true' ),
		),
		array(
			'id'    => 'canvas-sidebar',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Canvas Sidebar', 'valey' ),
			'after' => '<p class="clear">' . sprintf( wp_kses_post( 'Add content to this position at <a target="_blank" href="%s">Widget Areas</a>.', 'valey' ), esc_url( admin_url( 'widgets.php' ) ) ) . '</p>',
		),
	),
);

// ----------------------------------------
// a option section for options typography-
// ----------------------------------------
$options[] = array(
	'name'  => 'typography',
	'title' => esc_html__( 'Typography', 'valey' ),
	'icon'  => 'fa fa-font',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Body Font Settings', 'valey' ),
		),
		array(
			'id'        => 'body-font',
			'type'      => 'typography',
			'title'     => esc_html__( 'Font Family', 'valey' ),
			'default'   => array(
				'family'  => 'Libre Baskerville',
				'font'    => 'google',
				'variant' => '400',
			),
		),
		array(
			'id'      => 'body-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '15'
		),
		array(
			'id'      => 'body-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Body Color', 'valey' ),
			'default' => '#2d2d2d',
		),
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Heading Font Settings', 'valey' ),
		),
		array(
			'id'        => 'heading-font',
			'type'      => 'typography',
			'title'     => esc_html__( 'Font Family', 'valey' ),
			'default'   => array(
				'family'  => 'Montserrat',
				'font'    => 'google',
				'variant' => '400',
			),
		),
		array(
			'id'      => 'heading-color',
			'type'    => 'color_picker',
			'title'   => esc_html__( 'Heading Color', 'valey' ),
			'default' => '#000',
		),
		array(
			'id'      => 'h1-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H1 Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '48'
		),
		array(
			'id'      => 'h2-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H2 Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '36'
		),
		array(
			'id'      => 'h3-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H3 Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '28'
		),
		array(
			'id'      => 'h4-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H4 Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '20'
		),
		array(
			'id'      => 'h5-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H5 Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '16'
		),
		array(
			'id'      => 'h6-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'H6 Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '12'
		),
	),
);

// ----------------------------------------
// a option section for options blog      -
// ----------------------------------------
$options[] = array(
	'name'  => 'blog',
	'title' => esc_html__( 'Blog', 'valey' ),
	'icon'  => 'fa fa-file-text-o',
	'fields' => array(
		array(
			'id'    => 'blog-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'valey' ),
			'options' => array(
				'left-sidebar'  => FX_VALEY_URL . '/assets/images/icons/left-sidebar.png',
				'no-sidebar'    => FX_VALEY_URL . '/assets/images/icons/no-sidebar.png',
				'right-sidebar' => FX_VALEY_URL . '/assets/images/icons/right-sidebar.png',
			),
			'radio'   => true,
			'default' => 'right-sidebar'
		),
		array(
			'id'      => 'blog-page-title',
			'type'    => 'text',
			'title'   => esc_html__( 'Page Title', 'valey' ),
			'default' => esc_html__( 'Article', 'valey' ),
		),
		array(
			'id'      => 'blog-page-subtitle',
			'type'    => 'text',
			'title'   => esc_html__( 'Page Sub-Title', 'valey' ),
			'default' => esc_html__( 'Blog', 'valey' ),
		),
		array(
			'id'    => 'blog-pagehead-bg',
			'type'  => 'background',
			'title' => esc_html__( 'Page Title Background', 'valey' ),
		),
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Single Post', 'valey' ),
		),
		array(
			'id'      => 'single-title-font-size',
			'type'    => 'number',
			'title'   => esc_html__( 'Title Font Size', 'valey' ),
			'after'   => ' <i class="cs-text-muted">px</i>',
			'default' => '30'
		),
		array(
			'id'      => 'post-time',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Show Post Time', 'valey' ),
			'default' => true,
		),
		array(
			'id'      => 'post-meta',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Show Post Meta', 'valey' ),
			'default' => true,
		),
		array(
			'id'      => 'post-share',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Show Post Sharing', 'valey' ),
			'default' => true,
		),
		array(
			'id'      => 'post-author',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Show Post Author', 'valey' ),
			'default' => true,
		),
		array(
			'id'      => 'post-related',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Show Post Related', 'valey' ),
			'default' => true,
		),
	),
);

// ----------------------------------------
// a option section for options woocommerce-
// ----------------------------------------
$options[] = array(
	'name'  => 'woocommerce',
	'title' => esc_html__( 'WooCommerce', 'valey' ),
	'icon'  => 'fa fa-shopping-basket',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => esc_html__( 'Archive Products', 'valey' ),
		),
		array(
			'id'      => 'wc-page-title',
			'type'    => 'text',
			'title'   => esc_html__( 'Page Title', 'valey' ),
			'default' => esc_html__( 'Shop', 'valey' ),
		),
		array(
			'id'      => 'wc-page-subtitle',
			'type'    => 'text',
			'title'   => esc_html__( 'Page Sub-Title', 'valey' ),
			'default' => esc_html__( 'Valey Store', 'valey' ),
		),
		array(
			'id'    => 'wc-pagehead-bg',
			'type'  => 'background',
			'title' => esc_html__( 'Page Title Background', 'valey' ),
		),
		array(
			'id'    => 'wc-extra-section',
			'type'  => 'textarea',
			'title' => esc_html__( 'Extra Section', 'valey' ),
			'desc'  => esc_html__( 'This section display before product list, Put anything you want. HTML is allowed', 'valey' ),
		),
		array(
			'id'    => 'wc-style',
			'type'  => 'image_select',
			'title' => esc_html__( 'Style', 'valey' ),
			'options' => array(
				'grid'    => FX_VALEY_URL . '/assets/images/icons/wc-grid.png',
				'masonry' => FX_VALEY_URL . '/assets/images/icons/wc-masonry.png',
			),
			'radio'   => true,
			'default' => 'grid'
		),
		array(
			'id'      => 'wc-per-page',
			'type'    => 'number',
			'title'   => esc_html__( 'Number of product to show per page', 'valey' ),
			'default' => 12
		),
		array(
			'id'    => 'wc-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'valey' ),
			'options' => array(
				'left-sidebar'  => FX_VALEY_URL . '/assets/images/icons/left-sidebar.png',
				'no-sidebar'    => FX_VALEY_URL . '/assets/images/icons/no-sidebar.png',
				'right-sidebar' => FX_VALEY_URL . '/assets/images/icons/right-sidebar.png',
			),
			'radio'   => true,
			'default' => 'no-sidebar'
		),
		array(
			'id'    => 'wc-columns',
			'type'  => 'image_select',
			'title' => esc_html__( 'Columns', 'valey' ),
			'options' => array(
				'6' => FX_VALEY_URL . '/assets/images/icons/2cols.png',
				'4' => FX_VALEY_URL . '/assets/images/icons/3cols.png',
				'3' => FX_VALEY_URL . '/assets/images/icons/4cols.png',
			),
			'radio'   => true,
			'default' => '3'
		),
		array(
			'id'    => 'wc-hover-style',
			'type'  => 'image_select',
			'title' => esc_html__( 'Hover Style', 'valey' ),
			'options' => array(
				'1' => FX_VALEY_URL . '/assets/images/icons/wc-hover-01.png',
				'2' => FX_VALEY_URL . '/assets/images/icons/wc-hover-02.png',
				'3' => FX_VALEY_URL . '/assets/images/icons/wc-hover-03.png',
			),
			'default' => '1'
		),
	),
);

// ----------------------------------------
// a option section for options footer    -
// ----------------------------------------
$options[] = array(
	'name'  => 'footer',
	'title' => esc_html__( 'Footer', 'valey' ),
	'icon'  => 'fa fa-copyright',
	'fields' => array(
		array(
			'id'    => 'footer-layout',
			'type'  => 'image_select',
			'title' => esc_html__( 'Layout', 'valey' ),
			'options' => array(
				'equal'  => FX_VALEY_URL . '/assets/images/icons/footer-01.png',
				'center' => FX_VALEY_URL . '/assets/images/icons/footer-02.png',
				'three'  => FX_VALEY_URL . '/assets/images/icons/footer-03.png',
				'six'    => FX_VALEY_URL . '/assets/images/icons/footer-04.png',
			),
			'default' => 'equal'
		),
		array(
			'id'    => 'footer-bg',
			'type'  => 'background',
			'title' => esc_html__( 'Background', 'valey' ),
		),
	),
);

// ----------------------------------------
// a option section for options footer    -
// ----------------------------------------
$options[] = array(
	'name'  => 'social',
	'title' => esc_html__( 'Social Network', 'valey' ),
	'icon'  => 'fa fa-globe',
	'fields' => array(
		array(
			'id'              => 'social-network',
			'type'            => 'group',
			'title'           => esc_html__( 'Social Account', 'valey' ),
			'button_title'    => esc_html__( 'Add New', 'valey' ),
			'accordion_title' => esc_html__( 'Add New Social Network', 'valey' ),
			'fields'          => array(
				array(
					'id'    => 'link',
					'type'  => 'text',
					'title' => esc_html__( 'Account', 'valey' ),
				),
				array(
					'id'    => 'icon',
					'type'  => 'icon',
					'title' => esc_html__( 'Icon', 'valey' ),
				),
			)
		),
	),
);

// ----------------------------------------
// a option section for options other     -
// ----------------------------------------
$options[] = array(
	'name'  => 'other',
	'title' => esc_html__( 'Other', 'valey' ),
	'icon'  => 'fa fa-gift',
	'fields' => array(
		array(
			'id'    => 'maintenance',
			'type'  => 'switcher',
			'title' => esc_html__( 'Enable Maintenance Mode', 'valey' ),
			'desc'  => esc_html__( 'Put your site is undergoing maintenance, only admin can see the front end', 'valey' ),
		),
		array(
			'id'         => 'maintenance-bg',
			'type'       => 'background',
			'title'      => esc_html__( 'Background', 'valey' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'         => 'maintenance-title',
			'type'       => 'text',
			'title'      => esc_html__( 'Title', 'valey' ),
			'default'    => esc_html__( 'Coming Soon', 'valey' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'         => 'maintenance-message',
			'type'       => 'wysiwyg',
			'title'      => esc_html__( 'Message', 'valey' ),
			'default'    => esc_html__( 'Everything is almost ready for the opening', 'valey' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'          => 'maintenance-date',
			'type'        => 'text',
			'title'       => esc_html__( 'Remaining Time - Date', 'valey' ),
			'attributes'    => array(
				'placeholder' => esc_html__( '01', 'valey' ),
				'maxlength'   => 2
			),
			'dependency'  => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'          => 'maintenance-month',
			'type'        => 'text',
			'title'       => esc_html__( 'Remaining Time - Month', 'valey' ),
			'attributes'    => array(
				'placeholder' => esc_html__( '01', 'valey' ),
				'maxlength'   => 2
			),
			'dependency'  => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'          => 'maintenance-year',
			'type'        => 'text',
			'title'       => esc_html__( 'Remaining Time - Year', 'valey' ),
			'attributes'    => array(
				'placeholder' => esc_html__( '2020', 'valey' ),
				'maxlength'   => 4
			),
			'dependency'  => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'         => 'maintenance-content',
			'type'       => 'wysiwyg',
			'title'      => esc_html__( 'Extra Content', 'valey' ),
			'desc'       => esc_html__( 'This content will be put at right bottom, HTML is allowed', 'valey' ),
			'dependency' => array( 'maintenance', '==', 'true' ),
		),
		array(
			'id'    => 'not-found-bg',
			'type'  => 'image',
			'title' => esc_html__( 'Background for 404', 'valey' ),
		),
		array(
			'id'      => 'not-found-content',
			'type'    => 'textarea',
			'title'   => esc_html__( '404 content', 'valey' ),
			'desc'    => esc_html__( 'HTML is allowed', 'valey' ),
			'default' => esc_html__( 'Nice! You have found the real valey', 'valey' ),
		),
	),
);

// ----------------------------------------
// a option section for options backup     -
// ----------------------------------------
$options[]   = array(
	'name'   => 'backup_section',
	'title'  => 'Backup',
	'icon'   => 'fa fa-shield',
	'fields' => array(
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => esc_html__( 'You can save your current options. Download a Backup and Import.', 'valey' ),
		),
		array(
			'type'    => 'backup',
		),
	)
);
CSFramework::instance( $settings, $options );
