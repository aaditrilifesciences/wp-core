<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;

if(is_front_page()){
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
else{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$args['paged'] = $paged; 
$posts_per_page = $args['posts_per_page']; 

$loop = new WP_Query($args);

?>
<section class="widget  widget-style frontpage-posts section-blog layout-<?php echo esc_attr($layout); ?>  <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
    <?php
        if($title!=''){ ?>
            <h3 class="widget-title visual-title <?php echo esc_attr($size).' '.$alignment; ?>">
                <span><?php echo trim(esc_attr($title)); ?></span>
            </h3>
        <?php }
    ?>
    <div class="widget-content"> 
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

<div class="frontpage frontpage-v2">
<div class="row">
<?php

    $i = 0;
    $main = $num_mainpost;

    while($loop->have_posts()){
        $loop->the_post();
 ?>
        <?php if( $i<=$main-1) { ?>
            <?php if( $i == 0 ) {  ?>
                <div  class="col-sm-12 main-posts large">
            <?php } ?>
             <?php get_template_part( 'vc_templates/post/_single-fp-v1' ) ?>
                    
            <?php if( $i == $main-1 || $i == $end -1 ) { ?>
                </div>
            <?php } ?>
        <?php } else { ?>
                <?php if( $i == $main  ) { ?>
                <div class="col-sm-12 secondary-posts row space-20">
                <?php }  ?>
                    <div class=" col-sm-6">
                          <?php get_template_part( 'vc_templates/post/_single-v3' ) ?>
                    </div>
                <?php if( $i == $end-1 ) {   ?>
                    </div>
                <?php } ?>
            <?php } ?>
<?php  $i++; } ?>
</div>
</div>


    </div>
        <?php if( isset($show_pagination) && $show_pagination ): ?>
        <div class="w-pagination"><?php nautica_fnc_pagination_nav( $post_per_page,$loop->found_posts,$loop->max_num_pages ); ?></div>
        <?php endif ; ?>
</section>
<?php wp_reset_query(); ?>