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

switch ($columns_count) {
	case '6': 
		$class_column = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
		break;
	case '4':
		$class_column='col-md-3 col-sm-6';
		break;
	case '3':
		$class_column='col-md-4 col-sm-12';
		break;
	case '2':
		$class_column='col-md-6 col-sm-6';
		break;
	default:
		$class_column='col-md-12 col-sm-12';
		break;
}

global $woocommerce;

$_id = nautica_fnc_makeid();
$_count = 1;
$list_query = $this->getListQuery( $atts);

if(count($list_query)>0){
?>
	<div class="widget widget-products widget-product-tabs products <?php echo (($el_class!='')?' '.$el_class:''); ?>">
		<div class="tabs-container tab-heading text-center clearfix">
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
									wc_get_template( 'widget-products/'.$style.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number ) );
								}
							?>
					</div>

				</div>
				<?php $__count++; ?>
			<?php } ?>
		</div>
	</div>
<?php wp_reset_query();?>
	<script>
	jQuery(document).ready(function($) {
		jQuery('.widget-products a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			jQuery('.widget-products .widget-title .visual-title').text(jQuery(this).data('title'));
		});
	});
	</script>
<?php } ?>

