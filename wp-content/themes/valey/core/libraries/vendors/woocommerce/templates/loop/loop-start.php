<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $fxshortcodes;

// Get product list style
$class = '';
$style = $fxshortcodes ? $fxshortcodes['layout'] : cs_get_option( 'wc-style' );

// Get wc layout
$layout = cs_get_option( 'wc-layout' );

if ( 'masonry' == $style ) {
	$class = ' fx-masonry';
	if ( $fxshortcodes['filter'] ) {
		// Get product category
		$terms = get_terms( 'product_cat', array( 'hide_empty' => 1 ) );

		echo '<nav class="fx-filters tu f__mont fs__12 pt__40 pb__40">';
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			echo '<a href="#" data-filter="*" class="selected pr pl__25 pr__25">' . esc_html__( 'All', 'valey' ) . '</a>';
			foreach ( $terms as $term ) {
				$link = get_term_link( $term->slug, 'product_cat' );

				echo '<a class="pr pl__25 pr__25" data-filter=".product-cat-' . esc_attr( $term->slug ) . '" href="#">' . esc_html( $term->name ) . '</a>';
			}
		}
		echo '</nav>';
	}
}
if ( $layout !== 'no-sidebar' && ! $fxshortcodes ) {
	echo '<div class="fx-row"><div class="fx-col-md-9 fx-col-sm-12 fx-col-xs-12">';
}
?>
<div data-layout="<?php echo esc_attr( $style ); ?>" class="products<?php echo esc_attr( $class ); ?> <?php echo ( $fxshortcodes ? '' : ' fx-row' ); ?><?php echo ( $fxshortcodes['slider'] ? 'owl-carousel' : '' ); ?>">
<?php if ( 'masonry' == $style ) echo '<div class="grid-sizer"></div>';