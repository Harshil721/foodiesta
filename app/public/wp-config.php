<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '#2iqbErV8ZWwPj%A%LK1`ly?*.zTWrt~?BVe:mr._P249[&_M&OCvs5RMZX%J%.P' );
define( 'SECURE_AUTH_KEY',   'oYoAV>(j-,e_!A4R~7;D:QDQw^TTPv|*_cyDMGiG/pHc!m->c?Jb`1gNv6FlzYN:' );
define( 'LOGGED_IN_KEY',     'o+/3;Q#E%lJZ6lRW8z2@fV605d_mF8hvGq7{g$oR,PhbDN%3;40mo{)*C6!BDQ?C' );
define( 'NONCE_KEY',         '%MPYsW-z9~(MF,e0S5d=girQ83/;dUuh*$v0A-0L?uG,KOtz`*Cf`x`r@|IfoJOp' );
define( 'AUTH_SALT',         's5hl;3sRsB|1tIVXRJI7kK#|vH5FzX!I.J$~jcQl62l=&t#UTO$v/^P0tY#i2z({' );
define( 'SECURE_AUTH_SALT',  '`$12C,sxAC,9`rQ(i7k9-(>LaghJvdeHmrr7( 1P,MitxCz7r]#6nt()5cG}2u-M' );
define( 'LOGGED_IN_SALT',    '}JQ~lqfBFBH!0xY&min#|!I %n51P7U)yH zemn{:Og/Rj4/8GXl&!^e[87Wm>> ' );
define( 'NONCE_SALT',        '0RNTj.c3<,!8WuWvdj2EBlb>V,j{|qvxK6vNB:azW|,R6!q+#:~WlHDPP3^w*bc/' );
define( 'WP_CACHE_KEY_SALT', '6h4,mJ7iuq[/p!%o9m8Jcl+o%A-~^cz:cv8]3YtVT.&GQu=NPJ(i=1o&R+s%F)y~' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
