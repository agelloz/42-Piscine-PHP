<?php

class Jaime extends Lannister
{
	public function sleepWith($char) {
		if ($char instanceof Tyrion)
			return (print ('Not even if I\'m drunk !' . PHP_EOL ) );
		elseif ($char instanceof Sansa)
			return (print ('Let\'s do this.' . PHP_EOL ) );
		elseif ($char instanceof Cersei)
			return (print ('With pleasure, but only in a tower in Winterfell, then.' . PHP_EOL ) );
	}
}
?>
