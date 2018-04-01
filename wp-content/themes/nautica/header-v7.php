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

		<header id="engo-masthead" class="site-header engo-header-v7 engo-horizontal-megamenu <?php nautica_fnc_get_header_possition();?> <?php nautica_fnc_get_header_sticky();?> no-sticky" role="banner">
			<div class="container-fluid">
				<div class="row">
					<div class="header-main clearfix">
						<section id="engo-mainmenu" class="engo-mainmenu">
							<div class="inner navbar-mega-light">
								<div class="pull-left hidden-lg hidden-md engo-mainmenu offcanvas-fixed">
									<div class="btn-toggle-menu version-white" data-toggle="offcanvas">
										<div class="one"></div>
										<div class="two"></div>
										<div class="three"></div>
									</div>
								</div>
								<div class="hidden-sm hidden-xs btn-toggle-menu engo-toggle-menu-position version-black" data-style="version-black" data-merge="engo_pageable_container">
									<div class="one"></div>
									<div class="two"></div>
									<div class="three"></div>
								</div>
								<div class="engo-horizontal-fixed-screen">
									<?php get_template_part( 'page-templates/parts/nav' ); ?>
								</div>
								<script type="text/javascript">
									jQuery( document ).ready( function() {
										/** Intro product carousel static screen - full height **/
										var $window_h = jQuery(window).height();
										jQuery(window).load(function() {
											/** toggle menu header v7 **/
											var toggle_background = jQuery(".engo-toggle-menu-position").attr("data-style");
											var nav_mega = jQuery(".engo-horizontal-fixed-screen nav.navbar-mega").children(".navbar-collapse");
											var btn_toggle_mega = jQuery(".engo-toggle-menu-position");
											jQuery("body").append("<div class='engo-menu-toggle-background'></div>");
											jQuery(".engo-horizontal-fixed-screen").addClass(toggle_background);
											nav_mega.css({"top":($window_h - nav_mega.outerHeight())/2});

											var header_fix_h = jQuery("#engo-masthead").outerHeight(true);
											var footer_fix_h = jQuery("#engo-footer").outerHeight(true);
											var wpadminbar = jQuery("#wpadminbar").outerHeight();
											var height_fix = $window_h - header_fix_h - footer_fix_h - wpadminbar;
											jQuery(".engo-static-screen-height").css({"height":height_fix});
											jQuery(".owl-carousel",".engo-static-screen-height").css({"overflow-x":"hidden"});
											jQuery(".widget_product_intro .image img").css({"height":height_fix,"width":"auto"});
											jQuery(window).on('resize', function(){
												$window_h = jQuery(window).height();
												var header_fix_h_resize = jQuery("#engo-masthead").outerHeight(true);
												var footer_fix_h_resize = jQuery("#engo-footer").outerHeight(true);
												var wpadminbar_resize = jQuery("#wpadminbar").outerHeight();
												var height_fix_resize = $window_h - header_fix_h_resize - footer_fix_h_resize - wpadminbar_resize;
												jQuery(".engo-static-screen-height").css({"height":$window_h - header_fix_h_resize - footer_fix_h_resize});
												jQuery(".owl-carousel",".engo-static-screen-height").css({"overflow-x":"hidden"});
												jQuery(".widget_product_intro .image img").css({"height":height_fix_resize,"width":"auto"});
												nav_mega.css({"top":($window_h - nav_mega.outerHeight())/2});
											});
											btn_toggle_mega.click(function () {
												jQuery(this).toggleClass("on");
												jQuery(".navbar-collapse").toggleClass("open");
												if(btn_toggle_mega.attr("data-merge")) {
													var merge_element = jQuery("."+btn_toggle_mega.attr("data-merge"));
													if(merge_element.length > 0) {
														var toggle_top = jQuery(merge_element).offset().top;
														var toggle_right = jQuery(window).width() - jQuery(merge_element).offset().left - jQuery(merge_element).outerWidth(true);
														var toggle_bottom = $window_h - jQuery(merge_element).offset().top - jQuery(merge_element).outerHeight(true);
														var toggle_left = jQuery(merge_element).offset().left;

														jQuery(".engo-menu-toggle-background").css({"position":"absolute","top":toggle_top,"right":toggle_right,"bottom":toggle_bottom,"left":toggle_left});
													}
												}
												jQuery(".engo-menu-toggle-background").toggleClass("show "+ toggle_background);
											});
										});
									});
								</script>
							</div>
						</section>
						<div class="topbar-actions">
							<div class="pull-right text-right is-face-top header-right">
								<?php do_action( "nautica_template_header_right" ); ?>
							</div>
							<div class="pull-right text-right is-face-top header-before">
								<?php do_action( 'nautica_template_header_before' ); ?>
							</div>
							<div class="logo-wrapper is-face container-fluid">
								<?php get_template_part( 'page-templates/parts/logo' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->
		<?php do_action( 'nautica_template_header_after' ); ?>
		<section id="main" class="site-main">
