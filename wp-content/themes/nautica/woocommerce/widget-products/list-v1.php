<?php $_delay = 150; ?>
<div class="product_list_v1_widget">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<!-- Content product-->
		<?php global $product; ?>

		<?php
			$class=$attrs='';
			if(isset($animate) && $animate){
				$class= 'wow fadeInUp';
				//$attrs = 'data-wow-duration="0.6s" data-wow-delay="'.$delay.'ms"';
			}
		?>

			<div class="media product-block widget-product <?php echo esc_attr($class); ?> <?php echo (isset($item_order) && ($item_order%2)) ?'first':'last'; ?> " <?php echo $attrs; ?>>
				<?php if((isset($item_order) && $item_order==1) || !isset($item_order)) : ?>
					<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>" class="image pull-left">
						<?php echo $product->get_image(); ?>
						<?php if(isset($item_order) && $item_order==1) { ?> 
							<span class="first-order"><?php echo trim($item_order); ?></span>
						<?php } ?>
					</a>
				<?php endif; ?>
				<?php if(isset($item_order) && $item_order > 1){ ?>
					<div class="order"><span><?php echo trim($item_order); ?></span></div>
				<?php }?>
				<div class="media-body">
					<div class="caption">
						<h3 class="name">
							<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a>
						</h3>

						<div class="rating clearfix">
				            <?php if ( ! empty( $show_rating ) ){
				            	if($rating_html = $product->get_rating_html()){
				            		echo $product->get_rating_html();
				            	}else{
				            		echo '<div class="star-rating"></div>';
				            	}
				            } ?>
				        </div>

						<div class="price"><?php echo nautica_fnc_price($product->get_price_html()); ?></div>
						<div class="action-bottom">
			                <div class="action-bottom-wrap">
			                    <div class="button-groups add-button clearfix">
			                        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			                        <?php
			                            $action_add = 'yith-woocompare-add-product';
			                            $url_args = array(
			                                'action' => $action_add,
			                                'id' => $product->id
			                            );
			                        ?>
			                    </div>
			                </div>    

			            </div>
			        </div>
				</div>
			</div>
		<!--End content -->
		<?php $_delay+=200; ?>
	<?php endwhile; ?>
</div>
<?php wp_reset_query(); ?>