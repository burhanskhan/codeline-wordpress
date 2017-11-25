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
define('DB_NAME', 'codeline-wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '9UOz<!/B+ts<WaL#9VXv_5.NJ wae9s^]SH$bJ8-6Rn5ur_0c#a9RR{?eceAmEu^');
define('SECURE_AUTH_KEY',  '`4V:*+gr7^z=A/,O|JqZ)VO=Tjb() Mvn:Fx[kH+I(!,={A60!C:H$,>i_PfS84V');
define('LOGGED_IN_KEY',    '5$YB%+IiR@.noVMjgFBBITRGfa-GbR~T3xtmq*AC~d_mbrUC,Z3BV fKI{*zy:Y)');
define('NONCE_KEY',        '}zU;j=:56<7k%B:7I?7<eUA`zE`J#9pj&}`U+]dwL3tgz%rX;(;-B/2pR0]ubU?K');
define('AUTH_SALT',        'En+7qM$OLU+CP@+fU1aA=x[:B+V4oHzB%zaJ8DBp?1Nr_;2@[=TAK/>OI?J|mFlj');
define('SECURE_AUTH_SALT', ')= pCSp?tyG.JZC0e;0~zh7AO+|_D+z52ik@1>x$h4S`c6;=p:<bw3/AdazWe{wL');
define('LOGGED_IN_SALT',   '=cKJpp>%U^Q:$-nZ_7RC_t*zNR8[oUI=DUkc=&*P5,k `Wx`RiWJ:0#`?>c`#u79');
define('NONCE_SALT',       'P8$dmz%VFhq*Ze JwW4e[?<_2hCO+d{6M&HUa11X?Szq.)W|T|Tv^Lc53#nT8M||');

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
