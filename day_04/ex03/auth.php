<?php
function auth($login, $passwd)
{
    if (file_exists("../private/passwd") == FALSE)
        return (FALSE);
    $unser_accounts = unserialize(file_get_contents("../private/passwd"));
    if (empty($unser_accounts))
        return (FALSE);
	foreach ($unser_accounts as $user)
		if ($user["login"] == $login && $user["passwd"] == $passwd)
            return (TRUE);
	return (FALSE);
}
?>