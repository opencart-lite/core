<?php namespace Controller\Common;


use Engine\Core\Controller;

class Footer extends Controller{
    public function index()
    {
        $this->data['hello'] = 'FOOTER DOT TPL!!! VAR COOL';

        self::$global_data['footer'] = $this->view->render('footer.tpl', $this->data);
    }

}