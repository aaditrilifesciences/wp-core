<?php global $product; ?>
<li class="media widget-product">
	<a class="pull-left" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image(); ?>
	</a>
	<div class="media-body">
		<div class="name">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_title(); ?></a>
		</div>
		<?php if ($show_rating ) echo $product->get_rating_html(1); ?>
		<div class="price"><?php echo $product->get_price_html(); ?></div>
		<div class="btn-action-view-detail"><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php esc_html_e('Buy now', 'nautica')?></a></div>
	</div>
</li>

