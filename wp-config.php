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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'addweb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&])pT@ [E5#}K6^j{!)j L]aTMVrHD95bJhWqL+pE.FgUKaW0<`12h1<xUc5iK#l' );
define( 'SECURE_AUTH_KEY',  'FaY?[fXOaNn6f9_:C{.;fIs/~AL`:JDzxp.;x:m+X9i8/Vnwt.>kH7ol]=d::o/ ' );
define( 'LOGGED_IN_KEY',    'Z+uz1K#{:2CB3wJ}A8Fw{ej734Tu:GJ~dtd!+.QjGbnVsm68ylTjK9HC$,fRq=;{' );
define( 'NONCE_KEY',        '6at]ZS::EF`J(0z0391|~5xK`vUoaEH!>VCV[f,8#s}(y)|F sl)O9244I}rIQ%4' );
define( 'AUTH_SALT',        '[h7<X/x|.DmYKd`NmWoGYfgrE[o}iEU)01v]:9oHR8~9haw1jR/Rrjd*WKsiL|~ ' );
define( 'SECURE_AUTH_SALT', 'hKj#=7w-&zJ[0]=c0`^/yI0aorPT$e4;>zgh9UMd&TL1}H;rg!JzG_E8N*P|8%ay' );
define( 'LOGGED_IN_SALT',   '~1`FHehp,EQh-^x%rAo^b!f^R1p!`{jl?S3&JqCU+!LGo(`(P+:]!tcr!$x^L+r=' );
define( 'NONCE_SALT',       'PT04H$JeE!IPZBp&PP?JV_5>U0nIPR.,8>Y#}<E,h)!s%AUZU*F`FCg=px[bANEZ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
