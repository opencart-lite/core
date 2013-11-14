<?php namespace Engine\Core;


final class Action {
    protected $class;
    protected $method;
    protected $args = array();

    public function __construct($route, $args = array()) {
        $path = '';

        $parts = explode('/', trim((string)$route,'/'));

        foreach ($parts as $part) {
            $path .= $part;

            if (is_dir(DIR_APP . 'controller/' . $path)) {
                $path .= '/';

                array_shift($parts);

                continue;
            }

            if (is_file(DIR_APP . 'controller/' . str_replace(array('../', '..\\', '..'), '', $path) . '.php')) {
                $this->file = DIR_APP . 'controller/' . str_replace(array('../', '..\\', '..'), '', $path) . '.php';

                $this->class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $path);

                array_shift($parts);

                break;
            }
        }

        if ($args) {
            $this->args = $args;
        }

        $method = array_shift($parts);

        if ($method) {
            $this->method = $method;
        } else {
            $this->method = 'index';
        }
    }

    public function getClass() {
        return $this->class;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getArgs() {
        return $this->args;
    }

    public function __get($key) {}
    public function __set($key, $value) {}
    protected function __clone() {}
} 