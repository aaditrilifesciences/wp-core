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

// Display the widget title
if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}

$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_post
);

$query = new WP_Query($args);
if($query->have_posts()):
?>
<div class="post-widget media-post-layout widget-content widget_recent_entries">
<?php
	while($query->have_posts()):$query->the_post();
?>
	<article class="item-post media row">
		<?php
			if(has_post_thumbnail()){
		?>
		<div class="col-lg-4 col-md-4 col-xs-4 col-md-4 widget-thumbnail">
			<a href="<?php the_permalink(); ?>" class="image">
				<?php the_post_thumbnail( 'widget' ); ?>
			</a>
		</div>
		<div class="col-lg-8 col-md-8 col-xs-8 col-md-8">
			<h6 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h6>
			<p>
		<span class="post-date">
			<?php the_time( 'd M Y' ); ?>
		</span>
			</p>
		</div>
		<?php } else {?>

		<div class="col-lg-12 col-md-12 col-xs-12 col-md-12">
			<h6 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h6>
			<p>
			<span class="post-date">
				<?php the_time( 'd M Y' ); ?>
			</span>
			</p>
		</div>
		<?php }?>
	</article>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>
<?php endif; ?>
