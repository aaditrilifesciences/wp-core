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
$postformat = get_post_format();

$icon = '';
switch ($postformat) {
	case 'link':
		$icon = 'fa-link';
		break;
	case 'gallery':
		$icon = 'fa-th-large';
		break;
	case 'audio':
		$icon = 'fa-music';
		break;
	case 'video':
		$icon = 'fa-film';
		break;
	default:
		$icon = 'fa-picture-o';
		break;
}
?>
<span class="entry-date"><span class="entry-meta-date radius-4x bg-primary"><time datetime="2013-07-12T19:54:10+00:00"> <?php the_time( 'M d, Y' ); ?></time></span></span>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
          
        <?php endif; ?>
        <div class="post-container clearfix">
            <div class="blog-post-detail">
                <figure class="entry-preview <?php if( $postformat) { ?>entry-<?php echo $postformat; ?><?php } ?>">
                    <?php 
                        if( has_post_format($postformat)){ 
                            get_template_part( 'templates/content/content', $postformat );
                        }
                    ?>
                </figure>

                <?php  if( !has_post_format($postformat)){  ?>
                <div class="information-post">
                    <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <div class="entry-meta">
                       
                        <span class="meta-sep"> / </span>
                        <span class="comment-count">
                            <?php comments_popup_link(esc_html__(' 0 comment', 'nautica'), esc_html__(' 1 comment', 'nautica'), esc_html__(' % comments', 'nautica')); ?>
                        </span>
                        <span class="meta-sep"> / </span>
                        <span class="author-link"><?php the_author_posts_link(); ?></span>
                        <?php if(is_tag()): ?>
                            <span class="meta-sep"> / </span>
                            <span class="tag-link"><?php the_tags('Tags: ',', '); ?></span>
                        <?php endif; ?>
                    </div>

                    <p class="entry-content">
                        <?php echo nautica_fnc_excerpt(100); ?>
                    </p>

                   
                </div>
                <?php } ?>
            
            </div>
        </div>
             <div class="entry-link">
                    <a href="<?php the_permalink(); ?>" class="btn btn-outline"><?php echo esc_html__( 'read more', 'nautica' ); ?></a>
                </div>
    </article>