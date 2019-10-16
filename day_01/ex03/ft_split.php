#!/usr/bin/php
<?PHP
function ft_split($line)
{
	$tab = preg_split('/ +/', trim($line, $character_mask = " \t"));
	if (empty($tab))
		return null;
	sort($tab);
	return ($tab);
}
?>
