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
define('DB_NAME', 'wp_alven');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '6 {<5;/]8,5W,4@h7=;#g]bAY)P{OX|Ol[c%5A>_1xk}fBeFk!0El,5MFc~[eEAl');
define('SECURE_AUTH_KEY',  'lZd#o[C]&lAL0><pHvlSRbivrqO2/6`ohmWcH.P6T`.w1Vf!-{5q]jM&p[%2W@it');
define('LOGGED_IN_KEY',    'r{~v8xb#1jkYH#Iql#4-r8,yC57b:qR58.Z%KR~&|d&DwRCA~*QU#3:b]MBYvWb_');
define('NONCE_KEY',        'jFe2YE`^Kf%e$Z.d<(u|}F_W(N7D=*M,A*ZkWF<W4V2.rx%bGhL9GJGE.Cqc,+I ');
define('AUTH_SALT',        'svfn@R2dGLxKGnC:NT3Cj8Mqj:tiACM<uUy=PFHo#+2o~t3cEdE7Akcv.W aod$S');
define('SECURE_AUTH_SALT', '^Syz9j/A5`eQlwhG@VuB;sPLD1#4ylb)l1_:Q,qx,pVl+FYp5*J)7Ug{SFIogYZ9');
define('LOGGED_IN_SALT',   '..1UzI~SO(m5iFG8%v_>Hb10vT^gb;}{Hz(uG/y;cDAQY2 rwmvwIJ$zAhwNO?E]');
define('NONCE_SALT',       '>`)N#/V:ZT/l!j&uUJzT*umJ`Jv:w[rtrBue%FH:O:5 ?6q +!lQ YuL}BT@S{~F');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'alv_';

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
define('WP_DEBUG', true);

define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 10);
define('WP_AUTO_UPDATE_CORE', true);
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
