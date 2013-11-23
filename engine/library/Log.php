<?php namespace Engine\Library;


class Log {
	private $filename;
	
	public function __construct($filename) {
		$this->filename = $filename;
	}
	
	public function write($message)
    {
		$file = DIR_LOG . $this->filename;

        file_put_contents($file, date('Y-m-d G:i:s') . " <-> \n" . $message . "\n", FILE_APPEND);

	}

    public function read()
    {
        return file_get_contents($this->filename);
    }
}