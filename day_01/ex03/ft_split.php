#!/usr/bin/php
<?PHP
function ft_split($line)
{
	$tab = explode(" ", trim($line));
	if (empty($tab))
		return null;
	sort($tab);
	return ($tab);
}
?>
