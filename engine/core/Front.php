<?php namespace Engine\Core;


final class Front {
    protected $error;

    public function __construct() {}

    public function run($action) {

        while ($action) {
            $action = $this->execute($action);
        }

    }

    private function execute($action) {
        if (file_exists($action->getFile())) {
            require_once($action->getFile());

            $class = $action->getClass();

            $controller = new $class();

            if (is_callable(array($controller, $action->getMethod()))) {
                $action = call_user_func_array(array($controller, $action->getMethod()), $action->getArgs());
            } else {
                $action = $this->error;

                $this->error = '';
            }
        } else {
            $action = $this->error;

            $this->error = '';
        }

        return $action;
    }
} 