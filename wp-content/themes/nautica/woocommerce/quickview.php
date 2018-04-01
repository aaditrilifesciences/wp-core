<?php
/* $Desc
 *
 * @version    jQueryIdjQuery
 * @package    wpbase
 * @author     EngoTheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row detail-product-v2 engo-product-detail product-block product-info woocommerce"  id="single-product">
		<div class="col-sm-6">
			<div class="quickview-images">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="summary entry-summary">
				<?php

				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				remove_action('nautica_woocommerce_quantity','nautica_single_product_variation_quantity', 10);

				remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);

				remove_action('nautica_woocommerce_actions_after_add_to_cart_button','nautica_compare_button_show', 40);

				add_action('nautica_woocommerce_actions_before_add_to_cart_button','nautica_single_product_variation_quantity', 15);

				remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

				do_action('woocommerce_single_product_summary');
				nautica_fnc_single_social_share($product->get_permalink());
				?>
			</div><!-- .summary -->
		</div>
	</div>
</div><!-- #product-<?php the_ID(); ?> -->
<script>
	/** Engo product quantity **/
	if( jQuery( '.quantity','#engo-quickview-modal' ).length > 0 ) {
		var form_cart = jQuery( 'form .quantity' );

		jQuery(form_cart ).each(function(){
			var this_prod = jQuery(form_cart).attr("data-product");
			var this_add_to_cart_btn = jQuery(".add_to_cart_button[data-product_id='"+this_prod+"']");

			jQuery(this).prepend( '<span class="minus"><i class="fa fa-minus-square-o"></i></span>' );
			jQuery(this).append( '<span class="plus"><i class="fa fa-plus-square-o"></i></span>' );



			var minus = jQuery(this).find( jQuery( '.minus' ) );
			var plus  = jQuery(this).find( jQuery( '.plus' ) );
			var min_order = parseInt(jQuery(this).find( '.qty' ).attr('min'));
			var max_order = parseInt(jQuery(this).find( '.qty' ).attr('max'));

			minus.on( 'click', function(){
				var qty = jQuery( this ).parent().find( '.qty' );
				if ( qty.val() <= min_order ) {
					qty.val(1);
					this_add_to_cart_btn.attr("data-quantity",1);
				} else {
					qty.val( ( parseInt( qty.val() ) - 1 ) );
					this_add_to_cart_btn.attr("data-quantity",( parseInt( qty.val() ) ));
				}
			});
			plus.on( 'click', function(){
				var qty = jQuery( this ).parent().find( '.qty' );
				if ( qty.val() >= max_order ) {
					qty.val( max_order );
					this_add_to_cart_btn.attr("data-quantity",max_order);
				} else {
					qty.val( ( parseInt( qty.val() ) + 1 ) );
					this_add_to_cart_btn.attr("data-quantity",( parseInt( qty.val() ) ));
				}
			});
		});
	}
</script>
