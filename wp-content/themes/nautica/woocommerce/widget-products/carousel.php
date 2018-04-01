<?php

$_total = $loop->post_count;
$_count = 1;
$_id = nautica_fnc_makeid();
$_delay = 0.2;
$_this_delay = 0;
?>
<div id="carousel-<?php echo esc_attr($_id); ?>" class="text-center owl-carousel-play" data-ride="owlcarousel">         
    
        <?php if($posts_per_page>$columns_count && $_total>$columns_count){ ?>
            <div class="carousel-controls carousel-controls-v3 control-animate">
                <a class="left carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
                        <i class="fa fa-long-arrow-left"></i>
                </a>
                <a class="right carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
                        <i class="fa fa-long-arrow-right"></i>
                </a>
            </div>    
        <?php } ?>
         <div class="engo-product-columns <?php echo $button_type;?> product-columns-<?php echo esc_attr($columns_count); ?> owl-carousel row-products owl-col-<?php echo esc_attr($columns_count); ?>" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="false" <?php echo $slider_config;?>>
            <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                    <div class="product-wrapper animated wow fadeInUp"  data-wow-duration="1s" data-wow-delay="<?php echo $_this_delay;?>s">
                        <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                    </div>
            <?php
                $_this_delay = $_this_delay + $_delay;
                endwhile;
            ?>
        </div>
 
</div>    
<?php wp_reset_query(); ?>