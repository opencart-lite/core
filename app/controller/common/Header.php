<?php namespace Controller\Common;


use Engine\Core\Controller;

class Header extends Controller{
    public function index(){
        $this->data['title'] = $this->language->get('text_home');
        self::$global_data['header'] = $this->view->render('header.tpl', $this->data);
    }

}