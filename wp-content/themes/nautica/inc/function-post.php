<?php 
if ( ! function_exists( 'nautica_fnc_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default EngoTheme attachment size.
	 *
	 * @since EngoTheme 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'nautica_fnc_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'nautica_fnc_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since EngoTheme 1.0
 */
function nautica_fnc_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'nautica' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since EngoTheme 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function nautica_fnc_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'nautica_fnc_post_classes' );


if(!function_exists('nautica_related_posts_by_tags')) {
	function nautica_related_posts_by_tags()
	{
		$show_related = nautica_fnc_theme_options('nautica-blog-show-related-post');
		if($show_related) {
			nautica_engo_includes(  get_template_directory() . '/widgets/related_post/related.php' );
		}
	}
}
add_action('nautica_blog_related_posts', 'nautica_related_posts_by_tags');
/**
 *
 */
if(!function_exists('nautica_fnc_comment_form')){
    function nautica_fnc_comment_form($arg,$class='btn-primary'){
      ob_start();
      comment_form($arg);
      $form = ob_get_clean();
      echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
    }
}

/**
 *
 */
if(!function_exists('nautica_fnc_comment_reply_link')){
    function nautica_fnc_comment_reply_link($arg,$class='btn btn-default btn-xs'){
      ob_start();
      comment_reply_link($arg);
      $reply = ob_get_clean();
      echo str_replace('comment-reply-link','comment-reply-link '.$class, $reply);
    }
}

/**
 * Call back to re-mark html and show comment in good look
 */
if(!function_exists('nautica_fnc_theme_comment')){
  
    function nautica_fnc_theme_comment($comment, $args, $depth){
         $GLOBALS['comment'] = $comment;
		$add_below = '';

		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

			<div class="the-comment">
				<div class="avatar">
					<?php echo get_avatar($comment, 54); ?>
				</div>

				<div class="comment-box">

					<div class="comment-author meta">
						<strong><?php echo get_comment_author_link() ?></strong>
						<?php printf(esc_html__('%1$s', 'nautica'), get_comment_date()) ?></a>
						<?php edit_comment_link(esc_html__('Edit', 'nautica'),'  ','') ?>
						<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__('Reply', 'nautica'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>

					<div class="comment-text">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php echo esc_html__('Your comment is awaiting moderation.', 'nautica') ?></em>
						<br />
						<?php endif; ?>
						<?php comment_text() ?>
					</div>

				</div>

			</div>
         
    <?php }
}


/**
 * Pagination Navigation
 */
if(!function_exists('nautica_fnc_pagination_nav')){
    function nautica_fnc_pagination_nav($per_page,$total,$max_num_pages=''){
        ?>
        <section class="engo-pagination">
            <?php global  $wp_query; ?>
            <?php nautica_fnc_pagination($prev = '<i class="fa fa-long-arrow-left"></i>', $next = '<i class="fa fa-long-arrow-right"></i>', $pages=$max_num_pages ,array('class'=>'pull-left')); ?>
            <div class="result-count pull-right">
                <?php
                $paged    = max( 1, $wp_query->get( 'paged' ) );
                $first    = ( $per_page * $paged ) - $per_page + 1;
                $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

//                if ( 1 == $total ) {
//                    esc_html_e( 'Showing the single result', 'nautica' );
//                } elseif ( $total <= $per_page || -1 == $per_page ) {
//                    printf( esc_html__( 'Showing all %d results', 'nautica' ), $total );
//                } else {
//                    printf( _x( 'Showing %1$d to %2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'nautica' ), $first, $last, $total );
//                }
                ?>
            </div>
        </section>
    <?php
    }
}
/**
 * Gener paginations
 */
if(!function_exists('nautica_fnc_pagination')){
    //page navegation
    function nautica_fnc_pagination($prev = 'Prev', $next = 'Next', $pages='' ,$args=array('class'=>'')) {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
        }
        $pagination = array(
            'base' => @add_query_arg('paged','%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'array'
        );

        if( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

        
        if(isset( $_GET['s'])){
            $cq = $_GET['s'];
            $sq = str_replace(" ", "+", $cq);
        }
        
        if( !empty($wp_query->query_vars['s']) ){
            $pagination['add_args'] = array( 's' => $sq);
        }
        if(paginate_links( $pagination )!=''){
            $paginations = paginate_links( $pagination );
            echo '<ul>';
                foreach ($paginations as $key => $pg) {
                    echo '<li>'. $pg .'</li>';
                }
            echo '</ul>';
        }
    }
}
?>