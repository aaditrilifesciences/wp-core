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
<article id="post-<?php the_ID(); ?>" <?php post_class('nice-style v2'); ?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <?php endif; ?>
        <div class="post-container">
            <div class="blog-post-detail blog-post-grid">
                <figure class="entry-thumb">
                    <?php nautica_fnc_post_thumbnail(); ?>
                    
                </figure>
                <div class="information-post">
                    <div class="left col-xs-3 no-padding">
                        <div class="entry-meta">
                            <span class="entry-date">
                                <span class="date"><?php echo get_the_date('d'); ?></span>
                                <span class="month"><?php echo get_the_date('M'); ?></span>
                            </span>
                            <span class="comment-count">
                                <?php comments_popup_link(esc_html__(' 0 comment', 'nautica'), esc_html__(' 1 comment', 'nautica'), esc_html__(' % comments', 'nautica')); ?>
                            </span>                       
                        </div>
                    </div>
                    <div class="right col-xs-9 no-padding">    
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="description">
                <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
    </article>
