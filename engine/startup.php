<?php
set_include_path(get_include_path()
    . PATH_SEPARATOR . PATH_CORE
    . PATH_SEPARATOR . PATH_MODEL
    . PATH_SEPARATOR . PATH_CONTROLLER
);

function __autoload($class){
    $path = explode('',$class);
    require_once($class.'.php');
}