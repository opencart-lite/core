<?php namespace Engine\Library;


class Url {
	private $_url;
	private $_ssl;

	public function __construct($url, $ssl = '') {
		$this->_url = $url;
		$this->_ssl = $ssl;
	}

	public function link($route, $args = '', $connection = 'NONSSL') {
		if ($connection ==  'NONSSL') {
			$url = $this->_url;
		} else {
			$url = $this->_ssl;
		}
		
		$url .= $route;
			
		if ($args) {
			$url .= '?' . str_replace('&', '&amp;', ltrim($args, '&'));
		}

		return $url;
	}
}