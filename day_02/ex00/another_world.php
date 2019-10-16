#!/usr/bin/php
<?php
if ($argc < 2)
	return null;
echo trim(preg_replace("/\s+/", " ", $argv[1]), $character_mask = " \t") . "\n";
?>
