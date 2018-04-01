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
$time_sale = strtotime($end_date_countdown);

?>
<div class="widget_custom_deals widget widget_products <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
    <div class="item-product">
        <div class="product-block">
            <div  class="image">
                <div class="background-over animation-element engo-PullDown" style="background: <?php echo $background_color;?>"></div>
                <img class="animated" src="<?php echo esc_url_raw($img[0]);?>" alt="<?php echo esc_attr(esc_attr($title)); ?>" />
            </div>
            <div class="caption">
                <?php if($title!=''){ ?>
                <div class="deal-name">
                    <h3 class="widget-title">
                        <a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_attr($title); ?></a>
                    </h3>
                </div>
                <?php } ?>
                <div class="time">
                    <?php if(   $time_sale ) {  ?>
                        <div class="pts-countdown clearfix" data-countdown="countdown"
                             data-date="<?php echo date('m',$time_sale).'-'.date('d',$time_sale).'-'.date('Y',$time_sale).'-'. date('H',$time_sale) . '-' . date('i',$time_sale) . '-' .  date('s',$time_sale) ; ?>">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>



