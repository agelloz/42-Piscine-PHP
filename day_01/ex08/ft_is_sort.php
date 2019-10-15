<?PHP
function ft_is_sort($tab)
{
	$size = count($tab);
	if ($size < 2)
		return (boolean) 1;
	$index = 1;
	while ($index < $size)
	{
		if ($tab[$index] < $tab[$index - 1])
			return (boolean) 0;
		$index++;
	}
	return (boolean) 1;
}
?>
