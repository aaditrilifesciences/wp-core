<?php
/**
 * The template for displaying Category pages
 *
 * @link http://engotheme.com/themes/engotheme
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
$nautica_page_layouts = apply_filters( 'nautica_fnc_get_archive_sidebar_configs', null ); // echo '<Pre>'.print_r($nautica_page_layouts,1 ); die;
get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) );
$view_mode = nautica_fnc_theme_options("blog-archive-view-mode")?nautica_fnc_theme_options("blog-archive-view-mode"):"grid";
$columns = nautica_fnc_theme_options("blog-archive-column")?nautica_fnc_theme_options("blog-archive-column"):1;
$column_class= $view_mode."-".$columns;
?>
<?php do_action( 'nautica_template_main_before' ); ?>
	<section id="main-container" class="<?php echo apply_filters('nautica_template_main_container_class','container');?> inner <?php echo nautica_fnc_theme_options('blog-archive-layout') ; ?>">
		<div class="row">

			<?php if( isset($nautica_page_layouts['sidebars']) && !empty($nautica_page_layouts['sidebars']) ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

			<div id="main-content" class="main-content col-sm-12 <?php echo esc_attr($nautica_page_layouts['main']['class']); ?>">
				<div id="primary" class="content-area">
					<div id="content" class="site-content row view-mode <?php echo $view_mode;?> <?php echo $column_class;?>" data-role="main">

					<?php if ( have_posts() ) : ?>

					<header class="archive-header">
						<h1 class="archive-title">
							<?php
								/*
								 * Queue the first post, that way we know what author
								 * we're dealing with (if that is the case).
								 *
								 * We reset this later so we can run the loop properly
								 * with a call to rewind_posts().
								 */
								the_post();

								printf( esc_html__( 'All posts by %s', 'nautica' ), get_the_author() );
							?>
						</h1>
						<?php if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
						<?php endif; ?>
					</header><!-- .archive-header -->

					<?php
							/*
							 * Since we called the_post() above, we need to rewind
							 * the loop back to the beginning that way we can run
							 * the loop properly, in full.
							 */
							rewind_posts();

							// Start the Loop.
							while ( have_posts() ) : the_post();

								get_template_part( 'content', 'columns' );

							endwhile;
							// Previous/next page navigation.
							nautica_fnc_paging_nav();

						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>

				</div><!-- #content 
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->
 
	 
	 
	</div>	
</section>
<?php
get_footer();