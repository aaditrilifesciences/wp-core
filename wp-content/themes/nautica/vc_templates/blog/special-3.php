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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('nice-style v3'); ?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <?php endif; ?>
        <div class="post-container">
            <div class="blog-post-detail blog-post-grid">
                <figure class="entry-thumb">
                    <?php the_post_thumbnail('thumbnails-post'); ?>
                    
                </figure>
                <div class="information-post">
                    <div class="col-xs-12 no-padding">    
                        <div class="meta-top">
                        <span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
                        </div>
                        <h3 class="entry-title">
                            <a class="text-white" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="meta-bottom">
                            
                            <span class="entry-author"><?php echo esc_html__('By ', 'nautica'); the_author_posts_link(); ?></span>
                            <span>/</span>
                            <span class="comment-count">
                                <?php comments_popup_link(esc_html__(' 0 comment', 'nautica'), esc_html__(' 1 comment', 'nautica'), esc_html__(' % comments', 'nautica')); ?>
                            </span>  
                        </div>    
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </article>
