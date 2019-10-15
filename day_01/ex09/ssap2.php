#!/usr/bin/php
<?PHP
if ($argc < 2)
	return null;
$i = 1;
while ($i < $argc)
{
	$tmp = explode(" ", trim($argv[$i]));
	foreach ($tmp as $element)
	{
		if (!empty(trim($element)) && ctype_alpha(trim($element)))
			$tab_alpha[] = trim($element);
	}
	$i++;
}
if (!empty($tab_alpha))
	sort($tab_alpha, SORT_STRING | SORT_FLAG_CASE);

$i = 1;
while ($i < $argc)
{
	$tmp = explode(" ", trim($argv[$i]));
	foreach ($tmp as $element)
		if (!empty(trim($element)) && is_numeric(trim($element)))
			$tab_num[] = trim($element);
	$i++;
}
if (!empty($tab_num))
	sort($tab_num, SORT_STRING);

$i = 1;
while ($i < $argc)
{
	$tmp = explode(" ", trim($argv[$i]));
	foreach ($tmp as $element)
		if (!empty(trim($element)) && !ctype_alpha(trim($element)) && !is_numeric($element))
			$tab_other[] = trim($element);
	$i++;
}
if (!empty($tab_other))
	sort($tab_other, SORT_STRING | SORT_FLAG_CASE);

if (!empty($tab_alpha[0]))
{
	print(trim($tab_alpha[0]));
	$index = 0;
	foreach ($tab_alpha as $element)
	{
		if (!empty(trim($element)) && $index > 0)
			print("\n" . trim($element));
		$index++;
	}
	print("\n");
}

if (!empty($tab_num[0]))
{
	print(trim($tab_num[0]));
	$index = 0;
	foreach ($tab_num as $element)
	{
		if (!empty(trim($element)) && $index > 0)
			print("\n" . trim($element));
		$index++;
	}
	print("\n");
}

if (!empty($tab_other[0]))
{
	print(trim($tab_other[0]));
	$index = 0;
	foreach ($tab_other as $element)
	{
		if (!empty(trim($element)) && $index > 0)
			print("\n" . trim($element));
		$index++;
	}
	print("\n");
}
?>
