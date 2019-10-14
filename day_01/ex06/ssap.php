#!/usr/bin/php
<?PHP
if ($argc < 2)
	return null;
$i = 1;
while ($i < $argc)
{
	$tmp = explode(" ", trim($argv[$i]));
	foreach ($tmp as $element)
		if (!empty(trim($element)))
			$tab[] = trim($element);
	$i++;
}
sort($tab);
print(trim($tab[0]));
$index = 0;
foreach ($tab as $element)
{
	if (!empty(trim($element)) && $index > 0)
		print("\n" . trim($element));
	$index++;
}
print("\n");
?>
