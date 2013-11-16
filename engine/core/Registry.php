<?php namespace Engine\Core;
final class Registry {
	private static $data = array();

	public static function get($key)
    {
		return (isset(self::$data[$key]) ? self::$data[$key] : NULL);
	}

	public static function set($key, $value)
    {
        self::$data[$key] = $value;
	}

	public static function has($key)
    {
    	return isset(self::$data[$key]);
  	}

    public function __get($key) {}
    public function __set($key, $value) {}
    private function __construct() {}
    private function __clone() {}

}
?>