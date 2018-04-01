<?php
/**
 * The Template for displaying all single posts
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */

get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'nautica_template_main_before' ); ?>
<section id="main-container">
	<div class="row">
		<div id="main-content" class="main-content col-lg-12">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();
							echo '<div class="container">';
							do_action( 'nautica_layout_portfolio_single_template_loop_before' ) ;
							echo '</div>';
							$format = get_post_meta(get_the_ID(), 'portfolio_layout',true);

						//	get_template_part( 'portfolio/content', get_post_format()  );
							engo_themer_get_template_part( 'portfolio/content', $format );
						
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

							echo '<div class="container">';
							do_action( 'nautica_layout_portfolio_single_template_loop_after' ) ;
							echo '</div>';
						endwhile;
					?>
					 <?php ; ?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	
 
	</div>	
</section>
<?php
get_footer();
