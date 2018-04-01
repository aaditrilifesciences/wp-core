<?php $thumbsize = isset($thumbsize)? $thumbsize : 'medium';?>
<?php
    $post_category = "";
    $categories = get_the_category();
    $separator = ' ';
    $output = '';
    if($categories){
        foreach($categories as $category) {
            $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'nautica' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
        }
    $post_category = trim($output, $separator);
    }      
?>
    <article class="post row space-20">
        <?php
        if ( has_post_thumbnail() ) {
            ?>
                <div class="col-sm-6">
                    <figure class="entry-thumb">
                        <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
                            <?php the_post_thumbnail( $thumbsize );?>
                        </a>
                        <!-- vote    -->
                        <?php do_action('nautica_show_rating') ?>
                        <div class="category-highlight hidden">
                            <?php echo trim($post_category) ?>
                        </div>
                    </figure>
                </div>
            <?php
        }
        ?>
        <div class="entry-content col-sm-6">
            <?php
            if (get_the_title()) {
            ?>
                <h4 class="entry-title space-padding-top-0">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php
            }
            ?>
            <div class="entry-content-inner clearfix">
                <div class="entry-meta">
                    <div class="entry-category hidden">
                        <?php the_category(); ?>
                    </div>
                
                    <ul class="entry-comment list-inline hidden">
                        <li class="comment-count">
                            <?php comments_popup_link(esc_html__(' 0 ', 'nautica'), esc_html__(' 1 ', 'nautica'), esc_html__(' % ', 'nautica')); ?>
                        </li>
                    </ul>

                     <div class="entry-create">
                        <span class="author"><?php echo esc_html_e('By', 'nautica'); the_author_posts_link(); ?></span>
                        <span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
                    </div>
                </div>
            </div>
            <?php
                if (! has_excerpt()) {
                    echo "";
                } else {
                    ?>
                        <p class="entry-description"><?php echo nautica_fnc_excerpt(60,'...'); ?></p>
                    <?php
                }
            ?>
            
            
        </div>
    </article>
