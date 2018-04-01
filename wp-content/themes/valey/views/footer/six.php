<?php
/**
 * The footer equal column template.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
<footer id="fx-footer" class="six pb__60">
	<div class="fx-container">
		<div class="fx-row">
			<div class="fx-col-md-2 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-1' ) ) {
						dynamic_sidebar( 'footer-1' );
					}
				?>
			</div>
			<div class="fx-col-md-4 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-2' ) ) {
						dynamic_sidebar( 'footer-2' );
					}
				?>
			</div>
			<div class="fx-col-md-2 fx-col-md-offset-1 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-3' ) ) {
						dynamic_sidebar( 'footer-3' );
					}
				?>
			</div>
			<div class="fx-col-md-2 fx-col-xs-12">
				<?php
					if ( is_active_sidebar( 'footer-4' ) ) {
						dynamic_sidebar( 'footer-4' );
					}
				?>
			</div>
			<div class="fx-col-md-1 fx-col-xs-12">
				<a id="fx-backtop" class="cw bgb db tc" href="#"><i class="fa fa-long-arrow-up"></i></a>
			</div>
		</div><!-- .fx-row -->
	</div><!-- .fx-container -->
</footer><!-- #fx-footer -->