<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     EngoTheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$_id = nautica_fnc_makeid();

?>
<div class="widget widget-brand-logo<?php echo (($el_class!='')?' '.$el_class:''); ?>">
<?php if(!empty($title)){ ?>
	<h4 class="widget-title-v2 text-center">
		<span><?php echo trim(esc_attr($title)); ?></span>
		<?php if(trim($descript)!=''){ ?>
			<span class="widget-desc">
		                <?php echo trim(esc_html($descript)); ?>
		            </span>
		<?php } ?>
	</h4>
<?php } ?>

	<div class="widget-content">
<div class="widget-brands-inner owl-carousel-play" id="productcarouse-<?php echo esc_attr($_id); ?>" data-ride="carousel">
<?php

if($images) {
	$img_arr = explode(",",$images);
	?>
	<div class="owl-carousel" data-autoPlay="true" data-time="3000" data-loop="true" data-slide="6" data-navigation="false" data-pagination="false" data-lg="6" data-md="6" data-sm="3" data-xs="2">
		<?php
			foreach($img_arr as $image) {
			$img = wp_get_attachment_image_src($image);
		?>
			<div class="item-type image-gallery">
				<div class="item-brand text-center">
					<img src="<?php echo $img[0]; ?>"/>
				</div>
			</div>
		<?php } ?>
	</div>
		<?php

} else {
?>

<?php
	$args = array(
			'post_type' => 'brands',
			'posts_per_page'=> 100
	);
	$loop = new WP_Query($args);
	if ( $loop->have_posts() ) :
		$_count = 1;
		?>
				<div class="owl-carousel" data-autoPlay="true" data-time="3000" data-loop="true" data-navigation="false" data-slide="6" data-pagination="false"  data-lg="6" data-md="6" data-sm="3" data-xs="2">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php   echo '<div class="item-type">'; ?>
						<?php
							$link = get_post_meta(get_the_ID(),'brands_brand_link',true);
							$link = $link ? $link : '#';
						?>
						<!-- Product Item -->
						<div class="item-brand text-center">
							<a href="<?php echo esc_url($link); ?>" target="_blank">
								<?php the_post_thumbnail( 'brand-logo' ); ?>
							</a>
						</div>
						<!-- End Product Item -->

					<?php  echo '</div>'; ?>
					<?php $_count++; ?>
				<?php endwhile; ?>
				</div>

<?php endif; ?>
<?php wp_reset_query(); ?>
<?php } ?>
		</div>
	</div>
</div>

