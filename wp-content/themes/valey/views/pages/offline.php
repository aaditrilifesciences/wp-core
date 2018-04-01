<?php
/**
 * The template for displaying maintenance mode.
 *
 * @since   1.0.1
 * @package Valey
 */

// Get the time
$date  = cs_get_option( 'maintenance-date' );
$month = cs_get_option( 'maintenance-month' );
$year  = cs_get_option( 'maintenance-year' );
$time  = $year . '/' . $month . '/' . $date;

wp_head(); ?>

<div class="fx-offline pr">
	<div class="pr">
		<div class="top">
			<a class="dib" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
					if ( ! empty( cs_get_option( 'logo' ) ) ) :
						$logo = wp_get_attachment_image_src( cs_get_option( 'logo' ), 'full', true );

						echo '<img src="' . esc_url( $logo[0] ) . '" width="' . esc_attr( $logo[1] ) . '" height="' . esc_attr( $logo[2] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
					else :
						echo '<img src="' . FX_VALEY_URL . '/assets/images/logo.png' . '" width="88" height="15" alt="' . get_bloginfo( 'name' ) . '" />';
					endif;
				?>
			</a>
		</div><!-- .top -->
		<div class="middle tc pr">
			<h1 class="cw tu fwb ls__2 mb__5"><?php echo sprintf( __( '%s', 'valey' ), cs_get_option( 'maintenance-title' ) ) ?></h1>
			<p class="mb__50"><?php echo sprintf( wp_kses_post( '%s', 'valey' ), cs_get_option( 'maintenance-message' ) ) ?></p>
			<div id="countdown" class="flex"></div>
		</div><!-- .middle -->
		<div class="bottom flex pa w__100 between-xs end-xs">
			<?php echo fx_valey_social(); ?>
			<div class="oh cw f__mont fs__14"><?php echo sprintf( wp_kses_post( '%s', 'valey' ), cs_get_option( 'maintenance-content' ) ); ?></div>
		</div><!-- .bottom -->
	</div>
</div><!-- .fx-offline -->
<script src="<?php echo FX_VALEY_URL . '/assets/vendors/jquery-countdown/jquery.countdown.min.js'; ?>"></script>
<script>
	(function( $ ) {
		"use strict";

		$( document ).ready( function() {
			$( '#countdown' ).countdown( '<?php echo esc_js( $time ); ?>', function( e ) {
				$(this).html( e.strftime( '<div class="date pr"><span class="number f__mont cw db">%D</span><span class="text"><?php echo esc_html__( 'Days', 'valey' ); ?></span></div><div class="hour pr"><span class="number f__mont cw db">%H</span><span class="text"><?php echo esc_html__( 'Days', 'valey' ); ?></span></div><div class="min pr"><span class="number f__mont cw db">%M</span><span class="text"><?php echo esc_html__( 'Days', 'valey' ); ?></span></div><div class="second pr"><span class="number f__mont cw db">%S</span><span class="text"><?php echo esc_html__( 'Days', 'valey' ); ?></span></div>'
				));
			});
		});

	})( jQuery );
</script>