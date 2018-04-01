<?php
/**
 * The footer equal column template.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
<footer id="fx-footer" class="equal pb__60">
	<div class="fx-container pr__10 pl__10">
		<div class="fx-row">
			<div class="fx-col-md-3 fx-col-sm-6 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-1' ) ) {
						dynamic_sidebar( 'footer-1' );
					}
				?>
			</div>
			<div class="fx-col-md-3 fx-col-sm-6 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-2' ) ) {
						dynamic_sidebar( 'footer-2' );
					}
				?>
			</div>
			<div class="fx-col-md-3 fx-col-sm-6 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-3' ) ) {
						dynamic_sidebar( 'footer-3' );
					}
				?>
			</div>
			<div class="fx-col-md-3 fx-col-sm-6 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-4' ) ) {
						dynamic_sidebar( 'footer-4' );
					}
				?>
			</div>
		</div><!-- .fx-row -->
	</div><!-- .fx-container -->
</footer><!-- #fx-footer -->