<?php
/**
 * Created by PhpStorm.
 * User: ManhTienpt
 * Date: 11/27/2015
 * Time: 2:24 PM
 */

function nautica_fnc_product_template(){
    $template = nautica_fnc_theme_options( 'woocommerce-single-template' )?nautica_fnc_theme_options( 'woocommerce-single-template' ):'v1';
    return $template;
}
function nautica_fnc_wc_itemsrow(){
    $itemsrow = nautica_fnc_theme_options( 'wc_itemsrow' ) ? nautica_fnc_theme_options( 'wc_itemsrow' ): 4;
    return $itemsrow;
}
function nautica_fnc_wc_items_perpage(){
    $items_perpage = nautica_fnc_theme_options( 'woo-number-page' ) ? nautica_fnc_theme_options( 'woo-number-page' ):12;
    return $items_perpage;
}
function nautica_fnc_wc_mini_cart_templates(){
    $template = nautica_fnc_theme_options( 'woo-mini-cart-template' )?nautica_fnc_theme_options( 'woo-mini-cart-template' ):'white_version';
    return $template;
}