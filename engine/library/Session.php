<?php  namespace Engine\Library;


class Session {
	public $data = array();
    public $cache_limiter;
    public $cache_expire;

  	public function __construct() {
		if (!session_id()) {
			ini_set('session.use_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');

            $this->cache_limiter = session_cache_limiter();
            $this->cache_expire = session_cache_expire();

			session_set_cookie_params(0, '/');
			session_start();

		}
			
		$this->data =& $_SESSION;
	}
	
	function getId() {
		return session_id();
	}
}
