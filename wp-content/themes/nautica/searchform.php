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
?>
<form data-role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="engo-search input-group">
		<input name="s" maxlength="40" class="form-control input-large input-search" type="text" size="20" placeholder="<?php echo esc_html__('Search...', 'nautica'); ?>">
		<span class="input-group-addon input-large btn-search">
			<input type="submit" class="fa" value="&#xf002;" />
			<?php if( defined('ENGO_WOOCOMMERCE_ACTIVED') && ENGO_WOOCOMMERCE_ACTIVED ) { ?>
			<input type="hidden" name="post_type" value="product" />
			<?php } ?>
		</span>
	</div>
</form>


