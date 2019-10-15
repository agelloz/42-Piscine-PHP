#!/usr/bin/php
<?PHP
if ($argc < 3)
	return null;
$i = 0;
foreach($argv as $arg)
{
	if ($i == 1)
		$tab[0] = $argv[$i];
	if ($i > 1 && strpos($argv[$i], ':') == true)	
		$tab[] = explode(":", $argv[$i]);
	$i++;
}
$i = 1;
foreach($tab as $element)
{
	if (count($tab[$i]) != 2)
	{
		array_splice($tab, $i, 1);
		$i--;
	}
	else
	{
		$tab[$i][0] = trim($tab[$i][0]);
		$tab[$i][1] = trim($tab[$i][1]);
	}
	$i++;
}
$size = count($tab);
while (--$size)
{
	if ($tab[$size][0] == $tab[0])
	{
		echo $tab[$size][1] . "\n";
		return null;
	}
}
?>
