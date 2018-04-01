<?php
/**
 * The Template for displaying all single posts
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
$nautica_page_layouts = apply_filters( 'nautica_fnc_get_single_sidebar_configs', null );

get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) );

?>
<?php do_action( 'nautica_template_main_before' ); ?>
<section id="main-container" class="container <?php echo apply_filters( 'nautica_template_main_content_class', nautica_fnc_theme_options('blog-single-layout') ); ?>">
	<div class="row">
		<?php if( isset($nautica_page_layouts['sidebars']) && !empty($nautica_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		<div id="main-content" class="main-content col-sm-12 <?php echo esc_attr($nautica_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							get_template_part( 'content', 'columns' );
							do_action('nautica_blog_related_posts');

							// Previous/next post navigation.
							//nautica_fnc_post_nav();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						endwhile;
					wp_reset_query();
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	

	</div>	
</section>
<?php
get_footer();
