<?php

/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Engotheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract($atts);

$img = wp_get_attachment_image_src($photo,'full');
?>
<div class="widget_product_intro widget widget_products <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
    <div class="item-product">
        <div class="product-block">
            <div  class="image">
                <div class="background-over" style="background: <?php echo $background_color;?>"></div>
                    <img src="<?php echo esc_url_raw($img[0]);?>" alt="<?php echo esc_attr($title); ?>" />
            </div>
            <div class="caption">
                <?php if($title!=''){ ?>
                <div class="deal-name">
                    <h3 class="widget-title">
                        <a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_attr($title); ?></a>
                    </h3>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>



