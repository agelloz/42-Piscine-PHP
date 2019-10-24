<?php

class Fighter {
	private $_type = NULL;

	public function __construct($str) {
		$this->_type = $str;
	}

	public function getType() {
		return ($this->_type);
	}
}

?>
