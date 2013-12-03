<?php namespace Controller\Common;


use Engine\Core\Controller;

class Footer extends Controller{
    public function index()
    {
        $this->data['request_time'] = round($time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 3);

        self::$global_data['footer'] = $this->view->render('footer.tpl', $this->data);
    }

}