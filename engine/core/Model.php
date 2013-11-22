<?php namespace Engine\Core;


abstract class Model implements IModel{
    public function __get($key)
    {
        return Registry::get($key);
    }

    public function __set($key, $value){}

    public function __construct() {}

} 