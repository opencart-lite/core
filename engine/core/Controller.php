<?php namespace Engine\Core;

use Closure;
use ArrayAccess;

abstract class Controller implements IController{
    protected function __construct() {}

    public function __get($key) {
        return Registry::get($key);
    }

    public function __set($key, $value) {}
}