<section class="engo-topbar topbar-v3 header-topbar engo-horizontal-megamenu">
	<ul class="megamenu">
		<li class="dropdown has-mega aligned-right-window">
			<a href="#" class="dropdown-toggle engo-setting-menu">
				<i class="icon-setting"></i>
			</a>
			<p class="arrow"></p>
			<div class="toplinks dropdown-menu">
				<div class="mega-dropdown-menu">
				<ul>
					<li class="set lang clearfix">
						<span class="title"><?php esc_html_e( 'Select Language', 'nautica' ); ?></span>
						<div class="langs clearfix">
							<a href="#" class="active"><img src="<?php echo get_template_directory_uri() ?>/images/language/lang1.png" alt=""></a>
							<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/language/lang2.png" alt=""></a>
							<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/language/lang3.png" alt=""></a>
							<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/language/lang4.png" alt=""></a>
						</div>
					</li>
					<li class="set currency clearfix">
						<span class="title"><?php esc_html_e( 'Select Currency', 'nautica' ); ?></span>
						<ul class="curs">
							<li><a href="#" class="active"><i class="fa fa-dollar"></i></a></li>
							<li><a href="#"><i class="fa fa-eur"></i></a></li>
							<li><a href="#"><i class="fa fa-yen"></i></a></li>
						</ul>
					</li>

					<li class="set links">
						<?php if( !is_user_logged_in() ){ ?>
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
							<i class="fa fa-unlock-alt"></i>
							<span><?php esc_html_e( 'Login / Register', 'nautica' ); ?></span>
						</a>
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
							<i class="fa fa-user"></i>
							<span><?php esc_html_e('My Account', 'nautica'); ?></span>
						</a>
						<?php } else {?>
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
							<i class="fa fa-user"></i>
							<span><?php esc_html_e('My Account', 'nautica'); ?></span>
						</a>
						<?php } ?>
						<a href="/demo/wishlist/">
							<i class="fa fa-heart"></i>
							<span><?php esc_html_e( 'My Wishlist', 'woocommerce' ); ?></span>
						</a>
						<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
						<a href="<?php echo WC()->cart->get_checkout_url(); ?>">
							<i class="fa fa-check-circle"></i>
							<span><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></span>
						</a>
						<?php endif;?>
					</li>
				</ul>
				</div>
			</div>
		</li>
	</ul>
</section>