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
<div class="modal fade bs-search-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<?php get_template_part( 'page-templates/parts/search-overlay' ); ?>
			</div>
		</div>
	</div>
</div>
<div id="page" class="hfeed site"><div class="engo-page-inner row-offcanvas row-offcanvas-left">
		<?php if ( get_header_image() ) : ?>
			<div id="site-header" class="hidden-xs hidden-sm">
				<a href="<?php echo esc_url( get_option('header_image_link','#') ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div>
		<?php endif; ?>

		<header id="engo-masthead" class="site-header engo-header-v3 engo-horizontal-megamenu <?php nautica_fnc_get_header_possition();?>" role="banner">
			<div class="container">
				<div class="row">
					<div class="header-main clearfix">
						<div class="col-lg-12 col-md-12 col-xs-12 relative">
							<div class="pull-left hidden-lg hidden-md engo-mainmenu offcanvas-fixed">
								<div class="btn-toggle-menu version-black" data-toggle="offcanvas">
									<div class="one"></div>
									<div class="two"></div>
									<div class="three"></div>
								</div>
							</div>
							<div class="logo-wrapper">
								<?php get_template_part( 'page-templates/parts/logo' ); ?>
							</div>
							<div class="pull-right text-right header-right">
								<?php do_action( "nautica_template_header_right" ); ?>
							</div>
							<div class="pull-right text-right header-before">
								<?php do_action( 'nautica_template_header_before' ); ?>
							</div>

						</div>
					</div>
				</div>
			</div>
			<section id="engo-mainmenu" class="engo-mainmenu bg-gray-darker <?php nautica_fnc_get_header_sticky();?>">
				<div class="container">
					<div class="row">
						<div class="inner navbar-mega-light"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
						<div class="engo-header-right pull-right">
							<div class="header-inner">
								<div id="search-container" class="search-box-wrapper pull-right">
									<div class="engo-dropdow-search dropdown">
										<a href="#" data-target=".bs-search-modal-lg" data-toggle="modal" class="btn-modal-search search-focus dropdown-toggle dropdown-toggle-overlay">
											<i class="fa fa-search"></i> <span><?php esc_html_e('Search', 'nautica') ?></span>
										</a>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</header><!-- #masthead -->
		<?php do_action( 'nautica_template_header_after' ); ?>

		<section id="main" class="site-main">
