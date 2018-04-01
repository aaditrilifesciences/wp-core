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

$nautica_page_layouts = apply_filters( 'nautica_fnc_sidebars_default_configs', null );
if( isset($nautica_page_layouts['main']) ) $main = $nautica_page_layouts['main'];

get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) );
$view_mode = nautica_fnc_theme_options("blog-archive-view-mode")?nautica_fnc_theme_options("blog-archive-view-mode"):"grid";
$columns = nautica_fnc_theme_options("blog-archive-column")?nautica_fnc_theme_options("blog-archive-column"):1;
$column_class= $view_mode."-".$columns;
?>
<?php do_action( 'nautica_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('nautica_template_main_container_class','container');?> inner">
	<div class="row">
		<div id="main-content" class="main-content <?php echo esc_attr($main['class']) ;?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						if ( have_posts() ) :
							// Start the Loop.
							while ( have_posts() ) : the_post();
								get_template_part( 'content', 'columns' );
							endwhile;
							// Previous/next post navigation.
							nautica_fnc_paging_nav();
						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>

				</div><!-- #content -->
			</div><!-- #primary -->

		</div><!-- #main-content -->
		<?php if( isset($nautica_page_layouts['sidebars']) && !empty($nautica_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
	</div>	
</section>
<?php
get_footer();
?>