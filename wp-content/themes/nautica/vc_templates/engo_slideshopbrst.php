<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );  
extract( $atts );
if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;
 
if( is_front_page() ){
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}   
else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}

$args['paged'] = $paged; 
$posts_per_page = $args['posts_per_page']; 

$loop = new WP_Query($args);

 
$columgrid = floor(12/$grid_columns);
if(  empty($layout) ){
    $layout = 'blog';
}
$id = rand();
$countposts = $args ['posts_per_page'];
?>


<section class="widget slideshowpost blog-type <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
    <?php if( $title ) { ?>
        <h3 class="widget-title <?php echo esc_attr($size).' '.$alignment; ?>">
           <span><?php echo esc_attr($title); ?></span>
            <?php if(trim($descript)!=''){ ?>
                <span class="widget-desc">
                    <?php echo esc_html($descript); ?>
                </span>
            <?php } ?>
        </h3>
    <?php } ?>

    <div class="widget-content">
        <div class="owl-carousel-play">
           <div class="owl-carousel" data-slide="<?php echo esc_attr($grid_columns); ?>"  data-singleItem="true" data-navigation="true">
            <?php $i=0; while ( $loop->have_posts() ): $loop->the_post(); ?>
                <div class="item">
                    <?php get_template_part( 'vc_templates/post/slideshow' ); ?>
                </div>
       
              <?php if( ++$i== $countposts){ break; } ?>
            <?php endwhile; ?>
            </div>
            <a class="left carousel-control carousel-xs radius-x" href="#post-slide-<?php $id; ?>" data-slide="prev">
                <span class="fa fa-angle-left"></span>
            </a>
            <a class="right carousel-control carousel-xs radius-x" href="#post-slide-<?php $id; ?>" data-slide="next">
                <span class="fa fa-angle-right"></span>
            </a>

        </div>

        <?php if( isset($show_pagination) && $show_pagination ): ?>
        <div class="w-pagination"><?php nautica_fnc_pagination_nav( $post_per_page,$loop->found_posts,$loop->max_num_pages ); ?></div>
        <?php endif ; ?>
    </div>
</section>
<?php wp_reset_query();

