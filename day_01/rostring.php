#!/usr/bin/php
<?PHP
if ($argc < 2)
	return null;
$tab = explode(" ", trim($argv[1]));
$index = 0;
foreach ($tab as $element)
{
	if (!empty(trim($element)) && $index > 0)
		print(trim($element) . " ");
	$index++;
}
if (!empty($tab[0]))
	print(trim($tab[0]) . "\n");
?>
