<?php
/**
 * The footer equal column template.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
<footer id="fx-footer" class="three pb__60">
	<div class="fx-container">
		<div class="fx-row">
			<div class="fx-col-md-4">
				<?php
					if ( is_active_sidebar( 'footer-1' ) ) {
						dynamic_sidebar( 'footer-1' );
					}
				?>
			</div>
			<div class="fx-col-md-4">
				<?php
					if ( is_active_sidebar( 'footer-2' ) ) {
						dynamic_sidebar( 'footer-2' );
					}
				?>
			</div>
			<div class="fx-col-md-3 fx-col-md-offset-1">
				<?php
					if ( is_active_sidebar( 'footer-3' ) ) {
						dynamic_sidebar( 'footer-3' );
					}
				?>
			</div>
		</div><!-- .fx-row -->
	</div><!-- .fx-container -->
</footer><!-- #fx-footer -->