<?php
/**
 * The header lateral template.
 *
 * @since   1.0.0
 * @package Valey
 */
?>
<header id="fx-header" class="lateral bgw pf">
	<div class="flex column center-xs between-xs pt__90 pb__90">
		<div class="fx-branding">
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
		</div><!-- .fx-branding -->

		<nav class="fx-navigation middle-xs" role="navigation">
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

		<?php echo fx_valey_social(); ?>
	</div><!-- .flex -->

	<div class="fx-action-fixed pf flex middle-md middle-sm middle-xs tc">
		<a id="sf-open" class="cb chp" href="javascript:void(0);"><i class="fa fa-search"></i></a>
		<?php if ( class_exists( 'WooCommerce' ) ) echo fx_valey_wc_shopping_cart(); ?>
	</div><!-- .fx-action -->

	<form id="sf-header" class="w__100 dn pf" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="fx-container mt__60 pr">
			<input class="w__100 f__mont" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_html__( 'What do you need?', 'valey' ); ?>" />
			<button class="pa" type="submit"><i class="fa fa-search"></i></button>
		</div>
	</form><!-- #sf-header -->
</header><!-- #fx-header -->