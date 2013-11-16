<?php namespace Engine\Core;


final class View {
    protected $data = array();
    protected $output;

    public function __construct(){}

    public function render($template, $data)
    {

        if (file_exists(DIR_TEMPLATE ."/". $template)) {
            extract($data);

            ob_start();

            require(DIR_TEMPLATE . "/" .$template);

            $this->output = ob_get_contents();

            ob_end_clean();

            return $this->output;
        } else {
            try{
                throw new CoreException('Could not load template ' . DIR_TEMPLATE . $template . '!');
            }
            catch (CoreException $e) {exit();}
        }
    }

}