<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<div class="product-signle-options variations clearfix">
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<div class="selector-wrapper">
					<label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label>
					<?php
					$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
					wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product,'show_option_none' => '--Select option--', 'class' => 'single-option-selector', 'selected' => $selected ) );
					echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . esc_html__( 'Clear selection', 'woocommerce' ) . '</a>' : '';
					?>
				</div>
			<?php endforeach;?>
				<?php
				/**
				 * engo_woocommerce_variation hook. Used to output the quantity box.
				 *
				 * @hooked engo_single_variation_quantity
				 */
				do_action( 'nautica_woocommerce_quantity' );
				?>
		</div>
		<div class="product-single-action single_variation_wrap">
			<?php
				do_action( 'nautica_woocommerce_actions_before_add_to_cart_button' );

				do_action( 'woocommerce_before_single_variation' );
				do_action( 'nautica_woocommerce_variation' );
				do_action( 'woocommerce_after_single_variation' );

				do_action( 'nautica_woocommerce_actions_after_add_to_cart_button' );
			?>
			<div class="clearfix"></div>
		</div>


		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>


		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
