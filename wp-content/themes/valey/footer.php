<?php
/**
 * The template for displaying the footer.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
		<?php get_template_part( 'views/footer/' . cs_get_option( 'footer-layout' ) ); ?>

		<?php get_sidebar( 'canvas' ); ?>
	</div><!-- #fx-wrapper -->

	<?php wp_footer(); ?>

	</body>
</html>