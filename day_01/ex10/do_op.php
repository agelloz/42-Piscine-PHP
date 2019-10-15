#!/usr/bin/php
<?PHP
foreach($argv as $element)
	$tab[] = trim($element, $character_mask = " \t");
if ($argc != 4 || !is_numeric($tab[1]) || !is_numeric($tab[3])
	|| ($tab[2] != "+" && $tab[2] != "-" && $tab[2] != "*" && $tab[2] != "/" && $tab[2] != "%"))
{
	echo "Incorrect Parameters\n";
	return null;
}
if ($tab[2] == "+")
	echo $tab[1] + $tab[3];
if ($tab[2] == "-")
	echo $tab[1] - $tab[3];
if ($tab[2] == "*")
	echo $tab[1] * $tab[3];
if ($tab[2] == "/")
	echo $tab[1] / $tab[3];
if ($tab[2] == "%")
	echo $tab[1] % $tab[3];
echo "\n";
?>
