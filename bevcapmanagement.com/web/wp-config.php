<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bevcap');

/** MySQL database username */
define('DB_USER', 'bevcap');

/** MySQL database password */
define('DB_PASSWORD', 'BevCap0308!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'v]&t_ :1xRW8QFju[;c9dYm9yLdPuPMq5f1P.F;-rCYWOT?UL% s&77Jw?~*&7)g');
define('SECURE_AUTH_KEY',  'xFs%-0y=hY]{hwi_z&aW%/#|0bZPblH{:_.HJv0~yA.J^1`qtKO_2Sm?7Ve]h?X+');
define('LOGGED_IN_KEY',    '^lRHa^sF//P{>Zp%k7[ARl_Cnr#h.vjQ7|X&=IB=jd7v<(.+?3_f5?2sK ZgiBt-');
define('NONCE_KEY',        'w-RLn4=GS}2$k6VMpbW0fP_-KVJtoR`&vc>!7yb2g0z<2;:609{$j45dNW1_t,OE');
define('AUTH_SALT',        'w#})#;krhYTmsp^`_4biSmK&gi@OkV2`~.#vmp}-tfp2e6ysoCBcEAGx$So/S} 7');
define('SECURE_AUTH_SALT', 'l*KO*SKRvEZT4cgwHc5T,1W%T[@<oiA!8bD|0g*n)2M)p|~+9T*Ps&[iGv_L>e`B');
define('LOGGED_IN_SALT',   '6(9+Uyfp<f;OJwoDTFoXi[*b8O9><P(S2twJ(|0Pfm4_ch&x%bG(MZMCuw*ry:~M');
define('NONCE_SALT',       ',|Y7@S^a~I%A{J:p[sbKT<Cg2_jI`&0Z?Hg]&IylB.uWu;Efr6VIP)JGz*]!=L h');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
