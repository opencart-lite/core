<?php  namespace Engine\Library;

use Engine\Core\CoreException;

class Config {
	private $_data = array();

  	public function get($key) {
    	return (isset($this->_data[$key]) ? $this->_data[$key] : null);
  	}

	public function set($key, $value) {
    	$this->_data[$key] = $value;
  	}

	public function has($key) {
    	return isset($this->_data[$key]);
  	}

    public function load($filename) {
        $file = DIR_CONFIG . $filename . '.php';

        if (file_exists($file)) {
            $_ = array();

            require($file);

            $this->data = array_merge($this->data, $_);
        } else {
            try{
                throw new CoreException("Error: Could not load config $filename!");
            }
            catch (CoreException $e) {exit();}
        }
    }

    public function __get($key){
        try{
            throw new CoreException("Error: Chuck Norris, you can not get the property: $key!");
        }
        catch (CoreException $e) {exit();}
    }

    public function __set($key, $value){
        try{
            throw new CoreException("Error: Chuck Norris, you can not created property: $key!");
        }
        catch (CoreException $e) {exit();}
    }

    private function __clone(){}

}