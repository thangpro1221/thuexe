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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'datbike' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'gG*vD20r<k[Y|OWx:U0>`,[H2xxjbdMOeWrZfZ` 4#{`Xe+l)VbM6!X){ae:/d>d' );
define( 'SECURE_AUTH_KEY',  'W7ukb%L73QY<1dFT?B5}GAL/Y|`,ADg+]C}2dXk bdP0Z&F-@GUZBY`fxUotgx5$' );
define( 'LOGGED_IN_KEY',    '^I]C]Y,E4VIf1}0k])TK4joH_VZ@cOV7F#t@f2oF OZ;n 6b-)c:$VR*{h+Yi`|>' );
define( 'NONCE_KEY',        '6-Pl4(^&YMn7&;obJptp nq{bw0k2omp?WYK];B^1GArpzdfu5SEPa#]!>/|;smp' );
define( 'AUTH_SALT',        '{`Y:3in(H6LVCw$brlrs=!e%Z$*.^-S8hPE.&1a^xsU%tf#spL10YuF_#qk:y<8k' );
define( 'SECURE_AUTH_SALT', 'i|^Ur`JJ8OTj?Qx0Q.:Z}&=gyw}PLts;iqd+i][ocue`R/1{Qo!CjL#o={.G7)GD' );
define( 'LOGGED_IN_SALT',   '2umZ8dxMSpqx$U.4/f/q0Yhzd ?x/8n{Vf`y(>[3UMG`wdAJ}jGP/h0@KMeYS<d`' );
define( 'NONCE_SALT',       'D<gRIznD#yIQumo5[. /VL^d.lYSy8FJTk7Uc;SQc-/j1q@nt7VtxSHqYOL|]Ml}' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
