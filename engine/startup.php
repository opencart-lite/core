<?php
//Dinamic Classes [engine context]
set_include_path(get_include_path()
    . PATH_SEPARATOR . PATH_ENGINE
    . PATH_SEPARATOR . PATH_APP
);

//Static Classes [engine context]

//Autoload Dinamic classes [engine context]
function __autoload($class){
    require_once(str_replace('\\', '/', $class).'.php');
}