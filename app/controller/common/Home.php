<?php namespace Controller\Common;

use Engine\Core\Controller;

class Home extends Controller{

    public function index()
    {
        $this->data['hello'] = 'HOME DOT TPL!!! VAR COOL';
        $this->Components(array('common/header'));

        $data = array_merge($this->data, self::$global_data);
        $view = $this->view->render('home.tpl', $data);
        $this->response->setOutput($view);
    }

}