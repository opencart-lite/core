<?php namespace Controller\Common;

use Engine\Core\Controller;
use Engine\Library\Compile;

class Home extends Controller{

    public function index($args = array())
    {

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