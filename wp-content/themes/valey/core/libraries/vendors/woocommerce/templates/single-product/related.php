<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 999,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>
	<div class="related product-extra mt__100">
		<div class="fx-container">
			<h2 class="head__2 tc tu pr mg__0 mb__55"><?php _e( 'Related Products', 'valey' ); ?></h2>
			<div class="owl-carousel">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<div class="mb__45">
						<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
						
						<div class="pr oh">
							<a class="db" href="<?php esc_url( the_permalink() ); ?>">
								<?php
									/**
									 * woocommerce_before_shop_loop_item_title hook
									 *
									 * @hooked woocommerce_show_product_loop_sale_flash - 10
									 * @hooked woocommerce_template_loop_product_thumbnail - 10
									 */
									do_action( 'woocommerce_before_shop_loop_item_title' );
								?>
							</a>
							<div class="pa info bgb ts__03">
								<?php
									/**
									 * woocommerce_shop_loop_item_title hook
									 *
									 * @hooked woocommerce_template_loop_product_title - 10
									 */
									do_action( 'woocommerce_shop_loop_item_title' );
								?>
								<div class="flex between-md between-sm between-xs">
									<?php
										/**
										 * woocommerce_after_shop_loop_item_title hook
										 *
										 * @hooked woocommerce_template_loop_rating - 5
										 * @hooked woocommerce_template_loop_price - 10
										 */
										do_action( 'woocommerce_after_shop_loop_item_title' );
									?>
								</div><!-- .flex -->
							</div>
						</div><!-- .product-image -->
					</div>

				<?php endwhile; // end of the loop. ?>
			</div><!-- .owl-carousel -->
		</div><!-- .fx-container -->
	</div><!-- .related -->
<?php endif;

wp_reset_postdata();
