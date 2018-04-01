<?php global $woocommerce_loop; 
	$woocommerce_loop['columns'] = $columns_count ;
?>
<?php
$_count = 1;
$_delay = 0.2;
$_this_delay = 0;
$_total = $loop->post_count; ?>
<div class="woocommerce">
<div class="engo-product-columns <?php if($columns_count<=1){ ?>w-products-list<?php }else{ ?>products products-grid<?php } ?>"><div class="row">
<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
<?php
	$itemsperrow = nautica_fnc_wc_itemsrow();
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
	}

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $itemsperrow );
	}

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) {
	return;
	}

	// Increase loop count
	$woocommerce_loop['loop']++;


	// Extra post classes
	$classes = array();
	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
	}
	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
	}
	$columns = 12/$woocommerce_loop['columns'];
	$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.$columns.'';
	$classes[] = "animated wow fadeInUp";
	?>
	<div <?php post_class( $classes ); ?> data-wow-duration="1s" data-wow-delay="<?php echo $_this_delay;?>s">
		<?php wc_get_template_part( 'content', 'product-inner' ); ?>
	</div>
	<?php
	$_this_delay = $_this_delay + $_delay;
	endwhile; ?>

</div>
</div>
</div>

<?php wp_reset_query(); ?>