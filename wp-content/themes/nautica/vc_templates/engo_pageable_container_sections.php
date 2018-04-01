<?php
/**
 * Created by PhpStorm.
 * User: ManhTienpt
 * Date: 11/19/2015
 * Time: 8:33 AM

**
* Shortcode attributes
* @var $atts
* @var $content - shortcode content
* @var $this WPBakeryShortCode_VC_Tta_Section
*/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);
$shortcode_pattern = get_pattern($content);
$_id = nautica_fnc_makeid();
if($columns == 'custom_responsive') {
    $class_column = "col-lg-".(12/$columns_lg)." col-md-".(12/$columns_md)." col-sm-".(12/$columns_sm)." col-xs-".(12/$columns_xs);
    $slider_config = "data-lg='$columns_lg' data-md='$columns_md' data-sm='$columns_sm' data-xs='$columns_xs'";
    $columns_count = $columns_lg;
} else {
    $class_column = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
    $slider_config = "data-lg='6' data-md='4' data-sm='3' data-xs='2'";
    $columns_count = $columns;
}
?>
<div class="widget widget_products <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
        <?php if($title!=''){ ?>
    <h3 class="widget-title title-primary">
        <span><?php echo esc_attr( $title ); ?></span> <?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
    </h3>
<?php } ?>
<div class="engo_pageable_container">
    <?php if($style == 'carousel'):?>
        <div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content owl-carousel-play" data-ride="owlcarousel">
            <?php if( $number > $columns_count ) { ?>
                <?php
                    if($carousel_control_effect == 'animate') {
                        ?>
                        <div class="carousel-controls carousel-controls-v3 carousel-hidden control-animate">
                            <a class="left carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                            </a>
                            <a class="right carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="carousel-controls carousel-controls-v3 carousel-hidden control-fixed">
                            <a class="left carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
                                <span class="fa fa-long-arrow-left"></span>
                            </a>
                            <a class="right carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="next">
                                <span class="fa fa-long-arrow-right"></span>
                            </a>
                        </div>
                        <?php
                    }
                ?>
            <?php } ?>
            <div class="owl-carousel rows-products" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="true" data-navigation="true" <?php echo $slider_config;?>>
                <?php
                foreach($shortcode_pattern[5] as $item_container) {
                    echo do_shortcode($item_container);
                }
                ?>
            </div>
        </div>
    <?php endif ?>
</div>
</div>