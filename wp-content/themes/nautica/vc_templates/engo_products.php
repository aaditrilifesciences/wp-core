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

if($columns == 'custom_responsive') {
	$class_column = "col-lg-".(12/$columns_lg)." col-md-".(12/$columns_md)." col-sm-".(12/$columns_sm)." col-xs-".(12/$columns_xs);
	$slider_config = "data-lg='$columns_lg' data-md='$columns_md' data-sm='$columns_sm' data-xs='$columns_xs'";
	$columns_count = $columns_lg;
} else {
	$class_column = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
	$slider_config = "data-lg='6' data-md='4' data-sm='3' data-xs='2'";
	$columns_count = $columns;
}

switch($button_template) {
	case "mini":
		$button_type = "mini-button-actions";
		break;
	case "normal":
		$button_type = "normal-button-actions";
	break;
	default:
		$button_type = "normal-button-actions";
		break;
}

if($type=='') return;


global $woocommerce;

$_id = nautica_fnc_makeid();
$_count = 1;


$loop = nautica_fnc_woocommerce_query($type,$number);
echo "<div class='widget widget-".esc_attr($style) . " widget-products products".((!empty($el_class))?" ".$el_class:'')."'>";

if($title!=''){ ?>
	<h3 class="widget-title visual-title widget-heading-main">
      <span><?php echo esc_attr( $title ); ?></span>
		<?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
	</h3>
<?php }

if ( $loop->have_posts() ) : ?>
	<div class="widget-content">
		<div class="<?php echo esc_attr( $style ); ?>-wrapper">
			<?php wc_get_template( 'widget-products/'.$style.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column, 'slider_config' => $slider_config,'posts_per_page'=>$number, 'button_type' =>$button_type ) ); ?>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_query(); ?>

<?php echo "</div>" ?>
