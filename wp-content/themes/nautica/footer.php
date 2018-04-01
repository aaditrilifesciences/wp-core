<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
$footer_profile =  apply_filters( 'nautica_fnc_get_footer_profile', 'default' );
$footer_key = nautica_fnc_get_footer_custom_key($footer_profile)?nautica_fnc_get_footer_custom_key($footer_profile):"";
?>

		</section><!-- #main -->
		<?php do_action( 'nautica_template_main_after' ); ?>
		<?php do_action( 'nautica_template_footer_before' ); ?>
		<footer id="engo-footer" class="engo-footer <?php echo $footer_key;?>" data-role="contentinfo">
			<?php if( $footer_profile && $footer_profile != 'default' ) : ?>
			<div class="inner">
				<div class="engo-footer-profile">
					<?php nautica_fnc_render_post_content( $footer_profile ); ?>
				</div>
			</div>
			<?php else: ?>
			<div class="inner">
				<?php get_sidebar( 'footer' ); ?>
			</div>
			<?php endif; ?>
			<section class="engo-copyright">
				<div class="container">
					<?php do_action( 'nautica_fnc_credits' ); ?>
					<?php
					 if(nautica_fnc_theme_options('copyright_text')) {
						 ?>
						 <a href="<?php echo esc_url( home_url('/') ) ;?>"><?php echo nautica_fnc_theme_options('copyright_text'); ?></a>
					 <?php
					 } else {
						 ?>
						 <a href="<?php echo 'https://wordpress.org/';?>"><?php printf( esc_html__( 'Proudly powered by %s', 'nautica' ), 'WordPress' ); ?></a>
					<?php
					 }
					?>

				</div>
			</section>
		</footer><!-- #colophon -->
		<?php do_action( 'nautica_template_footer_after' ); ?>
		<?php get_sidebar( 'offcanvas' );  ?>
	</div>
</div>
<a href="#" id="back-to-top" title="<?php esc_html_e('Back to top','nautica'); ?>">
	<i class="fa fa-long-arrow-up"></i>
</a>
	<!-- #page -->
<?php wp_footer(); ?>
</body>
</html>