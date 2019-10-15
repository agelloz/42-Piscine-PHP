#!/usr/bin/php
<?PHP
if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	return null;
}
if (strpos($argv[1], '+') == true)
{
	$tab = explode('+', $argv[1]);
	if (count($tab) != 2)
	{
		echo "Syntax Error\n";
		return null;
	}
	$tab[0] = trim($tab[0], $character_mask = " \t");
	$tab[1] = trim($tab[1], $character_mask = " \t");
	if (!is_numeric($tab[0]) || !is_numeric($tab[1]))
	{
		echo "Syntax Error\n";
		return null;
	}
	echo $tab[0] + $tab[1] . "\n";
}
else if (strpos($argv[1], '-') == true)
{
	$tab = explode('-', $argv[1]);
	if (count($tab) != 2)
	{
		echo "Syntax Error\n";
		return null;
	}
	$tab[0] = trim($tab[0], $character_mask = " \t");
	$tab[1] = trim($tab[1], $character_mask = " \t");
	if (!is_numeric($tab[0]) || !is_numeric($tab[1]))
	{
		echo "Syntax Error\n";
		return null;
	}
	echo $tab[0] - $tab[1] . "\n";
}
else if (strpos($argv[1], '*') == true)
{
	$tab = explode('*', $argv[1]);
	if (count($tab) != 2)
	{
		echo "Syntax Error\n";
		return null;
	}
	$tab[0] = trim($tab[0], $character_mask = " \t");
	$tab[1] = trim($tab[1], $character_mask = " \t");
	if (!is_numeric($tab[0]) || !is_numeric($tab[1]))
	{
		echo "Syntax Error\n";
		return null;
	}
	echo $tab[0] * $tab[1] . "\n";
}
else if (strpos($argv[1], '/') == true)
{
	$tab = explode('/', $argv[1]);
	if (count($tab) != 2)
	{
		echo "Syntax Error\n";
		return null;
	}
	$tab[0] = trim($tab[0], $character_mask = " \t");
	$tab[1] = trim($tab[1], $character_mask = " \t");
	if (!is_numeric($tab[0]) || !is_numeric($tab[1]))
	{
		echo "Syntax Error\n";
		return null;
	}
	echo $tab[0] / $tab[1] . "\n";
}
else if (strpos($argv[1], '%') == true)
{
	$tab = explode('%', $argv[1]);
	if (count($tab) != 2)
	{
		echo "Syntax Error\n";
		return null;
	}
	$tab[0] = trim($tab[0], $character_mask = " \t");
	$tab[1] = trim($tab[1], $character_mask = " \t");
	if (!is_numeric($tab[0]) || !is_numeric($tab[1]))
	{
		echo "Syntax Error\n";
		return null;
	}
	echo $tab[0] % $tab[1] . "\n";
}
else
{
	echo "Syntax Error\n";
	return null;
}
?>
