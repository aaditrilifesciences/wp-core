<?php 
/** 
 * $loop
 * $class_column
 *
 */

$_count =1;

$colums = '3';
$bscol = floor( 12/$colums );
 
 $end = 4;
 
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
					<?php get_template_part( 'vc_templates/post/_single' ) ?>
				<?php if( $i == $end ) {   ?>
					</div>
				<?php } ?>
			<?php } ?>
<?php  $i++; } ?>
</div>