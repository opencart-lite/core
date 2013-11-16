<?php namespace Controller\Common;


use Engine\Core\Controller;

class Header extends Controller{
    public function index(){
        $this->data['hello'] = 'HEADER DOT TPL!!! VAR COOL';

        self::$global_data['header'] = $this->view->render('header.tpl', $this->data);
    }

}