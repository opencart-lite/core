<?php namespace Engine\Library;

class Log {
	private $filename;
	
	public function __construct($filename) {
		$this->filename = $filename;
	}
	
	public function write($message) {
		$file = DIR_LOG . $this->filename;
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, date('Y-m-d G:i:s') . " <-> \n" . $message . "\n");
			
		fclose($handle); 
	}
}
?>