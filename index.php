<?php
require_once('config.php');
require_once('engine/startup.php');

$response = new \Engine\Library\Response();

\Engine\Core\Registry::set('response', $response);

\Engine\Core\Registry::set('view', new \Engine\Core\View());

$action = new \Engine\Core\Action();

$fc = \Engine\Core\Front::getInstance($action);

$response->output();