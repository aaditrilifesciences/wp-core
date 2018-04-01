<?php
/**
 * The template for displaying all pages.
 *
 * @since   1.0.0
 * @package Valey
 */

// Get VC setting
$vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_page_options', true );

// Render columns number
if ( isset( $options['layout'] ) ) {
	switch ( $options['layout'] ) {
		case 'left-sidebar' :
			$content_class = 'fx-col-md-8 fx-col-xs-12 last-md mt__55 mb__55';
			$sidebar_class = 'fx-col-md-4 fx-col-xs-12 first-md';
			break;

		case 'right-sidebar' :
			$content_class = 'fx-col-md-8 fx-col-xs-12 mt__55 mb__55';
			$sidebar_class = 'fx-col-md-4 fx-col-xs-12';
			break;

		case 'no-sidebar' :
		default:
			$content_class = 'fx-col-md-12 fx-col-xs-12';
			break;
	}
} else {
	$content_class = 'fx-col-md-12 fx-col-xs-12';
}

get_header(); ?>

<?php get_template_part( 'views/common/page', 'head' ); ?>

<div id="fx-content">
	<?php if ( 'false' == $vc || empty( $vc ) || ( isset( $options['layout'] ) && 'no-sidebar' != $options['layout'] ) ) echo '<div class="fx-container">'; ?>
		<div class="fx-row fx-page">
			<div class="<?php echo esc_attr( $content_class ); ?>" role="main">
				<?php
					while ( have_posts() ) : the_post();
						the_content();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endwhile;

					// Displays page-links
					wp_link_pages();
				?>
			</div><!-- $classes -->
			
			<?php if ( ! empty( $options['layout'] ) && 'no-sidebar' != $options['layout'] ) { ?>
				<div class="<?php echo esc_attr( $sidebar_class ); ?>" role="sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div><!-- .fx-row -->
	<?php if ( 'false' == $vc || empty( $vc ) || ( isset( $options['layout'] ) && 'no-sidebar' != $options['layout'] ) ) echo '</div>'; ?>
</div><!-- #fx-content -->

<?php get_footer(); ?>
