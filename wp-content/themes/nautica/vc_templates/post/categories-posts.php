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

<div class="posts-inner">
<?php

	$i = 0;
	$main = 1;
	while($loop->have_posts()){
		$loop->the_post();
 ?>
 		<?php if( $i<=$main-1) { ?>
 			<?php if( $i == 0 ) {  ?>
 				<div class="posts-main">
 			<?php } ?>
 				<?php get_template_part( 'vc_templates/post/_categories-grid' ) ?>
			<?php if( $i == $main-1 || $i == $end -1 ) { ?>
				</div>
			<?php } ?>
		<?php } else { ?>
				<?php if( $i == $main  ) { ?>
				<div class="posts-more">
				<?php }  ?>
					<article class="post">
					    <?php
				        if (get_the_title()) {
				        ?>
				            <h4 class="entry-title">
				                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				            </h4>
				        <?php
				        }
				        ?>
					</article>
				<?php if( $i == $end-1 ) {   ?>
					</div>
				<?php } ?>
			<?php } ?>
<?php  $i++; } ?>
</div>