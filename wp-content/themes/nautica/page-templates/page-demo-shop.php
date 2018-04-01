<?php
/**
 * Template Name: Demo shop
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
$nautica_page_layouts = apply_filters( 'nautica_fnc_get_page_sidebar_configs', null );

get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) );
?>
<?php do_action( 'nautica_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('nautica_template_main_container_class','container');?> inner">
	<div class="row">
		<?php if( isset($nautica_page_layouts['sidebars']) && !empty($nautica_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>	
		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($nautica_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
?>
							<div class="products-top-wrap clearfix">
								<form class="display-mode" method="get">
									<a title="<?php esc_html_e('Grid','nautica');?>" class="btn" href="/shop-grid-full-width/"><i class="fa fa-th"></i></a>
									<a title="<?php esc_html_e('List','nautica');?>" class="btn" href="/shop-list-view-left-sidebar/"><i class="fa fa-th-list"></i></a></form><form class="woocommerce-ordering" method="get">
									<select name="orderby" class="orderby">
										<option value="menu_order" selected="selected"><?php esc_html_e( 'Default sorting', 'nautica' );?></option>
										<option value="popularity"><?php esc_html_e( 'Sort by popularity', 'nautica' );?></option>
										<option value="rating"><?php esc_html_e( 'Sort by average rating', 'nautica' );?></option>
										<option value="date"><?php esc_html_e( 'Sort by newness', 'nautica' );?></option>
										<option value="price"><?php esc_html_e( 'Sort by price: low to high', 'nautica' );?></option>
										<option value="price-desc"><?php esc_html_e( 'Sort by price: high to low', 'nautica' );?></option>
									</select>
									<input type="hidden" name="display" value="grid">
								</form>
							</div>
					<?php
							// Include the page content template.
							get_template_part( 'content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						endwhile;
					?>

				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section>
<?php
get_footer();
