<?php namespace ION;

use \Engine;

// Version
define('VERSION', '1.0.0');

//Config
require_once('config.php');

//Startup
require_once('engine/startup.php');

// Request
$request = new \Engine\Library\Request();
\Engine\Core\Registry::set('request', $request);

//Response
$compression = 0;
$response = new \Engine\Library\Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($compression);
\Engine\Core\Registry::set('response', $response);

// Database
$db = new \Engine\Library\DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
\Engine\Core\Registry::set('db', $db);

$db->exec('SELECT * FROM test');

/*
// Settings
$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting");

foreach ($query->rows as $setting) {
    if (!$setting['serialized']) {
        $config->set($setting['key'], $setting['value']);
    } else {
        $config->set($setting['key'], unserialize($setting['value']));
    }
}
*/

//Log
\Engine\Core\Registry::set('log', new \Engine\Library\Log('log.txt'));

//View
\Engine\Core\Registry::set('view', new \Engine\Core\View());

//Action
$action = new \Engine\Core\Action();

//Front
$fc = \Engine\Core\Front::getInstance($action);

//OUT
$response->output();