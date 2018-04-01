<?php
/**
 * The sidebar containing the main widget area.
 *
 * @since   1.0.0
 * @package Valey
 */

if ( is_active_sidebar( 'primary-sidebar' ) ) :
	echo '<div class="sidebar mb__55 mt__50" role="complementary">';
		dynamic_sidebar( 'primary-sidebar' );
	echo '</div>';
endif;