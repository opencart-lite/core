<?php namespace Controller\Common;

use Engine\Core\Controller;

class Home extends Controller{

    public function index($args = array())
    {

        $this->data['hello'] = 'HOME DOT TPL!!! VAR COOL';
        $this->data['url'] = $this->url->link('common/home','world=hello&root=var');
        $this->data['display'] = $this->request->get ? $this->request->get : '';
        $this->load->model('common/home');
        $this->cache->set('hhh-gg', array('nbn','bmbm'));
        var_dump($this->cache->get('hhh-gg'));
        //$this->load->library('log');
        //$this->session->data['user'] = 'll';
        //var_dump($this->session->data);

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