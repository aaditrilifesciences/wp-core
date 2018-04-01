

<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Engotheme Team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */

if ( post_password_required() ){
    return;
}
?>
<div id="comments" class="comments">
    <header class="header-title">
        <h5 class="comments-title"><?php comments_number( esc_html__('0 Comment', 'nautica'), esc_html__('1 Comment', 'nautica'), esc_html__('% Comments', 'nautica') ); ?></h5>
    </header><!-- /header -->

    <?php if ( have_comments() ) { ?>
        <div class="engo-commentlists">
    	    <ol class="commentlists">
    	        <?php wp_list_comments('callback=nautica_fnc_theme_comment'); ?>
    	    </ol>
    	    <?php
    	    	// Are there comments to navigate through?
    	    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    	    ?>
    	    <footer class="navigation comment-navigation" data-role="navigation">
    	        <div class="previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'nautica' ) ); ?></div>
    	        <div class="next right"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'nautica' ) ); ?></div>
    	    </footer><!-- .comment-navigation -->
    	    <?php endif; // Check for comment navigation ?>

    	    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    	        <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'nautica' ); ?></p>
    	    <?php endif; ?>
        </div>
    <?php } ?> 

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> '<div class="header_title"><h4 class="title comments-title">'.esc_html__('Leave a Comment', 'nautica').'</h4></div>',
                        'comment_field' => '<div class="row"><div class="form-group col-md-12 col-xs-12">
                                                <label class="field-label" for="comment">'. esc_html__('Comment:', 'nautica').'</label>
                                                <textarea rows="8" id="comment" class="form-control"  name="comment"'.$aria_req.'></textarea>
                                            </div></div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
                    		array(
                                'author' => '<div class="row"><div class="form-group col-md-4 col-xs-12">
                                            <label for="author">'. esc_html__('Name:', 'nautica').'</label>
                                            <input type="text" name="author" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
                                            </div>',
                                'email' => ' <div class="form-group col-md-4 col-xs-12">
                                            <label for="email">'. esc_html__('Email:', 'nautica').'</label>
                                            <input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
                                            </div>',
                                'url' => '<div class="form-group col-md-4 col-xs-12">
                                            <label for="url">'. esc_html__('Website:', 'nautica').'</label>
                                            <input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
                                            </div></div>',
                            )),
                        'label_submit' => esc_html__('Post Comment', 'nautica'),
						'comment_notes_before' => '<div class="form-group h-info">'.esc_html__('Your email address will not be published.', 'nautica').'</div>',
						'comment_notes_after' => '',
                        );
    ?>
	<div class="commentform reset-button-default">
			<?php nautica_fnc_comment_form($comment_args); ?>
    </div><!-- end commentform -->
</div><!-- end comments -->