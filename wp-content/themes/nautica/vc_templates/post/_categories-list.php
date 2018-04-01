<?php $thumbsize = isset($thumbsize)? $thumbsize : 'postthumb-grid';?>
<article class="post">
    <?php
    if ( has_post_thumbnail() ) {
        ?>
            <figure class="entry-thumb zoom-2">
                <a href="<?php the_permalink(); ?>" title="" class="entry-image">
                    <?php the_post_thumbnail( $thumbsize );?>
                </a>
                <!-- vote    -->
                <?php do_action('nautica_show_rating') ?>
            </figure>
        <?php
    }
    ?>
    <div class="entry-content">
        <div class="entry-content-inner clearfix">
            <div class="entry-meta">
                <div class="entry-category">
                    <?php the_category(); ?>
                </div>
                <div class="entry-create">
                    <span class="meta-sep">|</span>
                    <span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
                    <span class="meta-sep">|</span>
                </div>
                <ul class="entry-comment list-inline">
                    <li class="comment-count">
                        <?php comments_popup_link(esc_html__(' 0 ', 'nautica'), esc_html__(' 1 ', 'nautica'), esc_html__(' % ', 'nautica')); ?>
                    </li>
                </ul>
            </div>
        </div>

        <?php
        if (get_the_title()) {
        ?>
            <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php
        }
        ?>

        <?php
            if (! has_excerpt()) {
                echo "";
            } else {
                ?>
                    <p class="entry-description"><?php echo nautica_fnc_excerpt(29,'...'); ?></p>
                <?php
            }
        ?>

    </div>
</article>