<?php
/**
 * The footer equal column template.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
<footer id="fx-footer" class="center pb__60">
	<div class="fx-container">
		<div class="flex column center-xs">
			<?php
				if ( is_active_sidebar( 'footer-1' ) ) {
					dynamic_sidebar( 'footer-1' );
				}
			?>
		</div><!-- .fx-row -->
	</div><!-- .fx-container -->
</footer><!-- #fx-footer -->