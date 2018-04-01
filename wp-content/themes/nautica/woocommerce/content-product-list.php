<?php global $product; ?>

<?php
	$class=$attrs='';
	if(isset($animate) && $animate){
		$class= 'wow fadeInUp';
		//$attrs = 'data-wow-duration="0.6s" data-wow-delay="'.$delay.'ms"';
	}
?>

<li class="media product-block widget-product <?php echo esc_attr($class); ?> <?php echo (isset($item_order) && ($item_order%2)) ?'first':'last'; ?>" <?php echo trim($attrs); ?>>
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
	<div class="media-body meta">
		<h3 class="name">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a>
		</h3>
		<?php if ( ! empty( $show_rating ) ){ ?>
			<div class="rating clearfix">
	            <?php if ( ! empty( $show_rating ) ){
	            	if($rating_html = $product->get_rating_html()){
	            		echo $product->get_rating_html();

	            	}else{
	            		echo '<div class="star-rating"></div>';
	            	}
	            } ?>
	        </div>
		<?php }?>
		<div class="price"><?php echo ($product->get_price_html()); ?></div>
	</div>
</li>


