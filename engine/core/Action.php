<?php namespace Engine\Core;


final class Action {
    protected $_ns;
    protected $_controller;
    protected $_method;
    protected $_args;

    public function __construct($route = '', $path_mode = '')
    {
        $path_mode = $path_mode ? $path_mode : PATH_MODE;
        $route = $route ? trim((string)$route,'/') : trim($_SERVER['REQUEST_URI'],'/');
        $split = explode('?', $route);
        $route = array_shift($split);

        $parts = explode('/', str_replace(DOMAIN, '', $route));

        //$parts = array_diff($parts, array(''));
        $parts = array_filter($parts,
            function($elem){
                return $elem ? true : false;
            }
        );

        $this->_ns = $parts ? '\Controller\\' . ucfirst(array_shift($parts)) . '\\' : '\Controller\\';
        $this->_controller = $parts ? $this->_ns . ucfirst(array_shift($parts)) : '\Controller\Common\Home';
        $this->_method = $parts ? array_shift($parts) : 'index';

        switch($path_mode){
            case 'MULTI':   $keys = $values = array(); $key = '';
                            foreach($parts as $part){
                                if(!$key){
                                    $key = $part;
                                    $keys[] = $part;
                                }else{
                                    $values[] = $part;
                                    $key = '';
                                }
                            }
                            if(count($keys) != count($values)) $values[count($keys)] = '';
                            $this->_args = array_combine($keys, $values);
                            break;
            case 'STACK':  $this->_args = $parts;
                            break;
            case 'SINGLE':  $this->_args = array_shift($parts);
                            break;
            default :       $this->_args = $_GET;
        }

    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getArgs()
    {
        return $this->_args;
    }

    public function __get($key) {}
    public function __set($key, $value) {}
    protected function __clone() {}
} 