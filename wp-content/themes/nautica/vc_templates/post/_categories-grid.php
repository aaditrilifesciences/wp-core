<?php $thumbsize = isset($thumbsize)? $thumbsize : 'postthumb-grid';?>
<article class="post">

    <div class="entry-content">

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
                    <p class="entry-description"><?php echo nautica_fnc_excerpt(15,'...'); ?></p>
                <?php
            }
        ?>

    </div>
</article>