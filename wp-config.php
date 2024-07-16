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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'drNi`tFo?Ngrj;V=L*u;%*X^`n^*Vui50%T2Z2aPPdJWTos,Ap;_vVgp?*_7nYRc' );
define( 'SECURE_AUTH_KEY',   '+X.a~KK^p{+[G<L.mqim&L/vUc&`V!Hm Z.}J@>k2 svgfN@<7uq5F,-tZ_3sxVh' );
define( 'LOGGED_IN_KEY',     'U;@QCrtu-}*@?n<OKtM&S(;al0x_TI!-#6cg{Fus+PVP4b`I;,qTqD,Pw}>`GDtP' );
define( 'NONCE_KEY',         'kGL5>vRd8o5A$pJ+P<rN*j;2]icIf<[{rZCC<oWZ<wUWUI>QB!94LV1vuUk(j3[;' );
define( 'AUTH_SALT',         '1L@+sD(l *wbRa:+_R`^e%n/RgAFpC+r>[w1m8YFA3ZL-:X0T$9{|Hv4*}X,Q0uR' );
define( 'SECURE_AUTH_SALT',  'm5QnX1Ge~?hr?cCq>>at&ifsoE@ )?5n[H:$i3yr75U+0(Ve.a;8<4w:6Eh>l6!]' );
define( 'LOGGED_IN_SALT',    '&:(r8yI8h<;6CPsz+{O5D<,%hSh4Lv9K5]TqznHt[iF[Gq&e)S.NQ/D[DV,b95|^' );
define( 'NONCE_SALT',        'aDNo{p6ih46dW@m3FDrCoq$>o;{*jD@>/zcA[S%MA:@Y3Apjw c^_%{CSit~vEjU' );
define( 'WP_CACHE_KEY_SALT', '$qwK-]K4/d[I;7R0`33n/vI>@v8jeXJ|cJTXDw>/3M2-,,wq;4OuV7D)&A{ .;3 ' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
