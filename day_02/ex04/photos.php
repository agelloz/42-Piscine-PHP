#!/usr/bin/php
<?php
if ($argc != 2)
	return null;
$opt = preg_replace("/http:/", "https:", $argv[1]);
if (($ch = curl_init($opt)) == false)
	return null;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
if (($file = curl_exec($ch)) == false)
	return null;
$path = stristr($argv[1], "www");
if (preg_match("/\//", $path) === 1)
	$path = strstr($path, "/", true);
if (!is_dir($path))
	mkdir($path);
$pathlink = "https://" . $path;
$tab = preg_split("/(?=<)|(?<=>)/", $file, 0, PREG_SPLIT_NO_EMPTY);
foreach ($tab as $elem)
{
	if (preg_match("/<img/", $elem) === 1)
	{
		preg_match('/(src=")(.*?)(")/', $elem, $matches1);
		$full_img_link = $matches1[2];
		if (preg_match("/http/", $full_img_link) === 0)
			$full_img_link = $pathlink . "/" . $full_img_link; 
		$tab = explode("/", $full_img_link);
		$local_path = $tab[count($tab) - 1];
		$i = count($tab) - 2;
		while ($i > 0 && $tab[$i] != $path)
		{
			$local_path = $tab[$i] . "/" . $local_path;
			$i--;
		}
		if (!empty($tab[count($tab) - 1]) && ($fp = fopen($path . "/" . $tab[count($tab) - 1], "w")) != false)
		{
			if (($ch2 = curl_init($full_img_link)) != false)
			{
				curl_setopt($ch2, CURLOPT_FILE, $fp);
				curl_exec($ch2);
				curl_close($ch2);
			}
			fclose($fp);
		}
	}
}
curl_close($ch);
?>