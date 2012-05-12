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
define('DB_NAME', 'wpdb00');

/** MySQL database username */
define('DB_USER', 'wpdb00');

/** MySQL database password */
define('DB_PASSWORD', 'half00moon');

/** MySQL hostname */
define('DB_HOST', 'mysql-wpdb00.yogastlouis.com');

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
define('AUTH_KEY',         '-;ucUG`J$D41n-c^3FE2(UDNP0FuAd$yH+qXk0`_1?|8LX10NlyPrYZ`8NG2,qBl');
define('SECURE_AUTH_KEY',  'E<&^H:Q{-LTZF}|Qb_vNxg ,oiRy597^06bA`lU)D|H7]<2f^$Q{In]%GryvL6>:');
define('LOGGED_IN_KEY',    'Z+&Oma+M@uSt|WxnhU(bv*uWM}MD*MNPZAFe;#{a(fa|k>@7+[(^wUi`&li~Ad_`');
define('NONCE_KEY',        'Gv$u]BkGbr>cJ+Hg,^:9D|>-[i/Z#1wMH?|Jlk[`y5mfL%Ce5{?vbX`Z|W:U|0{]');
define('AUTH_SALT',        '-X!o>+/VECs%-*?WDP1<DcPbna$g>_$XvnFaU5dSK.q%volhcv;*2(``&S$z1qu5');
define('SECURE_AUTH_SALT', 'c:7^$]t_{:?kzoXobTL{9f_06-MOr_iLeG(VS`ps`P}n :{N]*|B>[{~l|saKMxX');
define('LOGGED_IN_SALT',   '1w~j.}>}~@^)=Qp;BsmH~mkP8{%:e(y)f_}1W7KFvMcIgOjPGGn5v}oEY- gq?iV');
define('NONCE_SALT',       'iG>%18!1|7WJ4 q59|.[>0i)Mh~.z_RKJ=SO5-(Zj4UjaBJ{<P><7poL+j++(T?x');

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
