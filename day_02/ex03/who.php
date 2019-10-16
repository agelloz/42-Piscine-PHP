#!/usr/bin/php
<?php
date_default_timezone_set('Europe/paris');
$handle = fopen("/var/run/utmpx", "r");
$contents = fread($handle, filesize("/var/run/utmpx"));
fclose($handle);
//print('1|' . $contents . '|\n');
$sub = substr($contents, 1256);
//print('2|' . $sub . '|\n');
$user = get_current_user();
$i = 0;
while ($sub)
{
	$tab = unpack('a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad', $sub);
	//print_r($tab);
	if (strcmp(trim($tab[user]), $user) == 0)
	{
		if ($tab[type] == 7)
		{
			$res[$i] .= trim($tab[user]);
			$res[$i] .= "  " . trim($tab[line]);
			$date = date("M j H:i", $tab[time1]);
			$res[$i] .= "  " . $date;
		}
	}
	$i++;
	$sub = substr($sub, 628);
}
sort($res);
foreach ($res as $element)
	echo $element . " \n";
?>