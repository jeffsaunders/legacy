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
define('DB_NAME', 'jandeen');

/** MySQL database username */
define('DB_USER', 'jandeen');

/** MySQL database password */
define('DB_PASSWORD', 'MarMaduke');
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
define('AUTH_KEY',         '->t<`WVt,&Upy]nUXuLaVq~e:c@n`_Tv~c&-9h=bH{D{!.%o9>r+j_UO;v^dO$ts');
define('SECURE_AUTH_KEY',  'D6[*?^qVTz+g{R|++dA|wZ[!L}Ftuo,;Mw<J|troyz(gx _u>WjBo`+oUmcYQ$Ed');
define('LOGGED_IN_KEY',    '=C[T&f,ao-3&:?F9?|x#DL)_F$.otyk*dCG*6nHl7)J=v*YgkFQ?)Mnc9i*sue9P');
define('NONCE_KEY',        '*1H1:D5Sh%&-Y+U1-2DfEXuWR2Fh>$5J2F=Z,N)*|Ba7>Z+^*,]3*Paxa@cB%/@g');
define('AUTH_SALT',        'Q+L&cc~y|[&^`#xcYA zl r/4cd}RQC+E}lv1^&%@oCbd,*x4nHD+AG||1UM|t%2');
define('SECURE_AUTH_SALT', '^.6Xt_hw{him~{k(+_.a^lv!u{L!d`B3.09^[cQ9hIW-g;%LU=-3 9LAoi-95+w.');
define('LOGGED_IN_SALT',   ')dm|e:X*<}0@]{ao`+=134mT]dl/>4.gd Ko<,6ntkw2v^@X+GJ?1_>1<W-Z++@R');
define('NONCE_SALT',       '&AqP,yJkHvx8-iY^>V=2|~STs[]|+)5:l6MeW/W3I-HsU[)a.oB<=c_(a|E10?(E');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'jd_';

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
