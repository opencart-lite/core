<?php

// Path
define('PATH_ENGINE', 'engine');
define('PATH_APP', 'app');

// Directory
define('DIR_TEMPLATE', __DIR__ . '/app/view/theme');
define('DIR_LOG', __DIR__ . '/engine/log/');
define('DIR_DATABASE', __DIR__ . '/engine/database/');

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