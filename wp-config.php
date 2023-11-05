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
define('DB_NAME', 'cat.loc');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'ppb8S1trQAYI(f#8Y5m1401M2*gH2NE94uKt9^drmCtpWI*54civ8mpinC7mOhy)');
define('SECURE_AUTH_KEY',  'Vqxe!iodNDZHOKkRl(03Oa@Nud8myAqeDApI12na7T0Wa6LO01jVqrQFa*@pB5OA');
define('LOGGED_IN_KEY',    'DXkvBtZH3zdGFThdeIjwYAwelO2JJEuoGZGDH7HqElocADdBcd4SoyIsria^Hxe4');
define('NONCE_KEY',        'hcHL%YPoTIL0zgswlJgLCgy!G5E6Y3FqJO9bFU42C6kxXh1&(%cv8MKyDMmMyv#i');
define('AUTH_SALT',        'GsM(Oda@qy0LL7E@BE!oOcYDr%wNKF%iC2(o@Y!aduh#paeMHp3*wqFiozJs1ua4');
define('SECURE_AUTH_SALT', 'jcimq@p8sNJj(dyxaHC2fvt03tOkbXQ9sUqQJ0eUIXjdmdM75nAQx(860iiJF85#');
define('LOGGED_IN_SALT',   '^I8pD3WEh#IRqD@qGHYXLCiagIOt&zV9Rkuc&0pC0are7DA&^eFNX5oqt3x79Old');
define('NONCE_SALT',       '*MjNxdDw#OIk8XJeF#PmYyv6D^7MCew6%ugzbvA&qc&*@VjZCZGwNX@5vwOorJP^');
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

define('EMPTY_TRASH_DAYS', false);
define('WP_POST_REVISIONS', false);
define('AUTOSAVE_INTERVAL', 12000);
define('AUTOMATIC_UPDATER_DISABLED', true);
define ('WP_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

define('RE_CAPTCHA_SITE_KEY', '6Le5mNcdAAAAAHtmYqRVXxVrM_jFE9qHmRS8awyS');
define('RE_CAPTCHA_SECRET_KEY', '6Le5mNcdAAAAAD-9TRWKLKLY1g3EadmFDLY2Ac0T');