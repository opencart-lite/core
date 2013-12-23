<?php
//Domain
define('DOMAIN', 'core');

//URL
define('BASE_URL', 'http://localhost/core/');
define('BASE_SSL', 'https://localhost/core/');

//Path Mode [MULTI] [STACK] [SINGLE] [DEFAULT]
define('PATH_MODE', 'DEFAULT');

// Path
define('PATH_ENGINE', 'engine');
define('PATH_APP', 'app');

//HTTP
define('HTTP_PUBLIC', 'http://localhost/core/public/');

// Directory
define('DIR_TEMPLATE', __DIR__ . '/app/view/theme');
define('DIR_LOG', __DIR__ . '/engine/log/');
define('DIR_CACHE', __DIR__ . '/engine/cache/');
define('DIR_CONFIG', __DIR__ . '/engine/config/');
define('DIR_COMPILE', __DIR__ . '/bin/');
define('DIR_DATABASE', __DIR__ . '/engine/database/');
define('DIR_LANGUAGE', __DIR__ . '/app/language/');
define('DIR_IMAGE', __DIR__ . '/public/image/');

//Cache ([DEFAULT][FILE] [MEMCACHE] [SESSION] [COOKIE] [APCCACHE] file cache default)
define('CACHE_TYPE', 'DEFAULT');
//Cache Expire (3600 - hour)
define('CACHE_EXPIRE', 3600);
//Cache Session Limiter [nocache] [public] [private] [private_no_expire] ([nocache] default)
define('CACHE_LIMITER', 'nocache');
//MEMCACHE [host][port]
define('MEMCACHE_HOST', '127.0.0.1');
define('MEMCACHE_PORT', 11211);


// Not found
define('_404', '\Controller\Common\Home');

// DB
define('DB_DRIVER', 'PDO');
define('DB_PDO_DRIVER', 'mysql');

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_DATABASE', '');
define('DB_PREFIX', '');