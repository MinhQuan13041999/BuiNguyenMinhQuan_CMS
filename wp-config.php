<?php
/**
 * The base configuration for WordPress
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_buinguyenminhquan' );

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
 */
define( 'AUTH_KEY',         'v7sB@3$k!mP9(qZ8#wX1&eR4*tY2)uI5%6$gH2@jK9!' );
define( 'SECURE_AUTH_KEY',  'bN9&mQ2$xW4(rT7*yU1!iO5@pA8#sD3^5%fG1#hJ8*' );
define( 'LOGGED_IN_KEY',    'kL4#jH7*gF1@dS3$aZ9(xV2&bN5!mM8_4(rE9$tY7@' );
define( 'NONCE_KEY',        'qW1!eR3#tY5$uI7%oP9^aS2&dF4*gH6+3)wQ8!eR6#' );
define( 'AUTH_SALT',        'zX9(cV2&bN4$mM6!lK8#jH1*gF3@dS5-2*uI7^yT5%' );
define( 'SECURE_AUTH_SALT', 'pO7^iU5%yT3$rE1#wQ9!aA2&sS4*dD6=1&oP6%uI4$' );
define( 'LOGGED_IN_SALT',   'mM5!nB3#vC1@xZ9(lK7*jH2$gF4&dS6~0^aZ5$qW3#' );
define( 'NONCE_SALT',       'rT8*yU2(iO4@pA6#sD1$fG3%hJ5^kL7?9#lK4#pA2!' );

/**#@-*/

/**
 * WordPress database table prefix.
 */
$table_prefix = 'wp_';

/**
 * Dynamic URL configuration for seamless local access
 */
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$protocol = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ) ? 'https://' : 'http://';
	$uri = $_SERVER['REQUEST_URI'] ?? '';
	$subfolder = ( strpos( $uri, '/wordpress' ) === 0 ) ? '/wordpress' : '/BuiNguyenMinhQuan_CMS.git';
	define( 'WP_HOME', $protocol . $_SERVER['HTTP_HOST'] . $subfolder );
	define( 'WP_SITEURL', $protocol . $_SERVER['HTTP_HOST'] . $subfolder );
}

/**
 * For developers: WordPress debugging mode.
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
