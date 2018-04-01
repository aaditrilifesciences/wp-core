<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'aaditri');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-79KP0gE0rGT-de9#yBO+:jJrh]mS|[Rdz+j6laZkEnvF=faw> 6|,+,cEca}Sr-');
define('SECURE_AUTH_KEY',  'q0tSKd).+_iQlBPf_v8;KI(+$?w2UR@|`6Vu^*.Z<8s2h3dBZ1`d~ux*wgua.NF|');
define('LOGGED_IN_KEY',    'X|VBJ-yJ#--BYs=V,lpA;/%-M t.|vr(Vb_Md1=u^&s_KvsI{)yw%yD05<G`b(nj');
define('NONCE_KEY',        ':k})%|mfdio$tIe*JTl+VGM~H8|21A32I tU{=:nZ~3OW wXlX`EuQJK/zD+6kjR');
define('AUTH_SALT',        '+`3xWS1TpGpWkh@@!1+-:-1~|HB,h31R.-M*{-e][++$LbM29X;kH~[l0JR?51&a');
define('SECURE_AUTH_SALT', '01P/[6(0+bU/Hq@vyZQ{Z*,thz{7UD V&,_|Ht)[R9y|U.+::5uc+eiW|M[ rm_C');
define('LOGGED_IN_SALT',   'nTD;g9M;REH*nH/h*`6VHLshF&:)h|-h7/<!?|)4@:0e;rf`TT.)jLul%mPQpgT;');
define('NONCE_SALT',       '@|&W&X@klh5olHMX3&pb@iXYN+[tg&6?b:Cn`no?<.o<Wh&R6|v$+N)rjPTFczss');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

