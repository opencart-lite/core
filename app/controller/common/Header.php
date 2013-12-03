<?php namespace Controller\Common;


use Engine\Core\Controller;

class Header extends Controller{
    public function index(){
        self::$global_data['header'] = $this->view->render('header.tpl', $this->data);
    }

}