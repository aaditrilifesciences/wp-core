<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php nautica_fnc_post_thumbnail($this->post_thumbnail); ?>

	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && nautica_fnc_categorized_blog() ) : ?>

			<?php
		endif;

		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		?>

		<div class="entry-meta">
			<span class="post-format">
				<span class="fa fa-quote-right"></span> <a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo get_post_format_string( 'quote' ); ?></a>
			</span>

			<?php nautica_fnc_posted_on(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<span class="comments-link"><span class="fa fa-comments-o"></span> <?php comments_popup_link( esc_html__( 'Leave a comment', 'nautica' ), esc_html__( '1 Comment', 'nautica' ), esc_html__( '% Comments', 'nautica' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( esc_html__( 'Edit', 'nautica' ), '<span class="edit-link"><span class="fa fa-pencil"></span>', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		if ( is_single() ) :
			the_content();
		else :
			the_excerpt();
			echo '<div class="readmore"><a href="' . esc_url( get_permalink() ) .'" rel="bookmark">'.esc_html__( 'Read more', 'nautica' ).'</a></div>';

		endif;
		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) :
		?>
		<footer class="entry-footer row">
			<div class="tags_block col-sm-6 col-xs-12">
				<?php
				the_tags( '<span class="tag-title">Tags: </span> <span class="tag-links">', ', ', '</span>' );
				?>
			</div>
			<div class="social_network col-sm-6 col-xs-12">
				<?php do_action("nautica_social_share");?>
			</div>
		</footer>
		<div class="author">
			<?php
			$author_id = get_the_author_meta('ID');
			$author_avatar = get_avatar($author_id);
			$author_description = get_the_author_meta('description',$author_id);
			$author_display_name = get_the_author_meta('display_name',$author_id);
			$author_link = get_the_author_meta('user_url',$author_id);
			?>
			<div class="author-avatar">
				<figure>
					<?php echo $author_avatar;?>
				</figure>
			</div>
			<div class="author-info">
				<a rel="author" href="<?php echo esc_url($author_link);?>"><?php echo esc_attr($author_display_name);?></a>
				<div class="author-desc">
					<?php echo esc_html($author_description);?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php
	endif;
	?>
</article><!-- #post-## -->
