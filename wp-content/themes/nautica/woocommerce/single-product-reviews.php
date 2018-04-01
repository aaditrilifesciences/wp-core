<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}
$count =  $product->get_review_count() ;

$counts = nautica_fnc_get_review_counting();

$average      = $product->get_average_rating();

?>

<div id="reviews"  class="widget widget-reviews">
 
<div class="comments-content row">

	<div id="comments" class="comments col-md-6 col-lg-6 col-sm-12 col-xs-12">
		<h5><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
			else
				esc_html_e( 'Reviews', 'woocommerce' );
		?></h5>

		<?php if ( have_comments() ) : ?>

			<ul class="commentlist list-unstyled">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper" class="review_form_wrapper col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : esc_html__( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author form-group">' .
							            '<input id="author" name="author" type="text" placeholder="'.esc_html__( 'Name', 'woocommerce' ).'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email form-group">' .
							            '<input id="email" name="email" type="text" placeholder="'.esc_html__( 'Email', 'woocommerce' ).'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => esc_html__( 'Add review', 'woocommerce' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);




					$comment_form['comment_field'] = '<p class="comment-form-comment form-group"><textarea id="comment" placeholder="'.esc_html__( 'Your review', 'woocommerce' ).'"  class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] .= '<p class="comment-form-rating form-group clearfix">
							<label for="rating" class="control-label">' . esc_html__( 'Your Rating', 'woocommerce' ) .'</label>
							<select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'woocommerce' ) . '</option>
							</select></p>';
					}
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

	
	<?php endif; ?>

	<div class="clear"></div>
</div>
</div>