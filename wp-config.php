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
define('DB_NAME', 'testplugin');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         '1LBfjnIUM?MGA`iq8) d 0*9ZbAc3QPAOp0gtGHGW!]G./T$@BPi>v}S[5Axx7D$');
define('SECURE_AUTH_KEY',  '9DN:(J_{A/K4 J4[8c&sp02QEogcXo)~|=f|;I:kWYuN+48,E?i~.[T>y >RHqj_');
define('LOGGED_IN_KEY',    '+0)4F0;ok]*>H,+&2o:;.F;<NYNsiss,K?}y,$Dx4V%]3jx[*=7]eL&D{y{G_gbM');
define('NONCE_KEY',        '5ebxx+w+J+/CIoFt-K0^G5gtfyCw|pJhMuf&:Wm3BzlK]I?U@_Xl/ Xt{U@0*e-r');
define('AUTH_SALT',        'aM<dwL*{8]MHi8JD5%3CsB%1(wj[MI4?3o[m9tH7~^h_N=`[;y;/K69<O*-Q9)9)');
define('SECURE_AUTH_SALT', '+wy0 hKy6o%7&(Y{?N.};Gl*wd&(xt[0q[,~&v#])-A#xc_*N(aB-K#_0YJd;2~_');
define('LOGGED_IN_SALT',   'f0tl{?|?wPbnsBV&IHEDvv$9Xnha12F_xNqpj<7/)Q/CSEO<>0`:YtrdwXyO!`gF');
define('NONCE_SALT',       'Lg*U)IY8=9Sz=4BO?%)X?e.ZcSBy0pkD714K]V],`Enm;t_)KBFw~%s{p(#5-{,a');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('WPCF7_AUTOP', false); //tắt tính năng tự động thêm thẻ <p> và <br> (gọi là “auto paragraph”) của Contact Form 7