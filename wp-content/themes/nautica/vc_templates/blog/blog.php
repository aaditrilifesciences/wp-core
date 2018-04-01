<?php
/**
 * Created by PhpStorm.
 * User: ManhTienpt
 * Date: 11/20/2015
 * Time: 8:33 AM
 */

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
<article id="post-<?php the_ID(); ?>" <?php post_class('nice-style'); ?>>
    <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
    <?php endif; ?>
    <div class="post-container">
        <div class="blog-post-detail blog-post-grid">
            <div class="post-thumbnail">
                <figure class="entry-thumb">
                    <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
                </figure>
            </div>
            <div class="information-post">
                    <div class="entry-meta">
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <span class="entry-date">
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="comment-count">
                            <?php comments_popup_link(esc_html__(' 0 comment', 'nautica'), esc_html__(' 1 comment', 'nautica'), esc_html__(' % comments', 'nautica')); ?>
                        </span>
                    </div>
                    <div class="description">
                        <?php echo getwords(html2txt(get_the_content()),20);?>
                        <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read more','nautica') ?></a>
                    </div>

            </div>
        </div>
    </div>
</article>
