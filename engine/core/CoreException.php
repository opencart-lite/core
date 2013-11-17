<?php namespace Engine\Core;

use Engine\Library\Log;
use Exception;

class CoreException extends Exception {

    public function __construct($errstr='')
    {
        $traces =  $this->getTrace();
        $config = 'error_display';
        $str_log = $str_display ='';
        foreach($traces as $trace){
            if(isset($trace['line']) && isset($trace['file'])){
                $str_display .= '<b>CORE EXCEPTION</b> <i>[' . $trace['class'] .  ']</i><b>:</b> '. $errstr . ' in <b>' . $trace['file'] . '</b> on line <b>' . $trace['line'] . '</b><br>';
                $str_log .= 'CORE EXCEPTION ' . $trace['class'] . ':  ' . $errstr . ' in ' . $trace['file'] . ' on line ' . $trace['line'] . "\n";
            }else{
                $str_display .=  '<br><b>CORE EXCEPTION BLOCK</b><i>' . str_replace('#', '<br>#', $this->getTraceAsString()) . '</i><br><br>';
                $str_log .= "CORE EXCEPTION #\n" . $this->getTraceAsString() . "\n";
            }
        }

        //if ($config->get('error_display')) {
        if ($config == 'error_display') {
            echo $str_display;
        }

        $config = 'error_log';
        //if ($config->get('error_log')) {
        if ($config == 'error_log') {
            $log = new Log('log.txt');
            $log->write($str_log);
        }

    }

}