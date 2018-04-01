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

    $deals = array();
    $loop = nautica_fnc_woocommerce_query('deals', $number);
    $_id = nautica_fnc_makeid();
    $_count = 1;
    switch ($columns_count) {
        case '4':
            $class_column='col-sm-6 col-md-3';
            break;
        case '3':
            $class_column='col-sm-4';
            break;
        case '2':
            $class_column='col-sm-6';
            break;
        default:
            $class_column='col-sm-12';
            break;
    }

    

    $_total =  $loop->found_posts;  

    if( $loop->have_posts()  ) { ?>
 
    <?php
    //register countdown js
    wp_register_script( 'countdown_js', NAUTICA_THEME_URI.'/js/countdown.js', array( 'jquery' ) );
    wp_enqueue_script('countdown_js');
    ?>
    <div class="widget_deals_products widget widget_products <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
        <?php if($title!=''){ ?>
            <h3 class="widget-title title-primary">
                <span><?php echo esc_attr( $title ); ?></span> <?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
            </h3>
        <?php } ?>
        <div class="woocommerce woo-deals">

        <?php if($layout == 'carousel'):?>
            <div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content owl-carousel-play" data-ride="owlcarousel">   
              
                <?php if( $_total > $columns_count ) { ?>
                   <div class="carousel-controls carousel-controls-v3 carousel-hidden">
                        <a class="left carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
                                <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                <?php } ?>
                 <div class="owl-carousel rows-products" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="true">
                    <?php 
                         while ( $loop->have_posts() ) : $loop->the_post(); global $product;  
                             $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );

                       
                    ?>
            
                            <div class="item-product <?php if($_count%$columns_count==0) echo ' last'; ?>">
                                <div class="product-block">
                                    <figure class="image">
                                        <?php echo trim( $product->get_image('image-widgets') ); ?>
                                    </figure>

                                    <div class="caption">
                                        <div class="deals-information">
                                            <h3 class="name">
                                                <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo esc_attr( $product->get_title() ); ?></a>
                                            </h3>
                                            <div class="rating clearfix ">
                                                <?php if ( $rating_html = $product->get_rating_html() ) { ?>
                                                    <div><?php echo trim( $rating_html ); ?></div>
                                                <?php }else{ ?>
                                                    <div class="star-rating"></div>
                                                <?php } ?>
                                            </div>
                                            <div class="price"><?php echo trim( $product->get_price_html() ); ?></div>
                                        </div>
                                        <div class="time">
                                            <div class="sale-off">
                                                <?php
                                                $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
                                                    echo '-' . trim( $percentage ) . '%';
                                                 ?>
                                            </div>
                                            <?php if(   $time_sale ) {  ?>
                                            <div class="pts-countdown clearfix" data-countdown="countdown"
                                                 data-date="<?php echo date('m',$time_sale).'-'.date('d',$time_sale).'-'.date('Y',$time_sale).'-'. date('H',$time_sale) . '-' . date('i',$time_sale) . '-' .  date('s',$time_sale) ; ?>">
                                            </div>
                                            <?php } ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                <?php 
                        $_count++; 
                    endwhile; 
                ?>
               
                </div>
            </div>
            <?php elseif($layout == 'grid') : ?>
                 <div class="widget-content widget_products" id="<?php echo esc_attr($_id); ?>">
                    <div class="products-inner">
                        <?php     while ( $loop->have_posts() ) : $loop->the_post(); global $product;   
                          
                            $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );     
                        ?>
                        <?php if( $_count%$columns_count == 1 || $columns_count == 1 ) echo '<div class="item'.(($_count==1)?" active":"").'"><div class="row">'; ?>
                       
                                <div class="item-product <?php echo esc_attr( $class_column ); if($_count%$columns_count==0) echo ' last'; ?>">
                                    <div class="product-block">
                                        <figure class="image">
                                            <?php echo trim( $product->get_image('image-widgets') ); ?>
                                        </figure>

                                        <div class="caption">
                                            <div class="deals-information">
                                                <h3 class="name">
                                                    <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo esc_attr( $product->get_title() ); ?></a>
                                                </h3>
                                                <div class="rating clearfix ">
                                                    <?php if ( $rating_html = $product->get_rating_html() ) { ?>
                                                        <div><?php echo trim( $rating_html ); ?></div>
                                                    <?php }else{ ?>
                                                        <div class="star-rating"></div>
                                                    <?php } ?>
                                                </div>
                                                <div class="price"><?php echo trim( $product->get_price_html() ); ?></div>
                                            </div>
                                            <div class="time">
                                                <div class="sale-off">
                                                    <?php
                                                    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
                                                        echo '-' . trim( $percentage ) . '%';
                                                     ?>
                                                </div>
                                                <?php if( $time_sale ) { ?>
                                                <div class="pts-countdown clearfix" data-countdown="countdown"
                                                     data-date="<?php echo date('m',$time_sale).'-'.date('d',$time_sale).'-'.date('Y',$time_sale).'-'. date('H',$time_sale) . '-' . date('i',$time_sale) . '-' .  date('s',$time_sale) ; ?>">
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php if( ($_count%$columns_count==0 && $_count!=1) || $_count== $_total || $columns_count ==1 ) echo '</div></div>'; ?>
                    <?php 
                            $_count++; 
                        endwhile; 
                    ?>
                    <?php wp_reset_query(); ?>
                    </div>
                </div>     

            <?php endif ?>    
        </div>
    </div>
    <?php } ?>

     <?php wp_reset_query(); ?>
