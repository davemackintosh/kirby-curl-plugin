<?php

class kurl {

	public $connection = null;

	public function __construct () {
		$this->connection = curl_init();
		return $this;
	}

	/**
	 * Singleton behaviour
	 */
	public static function Instance () {
        static $inst = null;
        if ($inst === null) {
            $inst = new kurl;
        }
        return $inst;
    }
    
    /**
     * Sets the url for the request
     */
    public function url ($url) {
    	curl_setopt($this->connection, CURLOPT_URL, $url);
    	return $this;
    }
        
    /**
	 * Whether or not to verify the host and peer
	 *
	 * @param $bool = boolean | 1 | 0
	 */
    public function verify ($bool = false) {
    	curl_setopt($this->connection, CURLOPT_SSL_VERIFYHOST, $bool);
    	curl_setopt($this->connection, CURLOPT_SSL_VERIFYPEER, $bool);
    	return $this;
    }

    /**
     * Post an array of data to the url
     */
	public function post (array $data) {
		curl_setopt($this->connection, CURLOPT_POST, count($data));
		curl_setopt($this->connection, CURLOPT_POSTFIELDS, http_build_query($data));
		return $this;
	}

	/**
	 * Set the flag to return the data
	 */
	public function returnData () {
		curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true);
		return $this;
	}

	/**
	 * Execute and fire the callback function if supplied
	 *
	 * @return the results of the curl request
	 */
	public function execute ($callback = null) {
		$out = curl_exec($this->connection);
		$err = curl_error($this->connection);
		
		if (is_callable($callback)) {
			$out = $callback($out, $err);
		}
		
		curl_close($this->connection);
		return $out;
	}

}