#!/usr/bin/php
<?php

function maj($matches)
{
	print_r($matches);
	if ($matches[2][0] != '<')
		$replacement = $matches[1] . strtoupper($matches[2]) . $matches[3];
	else
		$replacement = $matches[0];
	return ($replacement);
}

if ($argc < 2)
	return null;
$fd = fopen($argv[1], "r");
while (!feof($fd))
	$page = $page . fgets($fd);
fclose ($fd);
$page = preg_replace_callback("/(<a.*title=\")(.*)(\">)/i", "maj", $page);
$page = preg_replace_callback("/(<a.*>)(.*)(<\/a>)/i", "maj", $page);
$page = preg_replace_callback("/(<a.*>)(.*)(<img)/i", "maj", $page);
echo $page;
?>