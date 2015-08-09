<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'skips_stage');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'khenham');

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
define('AUTH_KEY',         'g~Rdj+rZ^38vne ]$+I tx97J!w6G7miC`,aF|IUpr/yGW]5v:`|g=?d$o~KXl Z');
define('SECURE_AUTH_KEY',  '-?7uG>U)L^f.lhI93b|E3#t#Mp|on?lB6qiLpZ+_*X-[x:`+V.>wP?tMmeoZI5]@');
define('LOGGED_IN_KEY',    'q)E<zi-ao+@5GY|a.zPk4ka5`KCURoF<nZS4Ta]-_%$w]X|XyS;[vSL|N]1Go9L(');
define('NONCE_KEY',        'P_=J %%:l~]D6@S:nlB+pcfO4qs&7fvS%#]=d%v-%TK<227{}WL|:eOMMBUGd.~C');
define('AUTH_SALT',        ';By/0.]PQ|**JwN.tcZtbx~J?~jz+x-&J<iN&P2J6Se;O[Fp#@ZIj@(Yh!oMjd&^');
define('SECURE_AUTH_SALT', 'Z13ii/@Wj5wAh5[o?-!+~|_Kt#2P$n,$M]v^K,ocK-3X4IWr|pbLr1x3kI6 xBNv');
define('LOGGED_IN_SALT',   'ag~<_oTB/2?4w.AKcU<$$|:CBTa-O6s}G]u)(y~_{bypy8yi FC]se0W]eNtWBtY');
define('NONCE_SALT',       '8ev l)3JMzx-eTVsMmiC: $,N.=aW.p/Cv`r(> )QtCiGn7CGVUwDi^71LP;!F2J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

