<?php
/**
 * The template to display woocommerce content.
 *
 * @since   1.0.0
 * @package Valey
 */

get_header(); ?>

<?php get_template_part( 'views/common/page', 'head' ); ?>

<div id="fx-content" class="pr__10 pl__10">
	<?php
		if ( ! is_product() ) echo '<div class="fx-container">';
		if ( cs_get_option( 'wc-extra-section' ) ) {
			echo cs_get_option( 'wc-extra-section' );
		}
	?>
		<div class="fx-shop <?php echo is_product() ? 'mb__80' : 'mb__30 mt__45'; ?>">
			<?php woocommerce_content(); ?>
		</div><!-- .posts -->
	<?php if ( ! is_product() ) echo '</div><!-- .fx-container -->'; ?>
</div><!-- #fx-content -->

<?php get_footer(); ?>