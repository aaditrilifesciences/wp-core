<?php
/**
 * The header classic template.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
<header id="fx-header" class="classic">
	<div class="fx-container fx-row wide middle-xs between-xs">

		<div class="fx-branding flex middle-xs">
			<a class="dib" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
					if ( cs_get_option( 'logo' ) ) :
						$logo = wp_get_attachment_image_src( cs_get_option( 'logo' ), 'full', true );

						echo '<img src="' . esc_url( $logo[0] ) . '" width="' . esc_attr( $logo[1] ) . '" height="' . esc_attr( $logo[2] ) . '" alt="' . get_bloginfo( 'name' ) . '" />';
					else :
						echo '<img src="' . FX_VALEY_URL . '/assets/images/logo.png' . '" width="88" height="15" alt="' . get_bloginfo( 'name' ) . '" />';
					endif;
				?>
			</a>
			<?php if ( cs_get_option( 'canvas-sidebar' ) ) echo '<a id="sb-open" class="dib cb chp ml__20" href="javascript:void(0);"><i class="fa fa-bars"></i></a>'; ?>
		</div><!-- .fx-branding -->

		<nav class="fx-navigation visible-md hide-xs" role="navigation">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'fx-main-menu clearfix f__mont',
						'container'      => false,
						'fallback_cb'    => NULL
					)
				);
			?>
		</nav><!-- .fx-main-menu -->

		<div class="fx-action flex middle-md middle-sm middle-xs">
			<a id="sf-open" class="cb chp" href="javascript:void(0);"><i class="fa fa-search"></i></a>
			<?php if ( class_exists( 'WooCommerce' ) ) echo fx_valey_wc_shopping_cart(); ?>
		</div><!-- .fx-action -->

	</div><!-- .container -->

	<form id="sf-header" class="w__100 dn pa" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="fx-container mt__60 pr">
			<input class="w__100 f__mont" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_html__( 'What do you need?', 'valey' ); ?>" />
			<button class="pa" type="submit"><i class="fa fa-search"></i></button>
		</div>
	</form><!-- #sf-header -->
</header><!-- #fx-header -->