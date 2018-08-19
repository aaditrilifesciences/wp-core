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
$args = array(
	'post_type' => $post_type,
	'posts_per_page' => $number_post
);

$query = new WP_Query($args);

if($query->have_posts()):
	$count = 0;

$_id = time();
// Display the widget title
if ( $title ) {
	echo ($before_title) ;
	echo esc_html($title);
	?>
		<span class="carousel-controls">
			<!-- Controls -->
			<a class="" href="#carousel-<?php echo esc_attr( $_id ); ?>" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="" href="#carousel-<?php echo esc_attr( $_id ); ?>" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</span>
	<?php
	echo ($after_title);
}


?>
<div id="carousel-<?php echo esc_attr( $_id ); ?>" class="post-widget media-post-carousel carousel slide" data-ride="carousel">
	<div class="carousel-inner">
	<?php while($query->have_posts()):$query->the_post(); ?>
		<!-- Wrapper for slides -->
		<div class="item<?php echo (($count==0)?" active":"") ?>">
			<div class="carousel-item">
				<figure class="carousel-image">						
					<?php the_post_thumbnail('blog-thumbnails');?>
				</figure>
				<div class="carousel-body">
					<h6 class="entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h6>
					<?php the_excerpt(); ?>
				</div>
			</div>			
		</div>
		<?php $count++; ?>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	</div>
</div>
<?php endif; ?>
