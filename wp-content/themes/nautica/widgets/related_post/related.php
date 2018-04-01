<?php
global $post;
$_id = nautica_fnc_makeid();
$grid_columns = 3;
$tags = wp_get_post_tags($post->ID);
if ($tags) {
    $tag_ids = array();
    foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 6
    );

$my_query = new WP_Query($args);
if(  empty($layout) ){
    $layout = 'blog';
}

$countposts = $args ['posts_per_page'];
?>

<section class="widget widget-style post blog-type">
    <h3 class="widget-title widget-heading-main">
        <span><span> <?php esc_html_e('Related post', 'nautica'); ?></span></span>
    </h3>

    <div class="widget-content">
        <div class="row">
            <div id="carousel-<?php echo esc_attr($_id); ?>" class="text-center owl-carousel-play" data-ride="owlcarousel">
                <div class="owl-carousel row-products owl-col-<?php echo esc_attr($grid_columns); ?>" data-slide="<?php echo esc_attr($grid_columns); ?>" data-pagination="false" data-navigation="false" data-lg='3' data-md='2' data-sm='1' data-xs='1'>
                    <?php $i=0; while ( $my_query->have_posts() ): $my_query->the_post(); ?>
                            <?php get_template_part( 'widgets/related_post/_related-v1' ); ?>
                        <?php if( ++$i== $countposts){ break; } ?>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<?php } ?>