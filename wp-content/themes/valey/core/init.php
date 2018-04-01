<?php
/**
 * Initialize framework and libraries.
 *
 * @since   1.0.0
 * @package Valey
 */

// Theme options
require_once FX_VALEY_PATH . '/core/admin/cs-framework.php';

// Vendor libraries
$libs = 'woocommerce, visual-composer, tgmpa, aq-resizer';
$libs = array_map( 'trim', explode( ',', $libs ) );
foreach ( $libs as $lib ) {
	require_once FX_VALEY_PATH . '/core/libraries/vendors/' . $lib . '/init.php';
}

// Theme libraries
require_once FX_VALEY_PATH . '/core/libraries/516x/hooks/action.php';
require_once FX_VALEY_PATH . '/core/libraries/516x/hooks/filter.php';
require_once FX_VALEY_PATH . '/core/libraries/516x/hooks/helper.php';