<?php
/**
 * Single Product Thumbnails version 1
 *
 * @author      EngoTheme
 * @package     Engoplugin/Templates/WooCommerce
 * @version     1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $post, $product, $woocommerce,$block_id;

$images = $product->get_gallery_attachment_ids();
$attachment_ids =  array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;

if ( $attachment_ids ) {
    $loop       = 0;
    $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
    ?>
    <div class="owl-product-thumb">
        <div class="owl-product-thumbs">
            <?php

            foreach ( $attachment_ids as $attachment_id ) {
                $image_link = wp_get_attachment_url( $attachment_id );
                if ( ! $image_link )
                    continue;
                $image_title    = esc_attr( get_the_title( $attachment_id ) );
                $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
                $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                    'title' => $image_title,
                    'alt'   => $image_title
                    ) );

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a title="%s">%s</a>', $image_caption, $image ), $attachment_id, $post->ID );

                $loop++;
            }

        ?>

        </div>
    </div>

    <?php
}
?>
