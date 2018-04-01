<section id="engo-topbar" class="engo-topbar topbar-v2 header-topbar">
	<div class="container">
		<div class="inner">
			<div class="pull-left hidden-lg hidden-md engo-mainmenu offcanvas-fixed">
				<div class="btn-toggle-menu version-black" data-toggle="offcanvas">
					<div class="one"></div>
					<div class="two"></div>
					<div class="three"></div>
				</div>
			</div>

			<div class="pull-left search-box hidden-xs">
				<?php get_template_part( 'page-templates/parts/search-v1' ); ?>
			</div>
			<div class="pull-right hidden-md hidden-lg hidden-md hidden-sm">
				<?php get_template_part( 'page-templates/parts/topbar-v3' ); ?>
			</div>
			<div class="pull-right hidden-xs">
				<?php if(has_nav_menu( 'topmenu' )): ?>
					<nav class="engo-topmenu" data-role="navigation">
						<?php
						$args = array(
								'theme_location'  => 'topmenu',
								'menu_class'      => 'engo-menu-top list-inline list-square',
								'fallback_cb'     => '',
								'menu_id'         => 'main-topmenu'
						);
						wp_nav_menu($args);
						?>
					</nav>
				<?php endif; ?>
			</div>
			<div class="user-login pull-right hidden-xs">
				<ul class="list-inline">
					<?php if( !is_user_logged_in() ){ ?>
						<li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Login', 'nautica'); ?>"> <?php esc_html_e('Login', 'nautica'); ?> </a></li>
					<?php }else{ ?>
						<?php $current_user = wp_get_current_user(); ?>
						<li><span class="hidden-xs"><?php echo esc_html__('Welcome ', 'nautica'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
						<li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('My Account', 'nautica'); ?>"> <?php esc_html_e('My Account', 'nautica'); ?> </a></li>
					<?php } ?>
					<?php do_action('nautica-topbar-buttons'); ?>
				</ul>
			</div>
		</div>
	</div>
</section>