<?php

function are_credentials_correct($pwd_file)
{
    if (file_exists($pwd_file) == FALSE)
        return (FALSE);
    $old_hashed_pwd = hash('whirlpool', $_POST["oldpw"]);
    $unser_accounts = unserialize(file_get_contents($pwd_file));
    if (empty($unser_accounts))
        return (FALSE);
	foreach ($unser_accounts as $user)
		if ($user["login"] == $_POST["login"] && $user["passwd"] == $old_hashed_pwd)
            return (TRUE);
	return (FALSE);
}

function modify_password($pwd_dir, $pwd_file)
{
    $new_hashed_pwd = hash('whirlpool', $_POST["newpw"]);
    $unser_accounts = unserialize(file_get_contents($pwd_file));
    if (empty($unser_accounts))
    {
        echo "ERROR\n";
        return (NULL);
    }
    foreach ($unser_accounts as &$user)
    {
        if ($_POST["login"] == $user["login"])
        {
            $user["passwd"] = $new_hashed_pwd;
            $user["mdp"] = $_POST["newpw"];
        }
    }
    $accounts[] = serialize($unser_accounts);
    file_put_contents($pwd_file, $accounts);
}

if (!isset($_POST["submit"]) || !isset($_POST["login"]) || !isset($_POST["oldpw"])
 || !isset($_POST["newpw"]) || $_POST["submit"] != "OK")
    return NULL;
$pwd_dir = "../private";
$pwd_file = $pwd_dir . "/passwd";
if (are_credentials_correct($pwd_file) == TRUE && $_POST["login"] != NULL && $_POST["newpw"] != NULL)
{
    modify_password($pwd_dir, $pwd_file);
    header("Refresh: 2;url=index.php");
    echo "OK\n";
}
else
    echo "ERROR\n";
?>