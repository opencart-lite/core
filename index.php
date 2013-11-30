<?php namespace ION;

use \Engine;

// Version
define('VERSION', '1.0.0');

//Config
require_once('config.php');

//Startup
require_once('engine/startup.php');

// Loader
$loader = new Engine\Core\Loader();
\Engine\Core\Registry::set('load', $loader);

// Database
$db = new \Engine\Library\DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
\Engine\Core\Registry::set('db', $db);

//Config
$config = new \Engine\Library\Config();

// Settings
$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `group` = 'config'");

foreach ($query->rows as $setting) {
    if (!$setting['serialized']) {
        $config->set($setting['group'] . '_' . $setting['key'], $setting['value']);
    } else {
        $config->set($setting['group'] . '_' . $setting['key'], unserialize($setting['value']));
    }
}

\Engine\Core\Registry::set('config', $config);

// Request
$request = new \Engine\Library\Request();
\Engine\Core\Registry::set('request', $request);

//Response
$response = new \Engine\Library\Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
\Engine\Core\Registry::set('response', $response);

//Document
\Engine\Core\Registry::set('language', new \Engine\Library\Language('english'));

//Document
\Engine\Core\Registry::set('document', new \Engine\Library\Document());

//Encription
\Engine\Core\Registry::set('encryption', new \Engine\Library\Encryption($config->get('config_encryption')));

//URL
\Engine\Core\Registry::set('url', new \Engine\Library\Url(BASE_URL));

//Cache
\Engine\Core\Registry::set('cache', new \Engine\Library\Cache());

//Session
\Engine\Core\Registry::set('session', new \Engine\Library\Session());

//Log
\Engine\Core\Registry::set('log', new \Engine\Library\Log($config->get('config_error_filename')));

//View
\Engine\Core\Registry::set('view', new \Engine\Core\View());

//Action
$action = new \Engine\Core\Action();

//Front
$fc = \Engine\Core\Front::getInstance($action);

//OUT
$response->output();