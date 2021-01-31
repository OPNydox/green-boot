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
define( 'DB_NAME', 'green_boot' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Kamenica9' );

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
define( 'AUTH_KEY',         '/`@;gf%t%65#!vdhl4EJJu+<<<|J8LjYTVp=Cr25(xAxAWSI{.3&:6e)`FfCc[NG' );
define( 'SECURE_AUTH_KEY',  'X)@&q%lWBfDnI*a[]0HC%B,Aa*l0~Dn!;u5UujpO~[F4@eptS8MP {hbc,4kG7v_' );
define( 'LOGGED_IN_KEY',    'egli-I[5PJ<B`@S/u30cY1/i}4BF08/5uUl78_ h{t1P(Q|@6n4/>v0=(-cY9T|1' );
define( 'NONCE_KEY',        'O*.Ln!*&;^qo-BAi_/=b@@qZFQazRQ(l~NHQrgZF&N7y6zUb_`9Tza9Xl7u3jkFw' );
define( 'AUTH_SALT',        'poFiSgrrY.=M.i+]+K@ZZdPwJ!byf2@O0?V2?el@EjQzNs,bVkd!`*BbCL/2w}*+' );
define( 'SECURE_AUTH_SALT', 'i%lTYuG%:s}qy6s5Jeft5;Z.!_;e:0JljAD<&te2u8eE]@0`wygy|.2PO;f0OHP.' );
define( 'LOGGED_IN_SALT',   '/GRYzWQ5W@u@Ttj{r%,u4Jrv_*bOOLQeuuaB&^Fy8 x!BB,sWxn_=l}.?7bYKO]?' );
define( 'NONCE_SALT',       '75;+f]*6u?ss<K_Ql_~}r&YO2Qe~^cZDoZ,ZQ1uC)N6E0l%po]9k~wJ_;|QNTYHK' );

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
