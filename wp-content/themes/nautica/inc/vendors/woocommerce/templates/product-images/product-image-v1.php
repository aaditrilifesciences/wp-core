<?php
/**
 * Single Product Thumbnails
 *
 * @author      EngoTheme
 * @package     Engoplugin/Templates/WooCommerce
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $product, $woocommerce;

$images = $product->get_gallery_attachment_ids();

$attachment_ids =  array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
$_id = engotheme_fnc_makeid();

if ( $attachment_ids ) {
	$columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 1 );
	?>
	<div id="owl-product-image-<?php echo $_id;?>" class="owl-product-image">
		<?php
		$images_link = array();
		foreach ( $attachment_ids as $attachment_id ) {
			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image_title    = esc_attr( get_the_title( $attachment_id ) );
			$image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
				'title' => $image_title,
				'alt'   => $image_title
			) );

			/**For gallery**/
			$images_link[] = '"'.$image_link.'"';


			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a class="gallery-item" href="javascript://" title="%s">%s<i class="click-to-gallery"></i></a>', $image_caption, $image  ), $attachment_id, $post->ID);
		}
		$images_link = implode(',',$images_link);


		?>

	</div>
	<div class="clearfix"></div>
	<div id="owl-product-thumb-<?php echo $_id;?>">
		<?php do_action( 'woocommerce_product_thumbnails'); ?>
	</div>
	<?php
}
?>

<script type="text/javascript">
	jQuery( document ).ready( function() {
		"use strict";
		var api_images = [<?php echo $images_link;?>],
			slide_show = $("#owl-product-image-<?php echo $_id;?>"),
			slide_thumb = $(".owl-product-thumbs","#owl-product-thumb-<?php echo $_id;?>");

		$("a[rel^='prettyPhoto']").prettyPhoto();

		slide_show.owlCarousel({
			items:1,
			loop:true,
			slideBy: 1,
			dotData: true,
			onInitialized : init_click_scroll,
			onChanged: this_zoom,
			onRefreshed: this_zoom

		});
		var owl_slide = slide_show.data('owlCarousel');
		build_gallery();
		function this_zoom() {
			var current = this._current;
			$(slide_show).find(".owl-item").eq(current).hover(
				function () {
					$(this).zoom({on:'click'});
				},
				function () {
					$(this).trigger('zoom.destroy');
				}
			);
		}
		function init_click_scroll() {
			slide_show.css('visibility','visible');
			$('.owl-item', slide_show).not('.cloned').each(function(index) {
				$(this).click(function(){
					owl_slide.to(index);
				});
			});
		}
		function build_gallery(){
			$(".click-to-gallery").click(function(){
				$.prettyPhoto.open(api_images);
			});

		}
		function cancel_gallery() {
			$(".click-to-gallery").unbind();
			$.prettyPhoto.close();
		}
		slide_thumb.owlCarousel({
			autoPlay: false,
			items : 4,
			nav: true,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			dots: false,
			onInitialized : function(){
				slide_thumb.css("visibility","visible");
			},
		});
		$('.owl-item', slide_thumb).not('.cloned').each(function(index) {
			$(this).click(function(){
				owl_slide.to(index);
			})
		});
	});
</script>
