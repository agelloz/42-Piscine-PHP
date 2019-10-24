<?php

class Tyrion extends Lannister
{
	public function sleepWith($char) {
		if ($char instanceof Jaime)
			return (print ('Not even if I\'m drunk !' . PHP_EOL ) );
		elseif ($char instanceof Sansa)
			return (print ('Let\'s do this.' . PHP_EOL ) );
		elseif ($char instanceof Cersei)
			return (print ('Not even if I\'m drunk !' . PHP_EOL ) );
	}
}
?>
