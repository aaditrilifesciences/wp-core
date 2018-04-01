<?php
/**
 * Implement Custom Header functionality for EngoTheme
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since EngoTheme 1.0
 *
 * @uses nautica_fnc_header_style()
 * @uses nautica_fnc_admin_header_style()
 * @uses nautica_fnc_admin_header_image()
 */
function nautica_fnc_custom_header_setup() {
	/**
	 * Filter EngoTheme custom-header support arguments.
	 *
	 * @since EngoTheme 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 240.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'nautica_fnc_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 1260,
		'height'                 => 240,
		'flex-height'            => true,
		'wp-head-callback'       => 'nautica_fnc_header_style',
		'admin-head-callback'    => 'nautica_fnc_admin_header_style',
		'admin-preview-callback' => 'nautica_fnc_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'nautica_fnc_custom_header_setup' );

if ( ! function_exists( 'nautica_fnc_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see nautica_fnc_custom_header_setup().
 *
 */
function nautica_fnc_header_style() {
	$text_color = get_header_textcolor(); 

	// If no custom color for text is set, let's bail.
	

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="nautica-header-css">
		<?php 
		$page_bg = get_option('page_bg');
		if( !empty($page_bg) && preg_match("#\##", $page_bg) ) :  ?>
		#page{
			background-color:<?php echo trim($page_bg); ?>;
		}
		<?php endif; ?>
		<?php 
		$footer_bg = get_option('footer_bg');
		if( !empty($footer_bg) && preg_match("#\##", $footer_bg) ) :  ?>
		#engo-footer {
			background-color:<?php echo trim($footer_bg); ?> ;
		}
		<?php endif; ?>
		<?php 
		$footer_color = get_option('footer_color');
		if( !empty($footer_color) && preg_match("#\##", $footer_color) ) :  ?>
		#engo-footer , #engo-footer a{
			color: <?php echo trim($footer_color); ?>
		}
		<?php endif; ?>
		<?php
		$footer_color = get_option('footer_heading_color');
		if( !empty($footer_color) && preg_match("#\##", $footer_color) ) :  ?>
		#engo-footer h2, #engo-footer h3, #engo-footer h4{
			color: <?php echo trim($footer_color); ?>
		}
		<?php endif; ?>
		<?php $topbar_bg = get_option('topbar_bg'); if( !empty($topbar_bg) && preg_match("#\##", $topbar_bg) ) :  ?>
		#engo-topbar {
			background-color:<?php echo trim($topbar_bg); ?> ;
		}
		<?php endif; ?>
		<?php $topbar_color = get_option('topbar_color'); if( !empty($topbar_color) && preg_match("#\##", $topbar_color) ) :  ?>
		#engo-topbar , #engo-topbar a{
			color: <?php echo trim($topbar_color); ?>
		}
		<?php endif; ?>
	</style>

	<?php if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return; ?>
	<?php
}
endif; // nautica_fnc_header_style


if ( ! function_exists( 'nautica_fnc_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see nautica_fnc_custom_header_setup()
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_admin_header_style() {
?>
	<style type="text/css" id="nautica-admin-header-css">
	.appearance_page_custom-header #headimg {
		background-color: #000;
		border: none;
		max-width: 1260px;
		min-height: 48px;
	}
	#headimg h1 {
		font-family: Lato, sans-serif;
		font-size: 18px;
		line-height: 48px;
		margin: 0 0 0 30px;
	}
	.rtl #headimg h1  {
		margin: 0 30px 0 0;
	}
	#headimg h1 a {
		color: #fff;
		text-decoration: none;
	}
	#headimg img {
		vertical-align: middle;
	}

<?php
}
endif; // nautica_fnc_admin_header_style

if ( ! function_exists( 'nautica_fnc_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see nautica_fnc_custom_header_setup()
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name" style="<?php echo esc_attr( sprintf( 'color: #%s;', get_header_textcolor() ) ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // nautica_fnc_admin_header_image

if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	function nautica_fnc_header_include() {
		$favicon = nautica_fnc_theme_options('favicon');
		if($favicon) {
			echo '<link rel="icon" href="'.$favicon.'" type="image/x-icon" /><link rel="shortcut icon" href="'.$favicon.'" type="image/x-icon" />';
		}
	}
	add_action('wp_head','nautica_fnc_header_include');
}