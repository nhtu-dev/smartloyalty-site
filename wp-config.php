<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'devt0944_smartloyaltyvn' );

/** Database username */
define( 'DB_USER', 'devt0944_smartloyaltyvn' );

/** Database password */
define( 'DB_PASSWORD', 'pZ2$Q,upn_mJ' );

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
define( 'AUTH_KEY',         '6RxBciUkp]W5@^E])5Zp(P..&U>!JcuOAqv=i~}yx6q@e9O|>2mV99tP AtGSNa3' );
define( 'SECURE_AUTH_KEY',  'j:.qS([|Dr3+-Px+t:%-Y?sHbL@q?0CS 94lh9m%(iWw#v38,JR%6X1=uFbBO%e(' );
define( 'LOGGED_IN_KEY',    'E<@fhb:BZ*VEm_tVM/vV`w.6yyvw/8jeg6Ecv}#}_;> %w%%L~P)LyyS*M[hP5/_' );
define( 'NONCE_KEY',        'kQ*-MFX~>eYp)DdgXa{30~+1ch}l{iz+B~+WbLw6:t0nkBv)%(U82NL.&Dgy<@f6' );
define( 'AUTH_SALT',        'ijp[cvBTBPE0or-pt:_2qPl%#kYpYdyedY>DQH{jiuKiR~[3~Tsez0]p)Xc62qGa' );
define( 'SECURE_AUTH_SALT', 'n8N[Cn+7 G>4ZsNF}q>q@c *p(-ir`5WU6p>,zGy9%,9ImuXv<QVvYR`LKiJ )*_' );
define( 'LOGGED_IN_SALT',   'MvSfi[#0to5twT7QN5/J,N%tD[j->{!c_L+*|.X>hh|Z!0sqUIsNhfto|9##Yd5+' );
define( 'NONCE_SALT',       'n4PsYukEs%1Q&IPc9KM9GqcvZjAa5G`2mkNU)FCgE/mdUKMlP/4MH8gQn#.p:|>|' );
define( 'WP_AUTO_UPDATE_CORE', false );


/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
