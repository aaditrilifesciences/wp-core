<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
$nautica_page_layouts = apply_filters( 'nautica_fnc_get_woocommerce_sidebar_configs', null );
get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'nautica_woo_template_main_before' ); ?>
<?php
	$page_layout = nautica_fnc_theme_options( 'woocommerce-archive-layout' );
	$container_layout = ($page_layout == 'mainfullwidth')?"container-fluid":"container";
?>
<section id="main-container" class="<?php echo apply_filters('nautica_template_woocommerce_main_container_class',$container_layout);?>">
	
	<div class="row">
		
		<?php if( isset($nautica_page_layouts['sidebars']) && !empty($nautica_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($nautica_page_layouts['main']['class']); ?>">

	 
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					 <?php  woocommerce_content(); ?>

				</div><!-- #content -->
			</div><!-- #primary -->


			<?php    get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

	</div>	
</section>
<?php

get_footer();
