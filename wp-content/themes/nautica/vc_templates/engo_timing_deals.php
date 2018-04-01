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
    extract( $atts );

    $days = $date_countdown > 0 ? $date_countdown:7;
    $enddays = (time()+ $days*24*60*60);
    if( $enddays < time())
        return;

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
   
        'posts_per_page' => 10,
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
            ),
            
            array(
                'key' => '_sale_price_dates_to',
                'value' => time(),
                'compare' => '>=',
                'type' => 'NUMERIC'
            ),
              
            array(
                'key' => '_sale_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC'
            )
        )
    );

 
    $loop = new WP_Query( $args );
    $_id = nautica_fnc_makeid();
    
    $_total  = $loop->found_posts;
 

    $words = explode(" ", esc_attr($title) ) ;
    if( count($words) > 1 ){
        $title = '<span>'.($words[0]).'</span>';
        unset($words[0]);
        $title .=' '. implode(' ', $words);
    }    
    ?>

    <?php     if ( $loop->have_posts() ) { ?> 
    <div class="widget-timing-deal bg-danger <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
       
        <div class="woocommerce woo-deals  clearfix">
                <div class="col-lg-3 col-md-4">
                    <div class="widget-heading text-white">
                        <?php if( !empty($description) ){ ?>
                        <p><?php echo trim( $description ); ?></p>
                        <?php } ?>
                         <?php if($title!=''){ ?>
                            <h3 class="text-white">
                               <?php echo trim( $title ); ?>
                            </h3>
                        <?php } ?>
                        <div class="countdown-wrapper">
                            <div class="pts-countdown clearfix" data-countdown="countdown"
                                 data-date="<?php echo date('m',$enddays).'-'.date('d',$enddays).'-'.date('Y',$enddays).'-'. date('H',$enddays) . '-' . date('i',$enddays) . '-' .  date('s',$enddays) ; ?>">
                            </div>
                        </div>
                     </div>
                </div>
                <?php if( !empty($columns_count) ){ ?>
                <div class="col-lg-9 col-md-8 woo-products-deals bg-white">    
                        <div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content owl-carousel-play" data-ride="owlcarousel">  
                             <?php if($_total>$columns_count){ ?>
                               <div class="carousel-controls carousel-controls-v3 carousel-hidden">
                                    <a class="left carousel-control carousel-xs radius-2x" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
                                            <span class="fa fa-angle-left"></span>
                                    </a>
                                    <a class="right carousel-control carousel-xs radius-2x" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
                                            <span class="fa fa-angle-right"></span>
                                    </a>
                                </div>  
                            <?php } ?>
                             <div class="owl-carousel rows-products" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="true">
                               <?php 
                                 while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                   <?php wc_get_template_part( 'content', 'product-deal' ); ?>
                                <?php  endwhile;  ?>
                                <?php wp_reset_query(); ?>
                            </div>
                        </div>
                </div>  
                 <?php } ?>  
        </div>
    </div>
    <?php   }  ?>