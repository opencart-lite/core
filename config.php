<?php
define('DOMAIN', 'core');

define('BASE_URL', 'http://localhost/core/');
define('BASE_SSL', 'https://localhost/core/');

//Path Mode [MULTI] [STACK] [SINGLE] [DEFAULT]
define('PATH_MODE', 'DEFAULT');

// Path
define('PATH_ENGINE', 'engine');
define('PATH_APP', 'app');

// Directory
define('DIR_TEMPLATE', __DIR__ . '/app/view/theme');
define('DIR_LOG', __DIR__ . '/engine/log/');
define('DIR_CACHE', __DIR__ . '/engine/cache/');
define('DIR_CONFIG', __DIR__ . '/engine/config/');
define('DIR_DATABASE', __DIR__ . '/engine/database/');
define('DIR_LANGUAGE', __DIR__ . '/app/language/');

// Not found
define('_404', '\Controller\Common\Home');

// DB
define('DB_DRIVER', 'PDO');
define('DB_PDO_DRIVER', 'mysql');

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'jomedia123');
define('DB_DATABASE', 'core');
define('DB_PREFIX', '');