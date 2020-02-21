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
define('DB_NAME', 'newenglandriders_org');

/** MySQL database username */
define('DB_USER', 'a0000975');

/** MySQL database password */
define('DB_PASSWORD', 'ner001');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WPLANG', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '${xy9L-Sj<Y~x$TBYJh<MnoP:Zhk;$6[>s@=G:+d12^g$}k[h<fu:<L2CL.S{@`(');
define('SECURE_AUTH_KEY',  '!g+36SzR+mHhr>W+M1Y|N,QN1SJ6DG^SYDJikt.?Dgwf=wXb&a)?BFf6Gu+wRA|v');
define('LOGGED_IN_KEY',    'Ri-C]]|;$]69w5fx~!(JUXY/m]&kg$+1N{FN|;|8o1/{nPNbEdE/^<61FvE?)U+R');
define('NONCE_KEY',        '|Qkr^]e#lHG~+Gfa.XF3HiUXaR6V+E639b1.!TDDW50u4G2b&J&;iElr16~ZD0&N');
define('AUTH_SALT',        'jx?VX+Q^uvJ.M6qJpqWY#-hD9AU5]OCE~ov58ra?+JVNV-z-KlURCh<<whi?uR{%');
define('SECURE_AUTH_SALT', 'LnRC?B*9t]x+-,&YT=Xg|&WE&`Mu~<+@=9y_S|rL(pzDX|eH6t^~)x-/B)-IF(fv');
define('LOGGED_IN_SALT',   'Th8{(GuPhQ=DmCZ~-?WFFQ:w:*]a..<j>wzN>-n+ vqh|SMCS,1?-J<9$)[?/+tr');
define('NONCE_SALT',       '(]W-:bcP,v.%sj:iME;%afGN RrJ<eyT<~E[qvo=.)H=f=v-+!1sPql]g_9|rZ[S');

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
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
