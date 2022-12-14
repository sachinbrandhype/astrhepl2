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
define( 'DB_NAME', 'ecommerce' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'astrohelp24db@$' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );



define( 'WP_HOME', 'https://astrohelp24.com/ecommerce/' );
define( 'WP_SITEURL', 'https://astrohelp24.com/ecommerce/' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ExX${t`-a6mBj& Nr4Qr^Or:~;<^!=eOK|Yg7;|gIWnD@ya2w`6Cww?qu[pMrg2%' );
define( 'SECURE_AUTH_KEY',  '+w/C!v9sXlGoIYT)L8eh&I>1[s?7:1^CNnrQ~]YmD@M1I>V*xt(rG5;Q+N!:{*}o' );
define( 'LOGGED_IN_KEY',    'Oir(Sq!_| y4^XpjVlj$I./3]Bu/%Kb1WXlZ<23 [-{V*(_lxOGKito(m>zLHc2k' );
define( 'NONCE_KEY',        'UZ4i(iJR9-FBi!pzsQ5a@,(`}sgDyzWpc-fbut`wAzEllG]_dqh*R5^Qa4|G-<HJ' );
define( 'AUTH_SALT',        'LAF5BZ9j$mxz9JaLr%nxncPYn#[a/z4U#Mi4aVL (CpZW0Yt::;gT3C`M|KsV!rO' );
define( 'SECURE_AUTH_SALT', '|9ca{-Iqo*i`CFvwq)k80W7u1SXF1D]a<dA6B#9@sg/u~/yrRS#V}9`J[Wt`jHP!' );
define( 'LOGGED_IN_SALT',   'T`#hk}{JU<vg8(k~dAxb7>E(fJ~+.<J:h(^Is?dFA~tqkbKx;^-9[DFLV9?Gq(!~' );
define( 'NONCE_SALT',       'u2)c;8Js~,K-BO(Wxf?p`n#S<[L]3T4s@B`=c2/,,sG2N#Q5DK<uzw~6{,t.d-Bb' );

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
