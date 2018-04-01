<?php

$nav_menu = ( $menu !='' ) ? wp_get_nav_menu_object( $menu ) : false;
if(!$nav_menu) return false;
$postion_class = ($position=='left')?'menu-left':'menu-right';
$args = array(  'menu' => $nav_menu,
                'container_class' => 'vertical-menu engo-toggle-dropdown-menu menu-sitebar-category-container '.$postion_class,
                'menu_class' => 'megamenu',
                'fallback_cb' => '',
                'walker' => class_exists("Nautica_Category_Toggle_Menu") ? new Nautica_Category_Toggle_Menu($nav_menu->term_id):null );

if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}
?>
<?php wp_nav_menu($args); ?>
