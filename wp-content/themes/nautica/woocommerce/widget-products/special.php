<?php $_delay = 150; $item_order = 1; ?>
<ul class="product_special_widget">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => true , 'animate'=> true , 'delay'=>$_delay, 'item_order' =>  $item_order) ); ?>
		<?php $_delay+=200; $item_order+=1; ?>
	<?php endwhile; ?>
</ul>
<?php wp_reset_query(); ?>