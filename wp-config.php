<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';



// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

// wordpress == porto
// bpo-live == salient

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'changeme_wp' );

/** Database hostname */
define( 'DB_HOST', 'db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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



define('AUTH_KEY',          'N5*jk4&0+Qca@W>Xc?6cA^r%(jd[}m,{Ag6Z[Rn_Es#[M;.A&NB}bi2Zf %E[xhj');
define('SECURE_AUTH_KEY',   '8(a<Z}`NGs7tKqI FuCJb]@aS*Cw8$CHVdy$KD#NO*.+_k@%eN:PteMv.S~|Np60');
define('LOGGED_IN_KEY',     ',:P8V3soO4#WT1k-I-w6!x*qJ 9l ;k~jC]~@k5>_V|V-nj#|]2IZX*s,+`VOz6(');
define('NONCE_KEY',         '{%F8B3)ZbSqEs krvd[aIPn24OxFMW}$1X0sf(6HIZv^BF~v:jBk~c^e=&|)WoeH');
define('AUTH_SALT',         '![@ jrK&pS7m,2&]V/zx&}ZkUiuA~)=YDFki>?%MmLJ?;W1LzXW}pQ+NfKA?Nxqy');
define('SECURE_AUTH_SALT',  'P/lwJF+,IYhcHGGOK:G#b95`|q3<`c8=XQW,I=l7h!+Awp;!7>HQ{0lYZiN2]-#N');
define('LOGGED_IN_SALT',    '>O,ZpQ]Y/g7qAApqy_Dk<hLk<+{<kZ@FTU?0FpQ_>}RrT.GXtC ~ldZX:-QMDqdG');
define('NONCE_SALT',        '(#;~D}Awl%n-j:WTf/z(<P@ nJ?PTMY-#GtPblfnHAi6?^VQIuIJvmlAm*w%A.c ');
define('WP_CACHE_KEY_SALT', 'y&?q>/wcAx/X87<<Fl%R;?$wd3523MU ::OZ]k(,zYqw^ooSHxJ7#UIDo@`Hzk:-');


/* Add any custom values between this line and the "stop editing" line. */

define('FS_METHOD', 'direct');


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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}
if ( ! defined( 'WP_DEBUG_DISPLAY' ) ) {
	define( 'WP_DEBUG_DISPLAY', true );
}
if ( ! defined( 'WP_DEBUG_LOG' ) ) {
	define( 'WP_DEBUG_LOG', true );
}

// Show raw PHP errors instead of WordPress's "There has been a critical error" screen.
if ( ! defined( 'WP_DISABLE_FATAL_ERROR_HANDLER' ) ) {
	define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );
}
error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

