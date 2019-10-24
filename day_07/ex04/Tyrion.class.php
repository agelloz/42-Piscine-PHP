<?php

class Tyrion extends Lannister {
	public function sleepWith($char) {
		if ($char instanceof Jaime)
			print("Not even if I'm drunk !" . PHP_EOL);
		elseif ($char instanceof Sansa)
			print("Let's do this." . PHP_EOL);
		elseif ($char instanceof Cersei)
			print("Not even if I'm drunk !" . PHP_EOL);
	}
}

?>
