<?php namespace Engine\Core;


abstract class Model {
    public function __get($key) {
        return Registry::get($key);
    }

    public function __set($key, $value) {}
    protected function __construct() {}
} 