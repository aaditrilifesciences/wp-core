<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     EngoTheme team <engotheme@gmail.com, support@engotheme.com>
 * @copyright  Copyright (C) 2015 engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 * $this : WPBakeryShortCode_Engo_instagram
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$instagram_list = $this->scrape_instagram();

?>
	<div class="widget <?php echo (($el_class!='')?' '.$el_class:''); ?>">
		<?php if(!empty($title)){ ?>
			<h4 class="widget-title">
				<span><?php echo esc_attr($title); ?></span>
				<?php if(trim($description)!=''){ ?>
		            <span class="widget-desc">
		                <?php echo trim($description); ?>
		            </span>
		        <?php } ?>
			</h4>
		<?php } ?>

		<div class="widget-content">
			<div class="widget-instagram-inner">
				<?php var_dump($instagram_list);?>
			</div>
		</div>

	</div>