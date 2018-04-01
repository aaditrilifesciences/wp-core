<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */

get_header( apply_filters( 'nautica_fnc_get_header_layout', null ) ); ?>

	<section id="primary" class="container content-area inner">
		<div class="row">
			<div id="content" class="site-content col-sm-12">

				<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'nautica' ), get_search_query() ); ?></h1>
				</header><!-- .page-header -->

					<?php
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
		</div>
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
