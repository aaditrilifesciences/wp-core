<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->id ), 'blog-thumbnails' );

?>
<div class="product-block" data-product-id="<?php echo esc_attr($product->id); ?>">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4">
		    <div class="image">
				<div class="img-rotate">
		        <?php woocommerce_show_product_loop_sale_flash(); ?>
		        <a title="<?php the_title(); ?>" href="<?php echo (get_option( 'woocommerce_enable_lightbox' )=='yes' && is_product()) ? $image_attributes[0] : the_permalink(); ?>" class="product-image image-hover <?php echo (get_option( 'woocommerce_enable_lightbox' )=='yes' &&  is_product())?'zoom':'zoom-2' ;?>">
		            <figure>
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
					</figure>
		        </a>
				</div>
		    </div>
		</div>    
	    <div class="col-lg-8 col-md-8">
		    <div class="caption-list">
		        
		        <div class="meta">

		         <h3 class="name"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
		            <?php
		                /**
		                * woocommerce_after_shop_loop_item_title hook
		                *
		                * @hooked woocommerce_template_loop_rating - 5
		                * @hooked woocommerce_template_loop_price - 10
		                */
		                do_action( 'woocommerce_after_shop_loop_item_title');

		            ?>
		            <p><?php echo  the_excerpt();  ?></p>
					<div class="actions-button">
						<div class="action-add-to-cart">
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</div>
						<div class="action-bottom clearfix">
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

		        </div>
		        
		    </div>
		</div>    
	</div>	    
</div>
