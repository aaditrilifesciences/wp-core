<?php
/**
 * The canvas sidebar.
 *
 * @since   1.0.0
 * @package Valey
 */

if ( cs_get_option( 'canvas-sidebar' ) ) { ?>
	<div id="fx-canvas-sidebar" class="bgb ts__05 pf flex middle-xs column center-xs">
		<?php
			if ( is_active_sidebar( 'canvas-sidebar' ) ) {
				dynamic_sidebar( 'canvas-sidebar' );
			} else {
				printf( wp_kses_post( '<a target="_blank" href="%s">Add content to this position</a>', 'valey' ), esc_url( admin_url( 'widgets.php' ) ) );
			}
		?>
	</div><!-- #fx-canvas-sidebar -->
<?php } ?>
