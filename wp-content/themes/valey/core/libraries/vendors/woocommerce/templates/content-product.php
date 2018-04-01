<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $fxshortcodes;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
$btnclass = '';

// Extra post classes
$classes = array();

// Product list columns
$columns = cs_get_option( 'wc-columns' );

$classes[] = $fxshortcodes['issc'] ? '' : 'fx-col-md-' . (int) $columns . ' fx-col-sm-6 fx-col-xs-12 mb__45';

// Get product hover style
$hover = $fxshortcodes ? $fxshortcodes['style'] : cs_get_option( 'wc-hover-style' );
if ( '1' == $hover ) {
	$btnclass = 'pa';
} else if ( '2' == $hover ) {
	$btnclass = 'pa flex tc center-xs';
} else {
	$btnclass = 'tc flex';
}
?>
<div <?php post_class( $classes ); ?>>

	<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	?>
		<div class="product-image pr style-<?php echo esc_attr( $hover ); ?>">
			<a class="db" href="<?php esc_url( the_permalink() ); ?>">
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			</a>
			<?php if ( '3' == $hover ) echo '<div class="pa w__100 action-bottom ts__03">'; ?>
			<div class="product-button <?php echo esc_attr( $btnclass ); ?>">
				<?php
					/**
					 * woocommerce_after_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div><!-- .product-button -->
			<?php if ( '2' == $hover ) : ?>
				<div class="pa w__100 ts__03">
					<?php
						/**
						 * woocommerce_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_product_title - 10
						 */
						do_action( 'woocommerce_shop_loop_item_title' );
					?>
					<div class="flex between-md between-sm between-xs">
						<?php
							/**
							 * woocommerce_after_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_rating - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );
						?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( '3' == $hover ) : ?>
				<div class="bgb pr">
					<?php
						/**
						 * woocommerce_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_product_title - 10
						 */
						do_action( 'woocommerce_shop_loop_item_title' );
					?>
					<div class="flex between-md between-sm between-xs">
						<?php
							/**
							 * woocommerce_after_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_rating - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );
						?>
					</div>
				</div>
			<?php endif; ?>
		<?php if ( '3' == $hover ) echo '</div>'; ?>
		</div><!-- .product-image -->

	<?php if ( '1' == $hover ) : ?>
		<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );
		?>
		<div class="flex between-md between-sm between-xs">
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	<?php endif; ?>
</div>
