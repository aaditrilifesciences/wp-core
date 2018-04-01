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

						<header class="page-header">
							<h1 class="page-title">
								<?php
									if ( is_day() ) :
										printf( esc_html__( 'Daily Archives: %s', 'nautica' ), get_the_date() );

									elseif ( is_month() ) :
										printf( esc_html__( 'Monthly Archives: %s', 'nautica' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'nautica' ) ) );

									elseif ( is_year() ) :
										printf( esc_html__( 'Yearly Archives: %s', 'nautica' ), get_the_date( _x( 'Y', 'yearly archives date format', 'nautica' ) ) );

									else :
										esc_html_e( 'Archives', 'nautica' );

									endif;
								?>
							</h1>
						</header><!-- .page-header -->

						<?php
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
					</div><!-- #content -->

				
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->


 
	</div>	
</section>
<?php
get_footer();
 
