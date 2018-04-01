<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $number
 * @var $columns_count
 * @var $show_tab
 * @var $style
 * @var $filter
 * @var $title_align
 * @var $size
 * @var $el_class
 * @var $loop
 * @var $load_more
 * Shortcode class
 * @var $this WPBakeryShortCode_ENGO_All_Products
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
global $woocommerce;

$_id = nautica_fnc_makeid();
$_count = 1;


$list_query = $this->getListQuery( $atts );

if(count($list_query)>0){
?>
	<div class="widget widget-products widget-product-tabs products <?php echo (($el_class!='')?' '.esc_attr($el_class):''); ?>">
		<div class="tabs-container tab-heading text-center clearfix tab-v8 widget-heading-main">
			<?php if($title!=''):?>
				<h3 class="widget-title <?php echo esc_attr( $size ).' '.esc_attr( $title_align ).' '; ?>">
            		<span><span><?php echo esc_attr( $title ); ?></span></span><?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
				</h3>
			<?php endif; ?>
			<ul class="tabs-list nav nav-tabs">
				<?php $__count=0; ?>
				<?php foreach ($list_query as $key => $li) { ?>
						<li <?php echo ($__count==0)?' class="active"':''; ?>><a href="#<?php echo esc_attr($key.'-'.$_id); ?>" data-toggle="tab" data-title="<?php echo esc_attr($li['title']);?>"><?php echo trim( $li['title_tab'] );?></a></li>
					<?php $__count++; ?>
				<?php } ?>
			</ul>
		</div>
		<div class="widget-content tab-content woocommerce">
			<?php $__count=0; ?>
			<?php foreach ($list_query as $key => $li) { ?>
				<div class="tab-pane<?php echo ($__count==0)?' active':''; ?>" id="<?php echo esc_attr($key).'-'.$_id; ?>">
					<div class="grid-wrapper">
							<?php
								$loop = nautica_fnc_woocommerce_query($key,$number);
								if( $number == -1 )
									$_post_per_page = $loop->found_posts;
								else
									$_post_per_page = $number;

								if($loop->have_posts()){
									wc_get_template( 'widget-products/'.$style.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column, 'slider_config' => $slider_config, 'posts_per_page'=>$number, 'button_type' =>$button_type ) );
								}
							?>
					</div>

				</div>
				<?php $__count++; ?>
			<?php } ?>
		</div>
	</div>
<?php wp_reset_query();?>

<?php } ?>

