<?php namespace Controller\Common;

use Engine\Core\Controller;

class Home extends Controller{

    public function index($args = array())
    {
        $this->data['hello'] = 'HOME DOT TPL!!! VAR COOL';

        $this->load->model('common/home');
        //$this->load->library('log');

        $page = $this->model_common_home->getPage();

        echo $page;

        $this->Components(
            array(
                'common/header',
                'common/footer'
            )
        );

        $data = array_merge($this->data, self::$global_data);
        $view = $this->view->render('home.tpl', $data);

        $this->response->setOutput($view);
    }

}