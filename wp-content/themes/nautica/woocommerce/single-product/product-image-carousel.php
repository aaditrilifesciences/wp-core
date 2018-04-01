<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     EngoTheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2014 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
$_images =array();
if(has_post_thumbnail()){
	$_images[] = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
}else{
	$_images[] = '<img src="'.wc_placeholder_img_src().'" alt="'.esc_html__( 'Placeholder', 'woocommerce' ).'" />';
}
foreach ($attachment_ids as $attachment_id) {
	$_images[]       = wp_get_attachment_image( $attachment_id, 'shop_single' );
}
?>
<div id="quickview-carousel" class="carousel slide" data-ride="carousel">
	<?php if(count($_images)>1){ ?>
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php foreach ($_images as $key => $image) {
			echo '<li data-target="#quickview-carousel" data-slide-to="'.$key.'" '.(($key==0)?'class="active"':'').'></li>';
		} ?>
	</ol>
	<?php } ?>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php foreach ($_images as $key => $image) { ?>
		<div class="item<?php echo (($key==0)?' active':'') ?>">
			<?php echo $image; ?>
		</div>
		<?php } ?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#quickview-carousel" data-slide="prev">
		<span class="fa fa-angle-left"></span>
	</a>
	<a class="right carousel-control" href="#quickview-carousel" data-slide="next">
		<span class="fa fa-angle-right"></span>
	</a>
</div>


