<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
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
				<h1 class="archive-title"><?php printf( esc_html__( 'Tag Archives: %s', 'nautica' ), single_tag_title( '', false ) ); ?></h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->
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
?>