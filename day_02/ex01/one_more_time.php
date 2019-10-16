#!/usr/bin/php
<?php
if ($argc < 2)
	return null;
$tab = explode(" ", $argv[1]); 
if (count($tab) != 5
	|| (!preg_match("/^[Ll]undi$/", $tab[0]) && !preg_match("/^[Mm]ardi$/", $tab[0])
	&& !preg_match("/^[Mm]ercredi$/", $tab[0]) && !preg_match("/^[Jj]eudi$/", $tab[0])
	&& !preg_match("/^[Vv]endredi$/", $tab[0]) && !preg_match("/^[Ss]amedi$/", $tab[0])
	&& !preg_match("/^[Dd]imanche$/", $tab[0]))
	|| !is_numeric($tab[1]) || $tab[1] < 0 || $tab[1] > 31
	|| strlen($tab[4]) != 8 || strlen($tab[3]) != 4)
{
	echo "Wrong Format\n";
	return null;
}
$time = explode(":", $tab[4]);
if ((count($time) != 3) || !is_numeric($time[0]) || !is_numeric($time[1]) || !is_numeric($time[2])
	|| $time[0] < 0 || $time[0] > 23 || $time[1] < 0 || $time[1] > 59 || $time[2] < 0 || $time[2] > 59)
{
	echo "Wrong Format\n";
	return null;
}
$day = $tab[1];
$month = 0;
if (preg_match("/^[Jj]anvier$/", $tab[2]))
	$month = 1;
if (preg_match("/^[Ff][ée]vrier$/", $tab[2]))
	$month = 2;
if (preg_match("/^[Mm]ars$/", $tab[2]))
	$month = 3;
if (preg_match("/^[Aa]vril$/", $tab[2]))
	$month = 4;
if (preg_match("/^[Mm]ai$/", $tab[2]))
	$month = 5;
if (preg_match("/^[Jj]uin$/", $tab[2]))
	$month = 6;
if (preg_match("/^[Jj]uillet$/", $tab[2]))
	$month = 7;
if (preg_match("/^[Aa]o[uû]t$/", $tab[2]))
	$month = 8;
if (preg_match("/^[Ss]eptembre$/", $tab[2]))
	$month = 9;
if (preg_match("/^[Oo]ctobre$/", $tab[2]))
	$month = 10;
if (preg_match("/^[Nn]ovembre$/", $tab[2]))
	$month = 11;
if (preg_match("/^[Dd][ée]cembre$/", $tab[2]))
	$month = 12;
$year = $tab[3];
if ($month == 0 || checkdate($month, $day, $year) == false)
{
	echo "Wrong Format\n";
	return null;
}
date_default_timezone_set("Europe/Paris");
echo mktime($time[0], $time[1], $time[2], $month, $day, $year) . "\n";
?>