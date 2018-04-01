<?php $_delay = 150; ?>
<ul class="engo-w-products-list">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<?php wc_get_template_part( 'content', 'product-inner-list' ); ?>
		<?php $_delay+=200; ?>
	<?php endwhile; ?>
</ul>
<?php wp_reset_query(); ?>