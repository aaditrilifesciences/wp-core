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
    global $wp_query; 

    function nautica_woocommerce_before_shop_loop_item_title(){

        global $product;

        if( $product->regular_price ){
            $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
            echo '<span class="product-sale-label">-' . trim( $percentage ) . '%</span>';
        }
                                                
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'nautica_woocommerce_before_shop_loop_item_title');
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );


     
    $deals = array();

    $loop = nautica_fnc_woocommerce_query('on_sale', $number);
    $wp_query = $loop;

    $_id = nautica_fnc_makeid();
    $_count = 1;
 
    $_total =  $loop->found_posts;  

    $layout= 'product';


    if( $loop->have_posts()  ) { ?>
        <div class="woocommerce products woo-onsale"> 


    <div id="engo-filter" class="clearfix">
       <?php Newshoping_ENGO_Woocommerce::renderButton(); ?>

        <?php
            /**
             * woocommerce_before_shop_loop hook
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
             //woocommerce_show_messages();
          woocommerce_catalog_ordering();
        ?>
    </div>
     <?php
        $style = nautica_fnc_theme_options('wc_listgrid', 'product');

        if (isset($_COOKIE['engo_cookie_layout']) && $_COOKIE['engo_cookie_layout']== 'product') {
            $layout = 'product';
        }elseif (isset($_COOKIE['engo_cookie_layout']) && $_COOKIE['engo_cookie_layout']== 'list') {
            $layout = 'product-list';
        }else{
            $layout = $style;
        }
    ?>
                <div class="products-layout row-products row">
                    <?php     while ( $loop->have_posts() ) :   the_post();  global $product;   
                      
                        $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );
                    ?>
                    <?php if( $_count%$columns_count == 1 || $columns_count == 1 ) ?>
                         <?php
                            wc_get_template_part( 'content', $layout );
                        ?>
                <?php 
                        $_count++; 
                    endwhile; 
                ?>
              </div>
                <div class="clearfix"></div>
                <div class="widget clearfix product-bottom">
                	<?php echo nautica_fnc_woocommerce_pagination( $number, $_total ); ?>
                </div>
                <?php wp_reset_query(); ?>
              
    
        </div>
 
    <?php } ?><?php wp_reset_query(); ?>
