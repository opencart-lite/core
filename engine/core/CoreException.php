<?php namespace Engine\Core;

use Engine\Library\Log;
use Exception;

class CoreException extends Exception {

    public function __construct($errstr = '')
    {
        $config = Registry::get('config');
        $log = Registry::get('log');
        $traces =  $this->getTrace();
        $str_log = $str_display = '';

        $trace = array_shift($traces);

        if(isset($trace['line']) && isset($trace['file'])){
            $str_display .= '<b>CORE EXCEPTION</b> <i>[' . $trace['class'] .  ']</i><b>:</b> '. $errstr . ' in <b>' . $trace['file'] . '</b> on line <b>' . $trace['line'] . '</b><br>';
            $str_log .= 'CORE EXCEPTION [' . $trace['class'] . ']:  ' . $errstr . ' in ' . $trace['file'] . ' on line ' . $trace['line'] . "\n";
        }else{
            $str_display .=  '<br><b>CORE EXCEPTION BLOCK</b><i>' . str_replace('#', '<br>#', $this->getTraceAsString()) . '</i><br><br>';
            $str_log .= "CORE EXCEPTION #\n" . $this->getTraceAsString() . "\n";
        }

        if ($config->get('config_error_display')) {
            echo $str_display;
        }

        if ($config->get('config_error_log')) {
            $log->write($str_log);
        }

    }

}