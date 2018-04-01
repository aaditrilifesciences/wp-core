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
global $post;
$args = array( 'position' => 'top', 'animation' => 'true' );
?>
<div class="engo-social-share">
		<div class="bo-social-icons bo-sicolor social-radius-rounded">
		<?php if((bool)nautica_fnc_theme_options('facebook_share_blog',true)): ?>
 
			<a class="bo-social-facebook" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Facebook" href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php the_permalink(); ?>&p&#91;title&#93;=<?php the_title(); ?>" target="_blank" title="<?php echo esc_html__('Share on facebook', 'nautica'); ?>">
				<i class="fa fa-facebook"></i>
			</a>
 
		<?php endif; ?>
		<?php if((bool)nautica_fnc_theme_options('twitter_share_blog',true)): ?>
 
			<a class="bo-social-twitter"  data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank" title="<?php echo esc_html__('Share on Twitter', 'nautica'); ?>">
				<i class="fa fa-twitter"></i>
			</a>
 
		<?php endif; ?>
		<?php if((bool)nautica_fnc_theme_options('linkedin_share_blog',true)): ?>
 
			<a class="bo-social-linkedin"  data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="LinkedIn" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php echo esc_html__('Share on LinkedIn', 'nautica'); ?>">
				<i class="fa fa-linkedin"></i>
			</a>
 
		<?php endif; ?>
		<?php if((bool)nautica_fnc_theme_options('tumblr_share_blog',true)): ?>
 
			<a class="bo-social-tumblr" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Tumblr" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank" title="<?php echo esc_html__('Share on Tumblr', 'nautica'); ?>">
				<i class="fa fa-tumblr"></i>
			</a>
 
		<?php endif; ?>
		<?php if((bool)nautica_fnc_theme_options('google_share_blog',true)): ?>
 
			<a class="bo-social-google" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Google plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" title="<?php echo esc_html__('Share on Google plus', 'nautica'); ?>">
				<i class="fa fa-google-plus"></i>
			</a>
 
		<?php endif; ?>
		<?php if((bool)nautica_fnc_theme_options('pinterest_share_blog',true)): ?>
 
			<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
			<a class="bo-social-pinterest" data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" target="_blank" title="<?php echo esc_html__('Share on Pinterest', 'nautica'); ?>">
				<i class="fa fa-pinterest"></i>
			</a>
 
		<?php endif; ?>
		<?php if((bool)nautica_fnc_theme_options('mail_share_blog',true)): ?>
 
			<a class="bo-social-envelope"  data-toggle="tooltip" data-placement="<?php echo esc_attr($args['position']); ?>" data-animation="<?php echo esc_attr($args['animation']); ?>"  data-original-title="Email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" title="<?php echo esc_html__('Email to a Friend', 'nautica'); ?>">
				<i class="fa fa-envelope"></i>
			</a>
 
		<?php endif; ?>
	</div>
</div>	