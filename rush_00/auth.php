<?php
function auth($login, $passwd)
{
    if (file_exists("../private/passwd") == FALSE)
        return (FALSE);
    $unser_accounts = unserialize(file_get_contents("../private/passwd"));
    if (empty($unser_accounts))
        return (FALSE);
    $hashed_pwd = hash('whirlpool', $_POST["passwd"]);
	foreach ($unser_accounts as $user)
		if ($user["login"] == $login && $user["passwd"] == $hashed_pwd)
            return (TRUE);
	return (FALSE);
}
?>