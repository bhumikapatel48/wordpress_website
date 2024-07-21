<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_assi' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'rt]TM{66ai$GHL1K*=F4jH3A%XNR9Z+UX8-3+jS4p,_pIJj3B)9^kY[b<WrRsM.q' );
define( 'SECURE_AUTH_KEY',  'F7>pFCG7Q.W/zz$Z+3PLgE{m/,{VgEcB=&ks{v*Y; }N)@x1iEQHB}y_eAhV!6?:' );
define( 'LOGGED_IN_KEY',    '.<s-)5;e+4*M_=+6&jIf$<n6uwJsn9w.c~/K|EPur{}WT1VGfjmpl&mJ9$VH>Rpx' );
define( 'NONCE_KEY',        '=%tfg5yg2T=ky1~Ta<:uUd-]O]Xqj-b;u66teE{jE*+_uI=E_RO~5;h=hlUU[d=b' );
define( 'AUTH_SALT',        'gU#.sPmdSCB;m~5g|d`1h}u$+ldm7(.E2.VF.DTQMH*$Scerd8l_6| Z>83Tt!x|' );
define( 'SECURE_AUTH_SALT', '/e@2%a1zMm23@o[}ygV{a;~iw<59R{*G`sULPwiZP]J5#&AlKhCPD>1:XZc)Sff[' );
define( 'LOGGED_IN_SALT',   '29rXR+!#3,%*&V7;src7Jd0<ls^}]+Zy`fIJ]piPGl@:H6}Ft.j7T_(Et /-?kb9' );
define( 'NONCE_SALT',       'C R>L+n*[^v*FEGO:QPak.hFVt7?B6bux+9A|aW@9K8U!UUv.1ORodwvMc(fiaC|' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false ); // Set to false to prevent errors from being displayed on the screen
define( 'WP_DEBUG_LOG', true ); // Set to true to log errors to wp-content/debug.log file


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
