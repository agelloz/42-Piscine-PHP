#!/usr/bin/php
<?PHP
while (1)
{
	print("Entrez un nombre: ");
	$number = trim(fgets(STDIN));
	if (feof(STDIN))
	{
		print "\n";
		return ;
	}
	if (!is_numeric($number))
		print("'$number' n'est pas un chiffre\n");
	else if ($number % 2 == 0)
		print("Le chiffre $number est Pair\n");
	else
		print("Le chiffre $number est Impair\n");
}
?>
