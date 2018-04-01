<?php
/**
 * $loop
 * $class_column
 *
 */

$_count =1;
$colums = '3';
$bscol = 12;

?>

<div class="posts-list">
<?php
    $i = 0;
    while($loop->have_posts()){
    $loop->the_post();
?>
    <?php get_template_part( 'vc_templates/post/_single') ?>
<?php  } ?>
</div>