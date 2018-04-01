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

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$nav_menu = ( $menu !='' ) ? wp_get_nav_menu_object( $menu ) : false;
if(!$nav_menu) return false;
$align_class = "align-left";
switch ($text_align) {
    case "left":
        $align_class = "align-left";
     break;
    case "right":
        $align_class = "align-right";
        break;
    case "center":
        $align_class = "align-center";
        break;
    default:
        $align_class = "align-left";
        break;
}

$args = array(  'menu' => $nav_menu,
                'container_class' => 'collapse navbar-collapse navbar-ex1-collapse engo-horizontal-menu '.$align_class,
                'menu_class' => 'nav navbar-nav navbar-horizontal-mega',
                'fallback_cb' => '',
                'walker' => new Nautica_bootstrap_navwalker());

?>

<aside class="widget <?php echo esc_attr( $el_class ) ; ?> engo-horizontal-menu-widget">
    <?php if($title!=''): ?>
        <h3 class="widget-title visual-title"><span><span><?php echo  esc_attr($title); ?></span></span></h3>
    <?php endif; ?>
    <div class="widget-content">
        <?php wp_nav_menu($args); ?>
    </div>
</aside>
