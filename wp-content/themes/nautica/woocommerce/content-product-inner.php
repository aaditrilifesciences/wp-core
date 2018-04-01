<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->id ), 'blog-thumbnails' );

?>
<div class="product-block" data-product-id="<?php echo esc_attr($product->id); ?>">
    <div class="image">
        <?php woocommerce_show_product_loop_sale_flash(); ?>
        <div class="img-rotate">
            <a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" class="image-hover">
                        <?php
                            /**
                             * woocommerce_before_shop_loop_item_title hook
                             *
                             * @hooked woocommerce_show_product_loop_sale_flash - 10
                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                             */
                            remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);

                            do_action( 'woocommerce_before_shop_loop_item_title' );
                            ?>

            </a>
        </div>
        <div class="button-action button-groups clearfix">  
            <?php woocommerce_template_loop_add_to_cart();?>         
            <div class="wishlist-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e('Add to wishlist', 'nautica');?>">
                <?php
               if( class_exists( 'YITH_WCWL' ) ) {
                   echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
               }
           ?>
            </div>
            <?php if(nautica_fnc_theme_options('is-quickview', true)){ ?>
            <div class="quick-view" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e('Quick view', 'nautica');?>">
                <a href="#" class="quickview" data-productslug="<?php echo trim($product->post->post_name); ?>"  data-toggle="modal" data-target="#engo-quickview-modal">
                   <span><i class="btn-icons quickview-icon"></i></span>
                </a>
            </div>
           <?php } ?>       
        </div>

    </div>

        <?php woocommerce_template_loop_rating();?> 

        <div class="caption">

            <div class="meta">

             <h3 class="name"><a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                <?php
                remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
                    /**
                    * woocommerce_after_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_template_loop_rating - 5
                    * @hooked woocommerce_template_loop_price - 10
                    */
                    do_action( 'woocommerce_after_shop_loop_item_title');

                ?>

            </div>    

        </div>
</div>
