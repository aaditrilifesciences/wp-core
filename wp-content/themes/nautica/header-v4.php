<?php
/**
 * The Header for our theme: Top has Logo left +  Search + shopping cart right . Below is horizal main menu and search
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Engotheme
 * @subpackage Engo_Theme
 * @since EngoTheme 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site"><div class="engo-page-inner row-offcanvas row-offcanvas-left">
		<?php if ( get_header_image() ) : ?>
			<div id="site-header" class="hidden-xs hidden-sm">
				<a href="<?php echo esc_url( get_option('header_image_link','#') ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div>
		<?php endif; ?>

		<header id="engo-masthead" class="site-header engo-header-v4 engo-horizontal-megamenu <?php nautica_fnc_get_header_possition();?>" role="banner">
			<div class="container-fluid <?php nautica_fnc_get_header_sticky();?>">
				<div class="row">
					<div class="header-main clearfix">
						<div class="col-lg-12 col-md-12 col-xs-12">
							<div class="pull-left hidden-lg hidden-md engo-mainmenu offcanvas-fixed">
								<div class="btn-toggle-menu version-black" data-toggle="offcanvas">
									<div class="one"></div>
									<div class="two"></div>
									<div class="three"></div>
								</div>
							</div>
							<div class="logo-wrapper is-face">
								<?php get_template_part( 'page-templates/parts/logo' ); ?>
							</div>
							<div class="pull-right text-right header-right is-face">
								<?php do_action( "nautica_template_header_right" ); ?>
							</div>
							<div class="pull-right text-right header-before is-face">
								<?php do_action( 'nautica_template_header_before' ); ?>
							</div>
							<section id="engo-mainmenu" class="engo-mainmenu">
								<div class="container">
									<div class="row">
										<div class="inner navbar-mega-light"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
									</div>
								</div>
							</section>

						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->
		<?php do_action( 'nautica_template_header_after' ); ?>
		<section id="main" class="site-main">
