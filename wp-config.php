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
define( 'DB_NAME', 'nhcpnmp_wpdb_nhcp' );

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
define( 'AUTH_KEY',         'T%>r)JVkxrW?Av*b*!_q6Hr3$/i0I[p&{P}lW)xGCfw<eWU(RV8(^bQ.6o3TU oy' );
define( 'SECURE_AUTH_KEY',  'FI&s1P6ey1YDluqobM2;V.))pe}bLkDStTf@e~qOdxgL8:j1?FAau#l@W,5g2A*r' );
define( 'LOGGED_IN_KEY',    '0|zA</Pd#mV[vSagOS.#,h}yqdd#{V!~jG|97 lYGO5CRypdoWAgqy1mM$eRHI w' );
define( 'NONCE_KEY',        'Tgw{hoP2d!]Vt!f k#& t}#c3Gy+x7?%k Rv]lAxEbmmXwSuZrvXU?eXKy?@ 9cf' );
define( 'AUTH_SALT',        'hI=a!~=9&#VR01.9KRg%d>r0ZZ]EVKY{UicD5?Sdjyz%6c5;%_hF,o=X2:HXZW|[' );
define( 'SECURE_AUTH_SALT', 'F<63/v@;-W1K3WG/v;;CZrtUQw4H,CPV4a3v[UW7s;24Ln.S.L,YF*F;f :$2Zeb' );
define( 'LOGGED_IN_SALT',   'w7(7O+VLa+.Z&YjT@}>3;DJHpe/Bz&m:{O<eIJn9P.rMF4m_f;&IF~SZD?q&bE7X' );
define( 'NONCE_SALT',       '$^QvhW/?9QVku2.qql%e:dZU8]K8/?]mB-,H!@)q2+(N8V!.|%R;(Qk}Ieko9E;*' );

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
