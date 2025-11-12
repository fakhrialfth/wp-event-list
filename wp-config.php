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
define( 'DB_NAME', 'wordpress_event_test_db' );

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
define( 'AUTH_KEY',         'ahc+4n+hH~5L#4z_ONz E{>>5Qe8P*_S8}2M!4[Q8y*6IAZ!y<yKK_g[#)nNO&1H' );
define( 'SECURE_AUTH_KEY',  ',D-_;9%]*#v(lBv(vNe&g2/`4:CsTBgqx@wa{)Z@!h/g1xbu=OX^pHo25g7vBR5v' );
define( 'LOGGED_IN_KEY',    'IRBF0Y[Bns!<Z&riNq]I){WGZ-[ph6%4-ooUr >u,0&P*p#w9na^h1n9,{;hYzx8' );
define( 'NONCE_KEY',        'k<NZAbrPBFyBc9dKCd_x<_?:BU~V$k{5]f90}Zw~Fp`}FG<ndxK4Hj% P5^$Yca+' );
define( 'AUTH_SALT',        '7z_(9>vv9F`H}jZaC}bH,0$g3Ln(wxKW!T(!3o^FYY|5BWkjTq5SJW1k/RhmB<p-' );
define( 'SECURE_AUTH_SALT', 'IFEC6-$]S, Lk~YO%YSyDKig#<^y8)lS^*63~RoI!#Xw~X~T&wpUU*{4q.H#o:VA' );
define( 'LOGGED_IN_SALT',   '2O$!(r[(XpG38;28PgOM]U{SL,1SxcmTtt Xpf*4tSN]mmHE^^7{t<wXm{(downM' );
define( 'NONCE_SALT',       'XCr~~s`k*/0rt+Olx0$(Q[1UHc/: Y;NSlZ1uOM7$d!wc!^L7gQ(KmZ9l/L=L2n{' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
