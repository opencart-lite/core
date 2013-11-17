<?php namespace Engine\Core;

use Reflection;
use ReflectionClass;

final class Front {
    protected static $_instance;

    protected function __construct(Action $action)
    {
        $this->exec($action);
    }

    protected function exec(Action $action)
    {
        if(class_exists($action->getController())) {
            $reflection = new ReflectionClass($action->getController());
            if($reflection->implementsInterface('Engine\Core\IController')) {
                if($reflection->hasMethod($action->getMethod())) {
                    $controller = $reflection->newInstance();
                    $method = $reflection->getMethod($action->getMethod());
                    $method->invoke($controller);
                } else {
                    try{
                        throw new CoreException('METHOD ' . $action->getMethod(). ' NOT FOUND');
                    }
                    catch (CoreException $e) {}
                }
            } else {
                try{
                    throw new CoreException("INTERFACE IController NOT FOUND");
                }
                catch (CoreException $e) {}
            }
        } else {
            try{
                throw new CoreException('CONTROLLER ' . $action->getController() . ' NOT FOUND');
            }
            catch (CoreException $e) {}
        }
    }

    //Singleton
    public static function getInstance(Action $action)
    {
        self::$_instance = !(self::$_instance instanceof self) ? new self($action) : self::$_instance->exec($action);
        return self::$_instance;
    }

    public function __get($key){}
    public function __set($key, $value){}
    protected function __clone() {}

} 