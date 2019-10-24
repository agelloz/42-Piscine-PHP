<?php

class NightsWatch implements IFighter {
	private $_fighters = array();

	public function recruit($char) {
		if ($char instanceof IFighter)
			$this->_fighters[] = $char;
	}

	public function fight() {
		foreach ($this->_fighters as $fighter)
			$fighter->fight();
	}
}
?>
