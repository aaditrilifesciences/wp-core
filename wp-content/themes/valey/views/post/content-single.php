<?php
/**
 * The template part for displaying single posts.
 * 
 * @since   1.0.0
 * @package Valey
 */
?>
<?php do_action( 'fx_before_single_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="tc pt__55">
		<?php
			if ( cs_get_option( 'post-time' ) ) {
				fx_valey_posted_on();
			}
				
			fx_valey_post_title( $link = false );
			
			if ( cs_get_option( 'post-meta' ) ) {
				fx_valey_post_meta();
			}
		?>
	</div><!-- .tc -->

	<?php fx_valey_post_thumbnail(); ?>
	
	<div class="post-content">
		<?php
			the_content( sprintf(
				__( 'Continue reading %s', 'valey' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		?>
	</div>
</article><!-- #post-# -->
<?php do_action( 'fx_after_single_post' ); ?>