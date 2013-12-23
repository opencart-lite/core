<?php namespace Engine\Core;


final class Loader {

    public function __construct() {}

    public function __get($key) {
        return Registry::get($key);
    }

    public function __set($key, $value) {}

    public function library($library)
    {

        $class = $library ? '\Engine\Library\\' . ucfirst($library) : NULL;
        if ($class && class_exists($class)) {
            return new $class();
        } else {
            try{
                throw new CoreException('Could not load library ' . $library . '!');
            }
            catch (CoreException $e) {exit();}
        }
    }

    public function helper($helper)
    {
        $file = DIR_CORE . 'helper/' . $helper . '.php';

        if (file_exists($file)) {
            include_once($file);
        } else {
            try{
                throw new CoreException('Error: Could not load helper ' . $helper . '!');
            }
            catch (CoreException $e) {exit();}
        }
    }

    public function model($model)
    {
        $parts = explode('/', trim((string)$model,'/'));

        $ns = $parts ? '\Model\\' . ucfirst(array_shift($parts)) . '\\' : NULL;
        $class = $parts ? $ns . ucfirst(array_shift($parts)) : NULL;

        if ($class && class_exists($class)) {
            Registry::set('model_' . str_replace('/', '_', $model), new $class());
        } else {
            try{
                throw new CoreException('Error: Could not load model ' . $model . '!');
            }
            catch (CoreException $e) {exit();}
        }
    }

    public function database($driver, $hostname, $username, $password, $database)
    {
        $file  = DIR_CORE . 'database/' . $driver . '.php';
        $class = 'Database' . preg_replace('/[^a-zA-Z0-9]/', '', $driver);

        if (file_exists($file)) {
            include_once($file);

            $this->registry->set(str_replace('/', '_', $driver), new $class($hostname, $username, $password, $database));
        } else {
            try{
                throw new CoreException('Error: Could not load database ' . $driver . '!');
            }
            catch (CoreException $e) {exit();}
        }
    }

    public function config($config)
    {
        $this->config->load($config);
    }

    public function language($language)
    {
        return $this->language->load($language);
    }

}