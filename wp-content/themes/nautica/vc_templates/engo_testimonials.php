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
$_count = 0;
$args = array(
	'post_type' => 'testimonial',
	'posts_per_page' => $limit?$limit:5,
	'post_status' => 'publish',
);

$query = new WP_Query($args);
?>

<div class="widget-nostyle engo-testimonial testimonials testimonials-<?php echo esc_attr($skin).' '.esc_attr($el_class); ?>">
	<?php if($query->have_posts()){ ?>
		<?php if($title!=''){ ?>
			<h3 class="widget-title">
				<span><?php echo esc_attr($title); ?></span>
			</h3>
		<?php } ?>
 
			<!-- Skin 1 -->
			<div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content owl-carousel-play" data-ride="owlcarousel">
					<div class="owl-carousel testimonials-skin-<?php echo esc_attr($skin);?>" data-slide="<?php echo esc_attr($number); ?>" data-pagination="false" data-navigation="false">
					<?php  $_count=0; while($query->have_posts()):$query->the_post(); ?>
						<!-- Wrapper for slides -->
						<div class="item">
							<?php  get_template_part( 'vc_templates/testimonials/testimonials', $skin ); ?>
						</div>
						<?php $_count++; ?>
					<?php endwhile; ?>
				</div>
				<?php /* if( $number  < $_count) { ?>
				<div class="carousel-controls carousel-hidden">
					<a class="left carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
							<span class="fa fa-angle-left"></span>
					</a>
					<a class="right carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="next">
							<span class="fa fa-angle-right"></span>
					</a>
				</div>
				<?php } */?>
			</div>
	<?php } ?>
</div>
<?php wp_reset_query(); ?>
<?php
 if($skin == 'v2') {
?>
	 <script type="text/javascript">
			 jQuery( document ).ready(function() {
				 var testi_v2 = jQuery(".testimonials-skin-v2");
				 if (testi_v2.hasClass("owl-carousel")) {
					 testi_v2.owlCarousel({
						 touchDrag: false,
						 mouseDrag: false
					 });
					 testi_v2.data('owlCarousel').destroy();
					 testi_v2.removeClass('owl-carousel owl-loaded');
					 testi_v2.find('.owl-stage-outer').children().unwrap();
					 testi_v2.removeData();
				 }
				 testi_v2.owlCarousel({
					 items:1,
					 loop:true,
					 slideBy: 1,
					 dots: true,
					 touchDrag: true,
					 mouseDrag: true,
					 onInitialized : init_testi_v2

				 });
				 // 1) ASSIGN EACH 'DOT' A NUMBER
				 function init_testi_v2() {
					 /*testi_v2.css('visibility','visible');*/
					 var dotcount = 1;
					 jQuery('.owl-dot', testi_v2).each(function() {
						 jQuery( this ).addClass( 'dotnumber' + dotcount);
						 jQuery( this ).attr('data-info', dotcount);
						 dotcount=dotcount+1;
					 });
					 // 2) ASSIGN EACH 'SLIDE' A NUMBER
					 slidecount = 1;
					 jQuery('.owl-item', testi_v2).not('.cloned').each(function() {
						 jQuery( this ).addClass( 'slidenumber' + slidecount);
						 slidecount=slidecount+1;
					 });

					 // SYNC THE SLIDE NUMBER IMG TO ITS DOT COUNTERPART (E.G SLIDE 1 IMG TO DOT 1 BACKGROUND-IMAGE)
					 jQuery('.owl-dot', testi_v2).each(function() {
						 grab = jQuery(this).data('info');
						 slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');
						 jQuery(this).html("<img src='"+slidegrab+"'/>");
					 });

				 }

			 });
		 </script>
<?php } ?>