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

//Log
\Engine\Core\Registry::set('log', new \Engine\Library\Log($config->get('config_error_filename')));

// Request
$request = new \Engine\Library\Request();
\Engine\Core\Registry::set('request', $request);

//Response
$response = new \Engine\Library\Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression($config->get('config_compression'));
\Engine\Core\Registry::set('response', $response);

//Session
$session = \Engine\Core\Registry::set('session', new \Engine\Library\Session());

//Language Detection
$languages = array();

$query = $db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE status = '1'");

foreach ($query->rows as $result) {
    $languages[$result['code']] = $result;
}

$detect = '';

if (isset($request->server['HTTP_ACCEPT_LANGUAGE']) && $request->server['HTTP_ACCEPT_LANGUAGE']) {
    $browser_languages = explode(',', $request->server['HTTP_ACCEPT_LANGUAGE']);

    foreach ($browser_languages as $browser_language) {
        foreach ($languages as $key => $value) {
            if ($value['status']) {
                $locale = explode(',', $value['locale']);

                if (in_array($browser_language, $locale)) {
                    $detect = $key;
                }
            }
        }
    }
}

if (isset($session->data['language']) && array_key_exists($session->data['language'], $languages) && $languages[$session->data['language']]['status']) {
    $code = $session->data['language'];
} elseif (isset($request->cookie['language']) && array_key_exists($request->cookie['language'], $languages) && $languages[$request->cookie['language']]['status']) {
    $code = $request->cookie['language'];
} elseif ($detect) {
    $code = $detect;
} else {
    $code = $config->get('config_language');
}

if (!isset($session->data['language']) || $session->data['language'] != $code) {
    $session->data['language'] = $code;
}

if (!isset($request->cookie['language']) || $request->cookie['language'] != $code) {
    setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $request->server['HTTP_HOST']);
}

$config->set('config_language_id', $languages[$code]['id']);
$config->set('config_language', $languages[$code]['code']);

//Language
$language = new Engine\Library\Language($languages[$code]['directory']);
$language->load($languages[$code]['filename']);
\Engine\Core\Registry::set('language', $language);

//Document
\Engine\Core\Registry::set('document', new \Engine\Library\Document());

//Encription
\Engine\Core\Registry::set('encryption', new \Engine\Library\Encryption($config->get('config_encryption')));

//URL
\Engine\Core\Registry::set('url', new \Engine\Library\Url(BASE_URL));

//Cache
\Engine\Core\Registry::set('cache', new \Engine\Library\Cache());

//View
\Engine\Core\Registry::set('view', new \Engine\Core\View());

//Action
$action = new \Engine\Core\Action();

//Front
\Engine\Core\Front::getInstance($action);

//OUT
$response->output();