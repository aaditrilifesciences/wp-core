<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Engotheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$_id = nautica_fnc_makeid();
if($category=='') return;
$_count = 0;

 $ocategory = get_term_by( 'slug', $category, 'product_cat' );

$loop = nautica_fnc_woocommerce_query( '', $per_page , $category );

$number = $columns;

if ( !empty($ocategory) && !is_wp_error($ocategory) ): ?>
 <div class="widget-heading clearfix">
	<h3 class="widget-title visual-title pull-left">
       <span><?php echo trim($ocategory->name); ?></span>
	</h3>	
	<div class="pull-right">
		
			<?php 

		  $args = array(
		       'hierarchical' => 1,
		       'show_option_none' => '',
		       'hide_empty' => 0,
		       'parent' => $ocategory->term_id,
		       'taxonomy' => 'product_cat'
		    );
			$subcats = get_categories($args);
			if( 	$subcats ){ ?> 
			<ul class="list-inline bullets">
			<?php 
			foreach ( $subcats as $term ){
			    $category_id = $term->term_id;
			    $category_name = $term->name;
			    $category_slug = $term->slug;

			    echo '<li><a href="'. esc_url( get_term_link($term->slug, 'product_cat') ) .'" title="'.esc_attr( $category_name).'">'.esc_html( $category_name ).'</a></li>';
			 } ?>
			 </ul>
			 <?php } ?>
		
	</div>
</div>	
<?php endif; 
if ( $loop->have_posts() ) : ?>
 
		<div class="widget-content <?php echo esc_attr($style); ?>">
			<div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content text-center owl-carousel-play" data-ride="owlcarousel">
				<div class="owl-carousel " data-slide="<?php echo esc_attr($number); ?>" data-pagination="false" data-navigation="true">
					 <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
					 		<?php wc_get_template_part( 'content', 'product-inner' ); ?>
					 <?php  $_count++ ; endwhile; ?>
					 <?php wp_reset_query(); ?>
				</div>
				<?php if( $number  < $_count) { ?>
				<a class="left carousel-control carousel-xs radius-x" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
						<span class="fa fa-angle-left"></span>
				</a>
				<a class="right carousel-control carousel-xs radius-x" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
						<span class="fa fa-angle-right"></span>
				</a>
			 <?php } ?>
			</div>			
		</div>
 
<?php endif; ?>
<?php wp_reset_query();?>