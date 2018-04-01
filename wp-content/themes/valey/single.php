<?php
/**
 * The template for displaying all single posts.
 *
 * @since   1.0.0
 * @package Valey
 */

get_header(); ?>

<?php get_template_part( 'views/common/page', 'head' ); ?>

<div id="fx-content" class="pr__10 pl__10">
	<div class="fx-container">
		<div class="fx-single mb__100">
			<div class="fx-row">
				<div class="fx-col-md-offset-1 fx-col-md-10 fx-col-xs-12">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'views/post/content', 'single' ); ?>

						<?php
							if ( cs_get_option( 'post-share' ) ) {
								fx_valey_social_share();
							}
						?>

						<div class="fx-row bdb pb__65 mb__40">
							<div class="fx-col-md-6 fx-col-xs-12">
								<?php
									if ( cs_get_option( 'post-author' ) ) {
										fx_valey_author_info();
									}
								?>
							</div>
							<div class="fx-col-md-6 fx-col-xs-12">
								<?php
									if ( cs_get_option( 'post-related' ) ) {
										fx_valey_related_post();
									}
								?>
							</div>
						</div>
						
						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						?>
					<?php endwhile; ?>
				</div><!-- .fx-single -->
			</div><!-- .fx-col-md-10 -->
		</div><!-- .fx-blog-single -->
	</div><!-- .fx-row -->
</div><!-- #fx-content -->

<?php get_footer(); ?>