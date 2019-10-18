<?php

function is_login_exists($pwd_file)
{
    if (file_exists($pwd_file) == FALSE)
		return (FALSE);
    $unser_accounts = unserialize(file_get_contents($pwd_file));
    if (empty($unser_accounts))
        return (FALSE);
	foreach ($unser_accounts as $user)
		if ($_POST['login'] == $user['login'])
			return (TRUE);
	return (FALSE);
}

function create_account($pwd_dir, $pwd_file)
{
    if (file_exists($pwd_dir) == FALSE)
        mkdir($pwd_dir, 0777);
    $hashed_pwd = hash('whirlpool', $_POST["passwd"]);
    if (file_exists($pwd_file) == TRUE)
        $unser_accounts = unserialize(file_get_contents($pwd_file));
    $unser_accounts[] = array('login' => $_POST["login"], 'passwd' => $hashed_pwd, 'mdp' => $_POST["passwd"]);
    $accounts[] = serialize($unser_accounts);
    file_put_contents($pwd_file, $accounts);
}

if (!isset($_POST["submit"]) || !isset($_POST["login"]) || !isset($_POST["passwd"]) || $_POST["submit"] != "OK")
    return NULL;
$pwd_dir = "../private";
$pwd_file = $pwd_dir . "/passwd";
if (is_login_exists($pwd_file) == FALSE && $_POST["login"] != NULL && $_POST["passwd"] != NULL)
{
    create_account($pwd_dir, $pwd_file);
    echo "OK\n";
}
else
    echo "ERROR\n";
//print("<pre>" . print_r(unserialize(file_get_contents($pwd_file)), true) . "</pre>");
?>