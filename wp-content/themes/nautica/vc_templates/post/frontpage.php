<?php
/**
 * $loop
 * $class_column
 *
 */

$_count =1;

$colums = '3';
$bscol = floor( 12/$colums );
  $end = $loop->post_count;

?>

<div class="row">
<?php

	$i = 0;
	$main = 1;
	while($loop->have_posts()){
		$loop->the_post();
 ?>
 		<?php if( $i<=$main-1) { ?>
 			<?php if( $i == 0 ) {  ?>
 				<div class="col-sm-6">
 			<?php } ?>
		 	<?php get_template_part( 'vc_templates/post/_single' ) ?>

			<?php if( $i == $main-1 || $i == $end -1 ) { ?>
				</div>
			<?php } ?>
		<?php } else { ?>
				<?php if( $i == $main  ) { ?>
				<div class="col-sm-6">
				<?php }  ?>
					<article class="post">
					    <figure class="entry-thumb">
					        <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
					            <?php the_post_thumbnail('postthumb-grid');?>
					        </a>
					        <!-- vote    -->
                			<?php do_action('nautica_show_rating') ?>

					        <div class="entry-date">
					            <span><?php the_time( 'd' ); ?></span><?php the_time( 'M' ); ?>
					        </div>
					    </figure>
					    <h4 class="entry-title">
					        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </h4>
					    <p class="entry-description"><?php echo nautica_fnc_excerpt(25,'...');; ?></p>
					</article>
				<?php if( $i == $end-1 ) {   ?>
					</div>
				<?php } ?>
			<?php } ?>
<?php  $i++; } ?>
</div>