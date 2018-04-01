<?php
/**
 * The template for displaying comments.
 *
 * @since   1.0.0
 * @package Valey
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="fx-row">
	<div id="comments" class="comments-area fx-col-md-7 fx-col-xs-12">
		<?php if ( have_comments() ) : ?>
			<h4 class="tu cb mg__0 fs__14 mb__55">
				<?php
					$comments_number = get_comments_number();
					if ( 1 === $comments_number ) {
						/* translators: %s: post title */
						printf( _x( 'Comment (1)', 'comments title', 'valey' ), get_the_title() );
					} else {
						printf(
							/* translators: 1: number of comments, 2: post title */
							_nx(
								'Comment (%1$s)',
								'Comments (%1$s)',
								$comments_number,
								'comments title',
								'valey'
							),
							number_format_i18n( $comments_number ),
							get_the_title()
						);
					}
				?>
			</h4>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'    => 'ol',
						'callback' => 'fx_valey_comments_list',
					) );
				?>
			</ol><!-- .comment-list -->

			<?php the_comments_navigation(); ?>

		<?php endif; // Check for have_comments(). ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'valey' ); ?></p>
		<?php endif; ?>

		<?php
			$args = array(
				'comment_notes_before' => '',
				'fields' => '
					<div class="fx-row mb__30">
						<div class="comment-form-author fx-col-md-6">
							<input placeholder="' . esc_html__( 'Your name *', 'valey' ) . '" type="text" required="required" size="30" value="" name="author" id="author">
						</div>
						<div class="comment-form-email fx-col-md-6">
							<input placeholder="' . esc_html__( 'Your email *', 'valey' ) . '" type="email" required="required" size="30" value="" name="email" id="email">
						</div>
					</div>
				',

				// Change the title of the reply section
				'title_reply'=> esc_html__( 'Leave your comment', 'valey' ),

				// Redefine your own textarea (the comment body)
				'comment_field' => '<div class="comment-form-comment mb__25"><textarea class="w__100" rows="8" placeholder="' . esc_html__( 'Your comment *', 'valey' ) . '" name="comment" aria-required="true"></textarea></div>',

				// Change the title of send button 
				'label_submit'=> esc_html__( 'Submit', 'valey' ),
			);

			comment_form( $args );
		?>
	</div><!-- .comments-area -->
</div><!-- .fx-row -->
