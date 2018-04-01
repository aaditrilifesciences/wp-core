

<?php 

if ( ! is_active_sidebar( 'newsletter' ) ) {
	return;
}
?>
<section id="engo-newsletter" class="engo-newsletter">
	<div class="container">
		<div>
			<?php dynamic_sidebar( 'newsletter' ); ?>
		</div>
	</div>	
</section>	
 