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

get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) ); ?>

<section id="main-container" class="<?php echo apply_filters('nautica_template_main_container_class','container');?> inner">
	<div class="row">
		<div id="main-content" class="main-content col-lg-12">
			<div id="primary" class="content-area">
				 <div id="content" class="site-content" role="main">
					<div class="page-content engo-404-block">
						<p class="engo-404-content"><?php esc_html_e( 'This is not the web page you are looking for', 'nautica' ); ?></p>
						<p>
							<?php esc_html_e('Please try one of the following pages', 'nautica');?>
							<a href="<?php echo get_option('siteurl');?>" class="btn btn-primary">Home page</a>
						</p>
						<?php nautica_fnc_categories_searchform(); ?>
					</div><!-- .page-content -->

				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

		 
		<?php get_sidebar(); ?>
	 
	</div>	
</section>
<?php

get_footer();

 