<?php
/**
 * The template part for displaying content.
 * 
 * @since   1.0.0
 * @package Valey
 */
?>
<?php do_action( 'fx_before_post' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb__50 pb__30' ); ?>>
	<?php fx_valey_posted_on(); ?>
	<?php fx_valey_post_title(); ?>
	<?php fx_valey_post_meta(); ?>
	<?php fx_valey_post_thumbnail(); ?>
	
	<div class="post-content">
		<?php
			the_content( sprintf(
				__( 'Continue reading %s', 'valey' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		?>
	</div><!-- .post-content -->
</article><!-- #post-# -->
<?php do_action( 'fx_after_post' ); ?>