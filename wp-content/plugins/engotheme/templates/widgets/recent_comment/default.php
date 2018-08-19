<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     EngoTheme Team <engotheme@gmail.com >
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */
// Display the widget title
if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}
?>

<div class="comment-widget widget-content">
    <?php
    $number = $instance['number_comment'];
    $all_comments=get_comments( array('status' => 'approve', 'number'=>$number) );
    if(is_array( $all_comments)){
        foreach($all_comments as $comment) { ?>
        <article class="clearfix">
            <div class="avatar-comment-widget">
                <?php echo get_avatar($comment, '70'); ?>
            </div>
            <div class="content-comment-widget">
                <h6>
                    <?php echo strip_tags($comment->comment_author); ?> <?php esc_html__('says', 'shopstars' ); ?>:
                </h6>
                <a class="comment-text-side" href="<?php echo esc_url( get_permalink($comment->ID) ); ?>#comment-<?php echo esc_attr( $comment->comment_ID ); ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo esc_html( $comment->post_title ); ?>">
                    <?php echo engo_string_limit_words(strip_tags($comment->com_excerpt), 12); ?>...
                </a>
            </div>
        </article>
    <?php } 
    } ?>
</div>