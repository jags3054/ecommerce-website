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
define( 'DB_NAME', 'diwaliworld' );

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
define( 'AUTH_KEY',         'M0J~PfGZeh]b4NucJR)$q<^MWom~ !tF`~039$c9eX*4O0]4#r-|X.`I:$rOlQ,5' );
define( 'SECURE_AUTH_KEY',  'IH_%[tK]k,1Z>]X<x2V5F:)|7[r?(Ke$*bWzNetI^oA:;NyiTe(=@[71//lYTwU1' );
define( 'LOGGED_IN_KEY',    'Sd!0j!ZyU|C-RC+)N{*qB:69n(b)Yeh2b[5c/O&2#/H| Br:N70[.VQVEb|ScoX ' );
define( 'NONCE_KEY',        '^J!e/!5t=ROeYd6}s*#P _(z`|pU9 [)O=AQ<`KD-u`o/ZY6cw6%c<kgA2t?f*`/' );
define( 'AUTH_SALT',        ' Fg-,Gwq;qY/E]W!oMc}^H6gzHq8^z?ubS[qQ1LQ.3uvVa5xUATF5dtbZy9@yM[j' );
define( 'SECURE_AUTH_SALT', '`q5gzE1`GgS?aC!4-82uNtel!dl)rGX2<ynUM.y]|q6/}lN$lf[E4JqN5SD^.o,x' );
define( 'LOGGED_IN_SALT',   ')}zUj/3F;r%ON5r|!3s?@j=-O~;:v<3:<RTY~HF0Z@nQ7#jF`X`#@7s@fZc4:yh#' );
define( 'NONCE_SALT',       'Y0I;7_7QazK*5]5aVJC`YlO~R,y([FEK@<$`%GaORG2b7  q%lbp9?*1HXAb}itt' );

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
