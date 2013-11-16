<?php namespace Engine\Core;

use Closure;
use ArrayAccess;

abstract class Controller implements IController {
    protected static $global_data = array();
    protected $data = array();
    protected $component = array();

    public function __construct() {}

    public function __get($key)
    {
        return Registry::get($key);
    }

    public function components($components)
    {
       foreach($components as $component){
           $action = new Action($component);
           Front::getInstance($action);
       }
    }

    protected function redirect($url, $status = 302) {
        header('Status: ' . $status);
        header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $url));
        exit();
    }

    //Closed methods
    public function __set($key, $value) {}
    private  function __clone() {}

}