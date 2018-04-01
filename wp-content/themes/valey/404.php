<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @since   1.0.0
 * @package Valey
 */

wp_head(); ?>

<div id="fx-content-404" class="flex middle-md center-md cb fwb pr tu">
	<div class="z__2">
		<h1 class="mg__0">404</h1>
		<h5 class="mg__0">
			<?php
				if ( cs_get_option( 'not-found-content' ) ) {
					echo sprintf( wp_kses_post( '%s', 'valey' ), cs_get_option( 'not-found-content' ) );
				} else {
					echo apply_filters( 'fx_content_404', 'Nice! You have found the real valey', 'valey' );
				}
			?>
		</h5>
		<h4 class="fs__14 mg__0 ls__1"><a class="cb chp pa db" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Go Back', 'valey' ); ?></a></h4>
	</div>
</div><!-- #fx-content-404 -->
<?php wp_footer();