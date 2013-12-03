<?php  namespace Engine\Library;


class Cache {
    private $type;
    private $expire;
    private $limiter;
    private $memcache;

    public function  __construct($type = '', $expire = null, $limiter = '')
    {
        $this->type = $type ? $type : CACHE_TYPE;
        $this->expire = !is_null($expire) ? $expire : CACHE_EXPIRE;
        $this->limiter = $limiter ? $limiter : CACHE_LIMITER;

        if($this->type == 'MEMCACHE'){
            $this->memcache = new \Memcache();
            if(!$this->memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT))
            try{
                throw new CoreException('MEMCACHE | Could not connect - host: ' . MEMCACHE_HOST . ', port: ' .  MEMCACHE_PORT);
            }
            catch (CoreException $e) {exit();}
        }
    }

	public function get($key)
    {
        switch($this->type){
            case 'MEMCACHE': return $this->getMemCache($key);
            case 'SESSION': return $this->getSessionCache($key);
            case 'COOKIE': return $this->getCookieCache($key);
            case 'APC': return $this->getAPCCache($key);
            default: return $this->getFileCache($key);
        }
	}

  	public function set($key, $value)
    {
        switch($this->type){
            case 'MEMCACHE': $this->setMemCache($key, $value);
                             break;
            case 'SESSION': $this->setSessionCache($key, $value);
                            break;
            case 'COOKIE': $this->setCookieCache($key, $value);
                           break;
            case 'APC': $this->setAPCCache($key, $value);
                             break;
            default: $this->setFileCache($key, $value);
        }
  	}
	
  	public function delete($key)
    {
        switch($this->type){
            case 'MEMCACHE': $this->deleteMemCache($key);
                break;
            case 'SESSION': $this->deleteSessionCache($key);
                break;
            case 'COOKIE': $this->deleteCookieCache($key);
                break;
            case 'APC': $this->deleteAPCCache($key);
                break;
            default: $this->deleteFileCache($key);
        }
  	}

    public function  setMode($type, $expire, $limiter = '')
    {
        $this->type = $type;
        $this->expire = $expire;
        $this->limiter = $limiter;
    }

    public function getMode()
    {
        return array('type' => $this->type, 'expire' => $this->expire);
    }

    public function hasMode($type)
    {
        return ($this->type == $type) ? true : false;
    }

    //Begin Memcache Cache
    private function setMemCache($key, $value)
    {
        $this->memcache->set('cache.' . $key, $value, false, $this->expire);
    }

    private function getMemCache($key)
    {
        return $this->memcache->get('cache.' . $key);
    }

    private function deleteMemCache($key)
    {
        $this->memcache->delete('cache.' . $key);
    }
    //End Memcache Cache

    //Begin Session Cache
    private function setSessionCache($key, $value)
    {
        if($this->limiter) session_cache_limiter($this->limiter);
        if($this->expire) session_cache_expire($this->expire / 60);

        $_SESSION['cache.' . $key] = $value;

    }

    private function getSessionCache($key)
    {
        return $_SESSION['cache.' . $key];
    }

    private function deleteSessionCache($key)
    {
        unset($_SESSION['cache.' . $key]);
    }
    //End Session Cache

    //Begin Cookie Cache
    private function setCookieCache($key, $value)
    {
        setcookie('cache_' . $key, serialize($value), time() + $this->expire);

    }

    private function getCookieCache($key)
    {
        return unserialize(html_entity_decode($_COOKIE['cache_' . $key]));
    }

    private function deleteCookieCache($key)
    {
        unset($_COOKIE['cache_' . $key]);
    }
    //End Cookie Cache

    //Begin APC Cache
    private function setAPCCache($key, $value)
    {
        apc_store('cache.' . $key, $value, $this->expire / 60);
    }

    private function getAPCCache($key)
    {
        return apc_exists('cache.' . $key) ? apc_fetch('cache.' . $key) : null;
    }

    private function deleteAPCCache($key)
    {
        apc_delete('cache.' . $key);
    }
    //End APC Cache

    //Begin File Cache
    private function getFileCache($key)
    {
        $files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

        if ($files) {
            $cache = file_get_contents($files[0]);

            $data = unserialize($cache);

            foreach ($files as $file) {
                $time = substr(strrchr($file, '.'), 1);

                if ($time < time()) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }

            return $data;
        }
    }

    private function setFileCache($key, $value)
    {
        $this->delete($key);

        $file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $this->expire);

        $handle = fopen($file, 'w');

        fwrite($handle, serialize($value));

        fclose($handle);
    }

    private function deleteFileCache($key)
    {
        $files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

        if ($files) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }
    //End File Cache

    public function __destruct()
    {
        if($this->memcache) $this->memcache->close();
    }

    public function __get($key){}
    public function __set($key, $value){}
    private function __clone(){}

}