<?php 
/**
 * Remove javascript and css files not use
 */


/**
 * Hook to top bar layout
 */
function nautica_fnc_topbar_layout(){
	$layout = nautica_fnc_get_header_layout();
	get_template_part( 'page-templates/parts/topbar', $layout );
}

add_action( 'nautica_template_header_before', 'nautica_fnc_topbar_layout' );

function nautica_fnc_topbar_add_langguage_menu() {
	get_template_part( 'page-templates/parts/language-menu');
}
add_action('nautica-topbar-buttons','nautica_fnc_topbar_add_langguage_menu',15);

function nautica_fnc_topbar_add_curency_menu() {
	get_template_part( 'page-templates/parts/currency-menu');
}
add_action('nautica-topbar-buttons','nautica_fnc_topbar_add_curency_menu',10);

/**
 * Hook to select header layout for archive layout
 */

function nautica_fnc_get_header_layout( $layout='' ){
	if( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
		$layout = 'default';
		return $layout;
	}
	if( is_product() ){
		$layout =  nautica_fnc_theme_options('woo_detail_header_layout')?nautica_fnc_theme_options('woo_detail_header_layout'):nautica_fnc_theme_options( 'headerlayout' );
	}else if( is_product_category()  ){
		$layout =  nautica_fnc_theme_options('woo_archive_header_layout')?nautica_fnc_theme_options('woo_archive_header_layout'):nautica_fnc_theme_options( 'headerlayout' );
	}else if( is_category() || is_archive()  ){
		$layout =  nautica_fnc_theme_options('post_archive_header_layout')?nautica_fnc_theme_options('post_archive_header_layout'):nautica_fnc_theme_options( 'headerlayout' );
	} else {
		global $post;
		$layout = $post && get_post_meta( $post->ID, 'nautica_header_layout', 1 ) ? get_post_meta( $post->ID, 'nautica_header_layout', 1 ) : nautica_fnc_theme_options( 'headerlayout' );
	}
	if(empty($layout)) $layout = NAUTICA_THEME_DEFAULT_HEADER_VERSION;
	return $layout;
}
add_filter( 'nautica_fnc_get_header_layout', 'nautica_fnc_get_header_layout' );

function nautica_fnc_get_header_logo() {
	$layout = nautica_fnc_get_header_layout();
	// Check retina support
	$logo_retina = nautica_fnc_theme_options("header_".$layout."_logo_retina_text_field");
	$logo_link = nautica_fnc_theme_options("header_".$layout."_logo");

	if(!$logo_link && !$logo_retina) $logo = '<img src="'.get_template_directory_uri() . '/images/logo.png" alt="'.get_bloginfo( 'name' ).'"/>';
	else {
		if($logo_retina) $logo =  $logo_retina;
		elseif(!$logo_retina && $logo_link) $logo = '<img src="'.$logo_link . '" alt="'.get_bloginfo( 'name' ).'"/>';
	}
	return $logo;
}

/** Custom navigation menu each custom header **/
function nautica_fnc_get_custom_primary_menu() {
	$layout = nautica_fnc_get_header_layout();
	if($layout) {
		if($layout == 'default') {
			$args = array(  'theme_location' => "primary",
				'container_class' => 'collapse navbar-collapse navbar-mega-collapse',
				'menu_class' => 'nav navbar-nav megamenu',
				'fallback_cb' => '',
				'menu_id' => "primary",
				'walker' => new Nautica_bootstrap_navwalker() );
		} else {
			$args = array(  'theme_location' => "primary_menu_header_".$layout,
				'container_class' => 'collapse navbar-collapse navbar-mega-collapse',
				'menu_class' => 'nav navbar-nav megamenu',
				'fallback_cb' => '',
				'menu_id' => "primary_menu_header_".$layout,
				'walker' => new Nautica_bootstrap_navwalker() );
		}
	}
	else
		$args = array(  'theme_location' => 'primary',
				'container_class' => 'collapse navbar-collapse navbar-mega-collapse',
				'menu_class' => 'nav navbar-nav megamenu',
				'fallback_cb' => '',
				'menu_id' => 'primary-menu',
				'walker' => new Nautica_bootstrap_navwalker() );

	wp_nav_menu($args);
}
add_action('nautica_custom_navigation_header','nautica_fnc_get_custom_primary_menu');

function add_search_form_to_dropdown_menu() {
	get_template_part( 'page-templates/parts/search-v1');
}
add_action("after_dropdown_menu_ul","add_search_form_to_dropdown_menu");
/**
 * Hook to select header layout for archive layout
 */
function nautica_fnc_get_footer_profile( $profile='default' ){

	if( is_product() ){
		$profile = nautica_fnc_theme_options('woo_detail_footer_layout');
	}else if( is_product_category()  ){
		$profile =  nautica_fnc_theme_options('woo_archive_footer_layout');
	}else if( is_category() || is_archive()  ){
		$profile =  nautica_fnc_theme_options('post_archive_footer_layout');
	} else {
		global $post;
		$profile =  $post? get_post_meta( $post->ID, 'nautica_footer_profile', 1 ):null ;
	}

 	if( $profile ){
 		return trim( $profile );
 	}elseif ( $profile = nautica_fnc_theme_options('footer-style', $profile ) ){
 		return trim( $profile );
 	}
	return $profile;
} 

add_filter( 'nautica_fnc_get_footer_profile', 'nautica_fnc_get_footer_profile' );

function nautica_fnc_get_footer_custom_key($footer){
	$post = get_post($footer);
	$footer_key =  $post? get_post_meta( $post->ID, 'nautica_footer_key', 1 ):null ;
	if( $footer_key ) return $footer_key;
	else return false;
}

function nautica_fnc_get_header_possition(){
	if(is_single() || is_page()) {
		global $post;
		$position = $post && get_post_meta( $post->ID, 'nautica_header_position', 1 ) ? get_post_meta( $post->ID, 'nautica_header_position', 1 ) : '';
	} elseif( is_product_category()){
		$position = nautica_fnc_theme_options('nautica-product-archive-header-position')?nautica_fnc_theme_options('nautica-product-archive-header-position'):'';
	} elseif(is_category() || is_archive()) {
		$position = nautica_fnc_theme_options('nautica-blog-archive-header-position')?nautica_fnc_theme_options('nautica-blog-archive-header-position'):'';
	} else {
		$position = '';
	}

	echo $position;
}

function nautica_fnc_get_header_sticky(){
	$sticky = nautica_fnc_theme_options('nautica_sticky_header')?'engoj-sticky-header engoc-sticky-header':'';
	echo $sticky;
}

/**
 * Render Custom Css Renderig by Visual composer
 */
if ( !function_exists( 'nautica_fnc_print_style_footer' ) ) {
	function nautica_fnc_print_style_footer(){
		$footer =  nautica_fnc_get_footer_profile( 'default' );
		if($footer!='default'){
			$shortcodes_custom_css = get_post_meta( $footer, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				echo '<style>
					'.$shortcodes_custom_css.'
					</style>';
			}
		}
	}
	add_action('wp_head','nautica_fnc_print_style_footer', 18);
}


/**
 * Hook to show breadscrumbs
 */
function nautica_fnc_render_breadcrumbs(){
	$eclass = '';
	$estyle = '';
	$eimage = '';
	$efull_width_class = '';
	if(is_category() || is_archive()) {
		$bgimage = nautica_fnc_theme_options('archive_breadcrumbs_images')?nautica_fnc_theme_options('archive_breadcrumbs_images'):'';
		$efull_width_class = $bgimage?'container-fluid':'container';
		if( $bgimage  ){
			$eclass = ' has-image';
			$eimage = '<p class="category-banner"><img src="'.$bgimage.'"></p>';
		}
	} elseif (is_single() || is_page()) {
		global $post;
		$disable = get_post_meta( $post->ID, 'nautica_disable_breadscrumb', 1 );
		if(  $disable || is_front_page() ){
			return true;
		}
		$bgimage = get_post_meta( $post->ID, 'nautica_image_breadscrumb', 1 );
		$color = get_post_meta( $post->ID, 'nautica_color_breadscrumb', 1 );
		$bgcolor = get_post_meta( $post->ID, 'nautica_bgcolor_breadscrumb', 1 );
		$style = array();
		$eclass = '';
		$eimage = '';
		$efull_width_class = 'container';
		if( $bgcolor  ){
			$style[] = 'background-color:'.$bgcolor;
		}
		if( $bgimage  ){
			//$style[] = 'background-image:url(\''.wp_get_attachment_url($bgimage).'\')';
			$eclass = ' has-image';
			$eimage = '<p class="category-banner"><img src="'.wp_get_attachment_url($bgimage).'"></p>';
			$efull_width_class = 'container-fluid';
		}

		if( $color  ){
			$style[] = 'color:'.$color;
		}

		$estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
	}
	echo '<section id="engo-breadscrumb" class="engo-breadscrumb'.$eclass.'" '.$estyle.'>'.$eimage.'<div class="'.$efull_width_class.'">';
			nautica_fnc_breadcrumbs();
	echo '</div></section>';

}
add_action( 'nautica_template_main_before', 'nautica_fnc_render_breadcrumbs' );

 
/**
 * Main Container
 */

function nautica_template_main_container_class( $class ){
	global $post; 
	global $nautica_wpopconfig;

	$layoutcls = get_post_meta( $post->ID, 'nautica_enable_fullwidth_layout', 1 );
	
	if( $layoutcls ) {
		$nautica_wpopconfig['layout'] = 'fullwidth';
		return 'container-fluid';
	}
	return $class;
}
add_filter( 'nautica_template_main_container_class', 'nautica_template_main_container_class', 1 , 1  );



function nautica_template_footer_before(){
	return get_sidebar( 'newsletter' );
}

//add_action( 'nautica_template_footer_before', 'nautica_template_footer_before' );


/**
 * Get Configuration for Page Layout
 *
 */
function nautica_fnc_get_page_sidebar_configs( $configs='' ){
	global $post;
	$left  =  get_post_meta( $post->ID, 'nautica_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'nautica_rightsidebar', 1 );
	return nautica_fnc_get_layout_configs( $left, $right );
}
add_filter( 'nautica_fnc_get_page_sidebar_configs', 'nautica_fnc_get_page_sidebar_configs', 1, 1 );


function nautica_fnc_get_single_sidebar_configs( $configs='' ){
	global $post;
	$layout  =  get_post_meta( $post->ID, 'nautica_page_layout', 1 );
	if($layout) {
		$left  =  get_post_meta( $post->ID, 'nautica_leftsidebar', 1 );
		$right =  get_post_meta( $post->ID, 'nautica_rightsidebar', 1 );
	} else {
		$left  =  nautica_fnc_theme_options( 'blog-single-left-sidebar' );
		$right =  nautica_fnc_theme_options( 'blog-single-right-sidebar' );
	}
	return nautica_fnc_get_layout_configs( $left, $right );
}
add_filter( 'nautica_fnc_get_single_sidebar_configs', 'nautica_fnc_get_single_sidebar_configs', 1, 1 );

function nautica_fnc_get_archive_sidebar_configs( $configs='' ){
	$right = null; $left = null;
	if( is_category() || is_archive() ){
		$layout = nautica_fnc_theme_options('blog-archive-layout');
		if($layout) {
			$left  =  nautica_fnc_theme_options( 'blog-archive-left-sidebar' );
			$right =  nautica_fnc_theme_options( 'blog-archive-right-sidebar' );
		}
	}
	return nautica_fnc_get_layout_configs( $left, $right );
}
add_filter( 'nautica_fnc_get_archive_sidebar_configs', 'nautica_fnc_get_archive_sidebar_configs', 1, 1 );

/**
 *
 */
function nautica_fnc_get_layout_configs( $left, $right ){
	$configs = array();
	$configs['main'] = array( 'class' => 'col-lg-9 col-md-9' );
	if( !empty($right) || !empty($left) ){
 		
 		$configs['sidebars'] = array( 
 									'left'  => array( 'sidebar' => $left, 'active' => is_active_sidebar( $left ), 'class' => 'col-lg-3 col-md-3'  ),
 									'right' => array( 'sidebar' => $right, 'active' => is_active_sidebar( $right ), 'class' => 'col-lg-3 col-md-3' ) 
 		); 
 	}
 
	if( $left && $right ){
		$configs['main'] 	= array( 'class'	 => 'col-lg-6 col-md-6' );
		$configs['sidebars']['left']['class'] 	 = 'col-lg-3 col-md-3';
		$configs['sidebars']['right']['class']   = 'col-lg-3 col-md-3';

	}elseif( empty($left) && empty($right) ){
		$configs['main'] = array( 'class' => 'col-lg-12 col-md-12' );
	}
	return $configs; 
}

function nautica_fnc_sidebars_others_configs(){
	global $nautica_page_layouts;
	return $nautica_page_layouts;
}
add_filter("nautica_fnc_sidebars_others_configs", "nautica_fnc_sidebars_others_configs");

function nautica_fnc_sidebars_default_configs(){
	$nautica_page_layouts = array();
	$nautica_page_layouts['main'] = array( 'class' => 'col-lg-9 col-md-9' );
	$nautica_page_layouts['sidebars'] = array(
		'left'  => array( 'sidebar' => '', 'active' => false, 'class' => 'col-lg-3 col-md-3'  ),
		'right' => array( 'sidebar' => 'blog-sidebar-right', 'active' => true, 'class' => 'col-lg-3 col-md-3' )
	);
	return $nautica_page_layouts;
}
add_filter("nautica_fnc_sidebars_default_configs", "nautica_fnc_sidebars_default_configs");
/**
 *
 */
function nautica_fnc_single_social_share($url) {
	global $wp;
	$link = $url?urlencode(esc_url($url)):urlencode(esc_url(home_url( $wp->request )));
	?>
	<div class="sharing-box">
		<h4>Share this :</h4>
		<div class="social-sharing clearfix normal">
			<a class="share-twitter" href="https://twitter.com/home?status=<?php echo $link;?>" target="_blank">
				<i class="fa fa-twitter"></i>
			</a>
			<a class="share-google" href="https://plus.google.com/share?url=<?php echo $link;?>" target="_blank">
				<i class="fa fa-google-plus"></i>
			</a>
			<a class="share-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo $link;?>&media=&description=" target="_blank">
				<i class="fa fa-pinterest"></i>
			</a>
			<a class="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link;?>" target="_blank">
				<i class="fa fa-facebook"></i>
			</a>
		</div>
	</div>
	<?php
}
add_action('nautica_social_share','nautica_fnc_single_social_share',30);





 