<?php

class UnholyFactory {
	private $_type = NULL;
	private $_absorbed = array();
	private $_key = NULL;

	public function absorb($fighter) {
		if ($fighter instanceof Fighter)
		{
			$this->_type = $fighter->getType($this->_type);
			if (array_key_exists($this->_type, $this->_absorbed) === TRUE)
				print("(Factory already absorbed a fighter of type " . $this->_type . ")" . PHP_EOL);
			else
			{
				$this->_absorbed[$this->_type] = $fighter;
				print("(Factory absorbed a fighter of type " . $this->_type . ")" . PHP_EOL);
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
	}
	
	public function fabricate($str) {
		if (array_key_exists($str, $this->_absorbed) === TRUE)
		{
			print("(Factory fabricates a fighter of type " . $str . ")" . PHP_EOL);
			return ($this->_absorbed[$str]);
		}
		else
		{
			print("(Factory hasn't absorbed a fighter of type " . $str . ")" . PHP_EOL);
			return null;
		}
	}
}

?>
