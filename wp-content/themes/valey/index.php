<?php
/**
 * The main template file.
 *
 * @since   1.0.0
 * @package Valey
 */

$layout = cs_get_option( 'blog-layout' );
if ( 'left-sidebar' == $layout ) {
	$content_class = 'fx-col-md-8 fx-col-xs-12 last-md';
	$sidebar_class = 'fx-col-md-4 fx-col-xs-12 first-md';
} elseif ( 'right-sidebar' == $layout ) {
	$content_class = 'fx-col-md-8 fx-col-xs-12';
	$sidebar_class = 'fx-col-md-4 fx-col-xs-12';
} else {
	$content_class = 'fx-col-md-12 fx-col-xs-12';
	$sidebar_class = '';
}
get_header(); ?>

<?php get_template_part( 'views/common/page', 'head' ); ?>

<div id="fx-content" class="pr__10 pl__10">
	<div class="fx-container">
		<div class="fx-row fx-blog">
			<div class="<?php echo esc_attr( $content_class ); ?>">
				<div class="posts mt__55">
					<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								get_template_part( 'views/post/content', get_post_format() );
							endwhile;
						else :
							get_template_part( 'views/post/content', 'none' );
						endif;
						fx_valey_pagination();
					?>
				</div><!-- .posts -->
			</div><!-- .fx-col-md-8 -->
			
			<?php if ( 'no-sidebar' != $layout ) { ?>
				<div class="<?php echo esc_attr( $sidebar_class ); ?>">
					<?php get_sidebar(); ?>
				</div><!-- .fx-col-md-4 -->
			<?php } ?>
		</div><!-- .fx-row -->
	</div><!-- .fx-container -->
</div><!-- #fx-content -->

<?php get_footer(); ?>