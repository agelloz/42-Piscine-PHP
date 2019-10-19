<?php

function auth($login, $passwd)
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $hashed_pwd = hash('whirlpool', $_POST["passwd"]);
    $query_check = "SELECT login FROM users WHERE login='" . $_POST["login"] . "' AND password='" . $hashed_pwd . "'";
    $run = mysqli_query($con, $query_check);
    if ($run && mysqli_num_rows($run))
        return (TRUE);
    else
        return (FALSE);
}

session_start();
if (!isset($_POST["login"]) && !isset($_POST["passwd"]))
{
    $_SESSION["loggued_on_user"] = "";
    echo "ERROR\n";
    return (NULL);
}
if ($_POST["login"] != NULL && $_POST["passwd"] != NULL && auth($_POST["login"], $_POST["passwd"]) == TRUE)
{
    $_SESSION["loggued_on_user"] = $_POST["login"];
    echo "Hello " . $_SESSION["loggued_on_user"] . " !\n";
    header("Refresh: 1;url=index.php");
}    
else
{
    $_SESSION["loggued_on_user"] = "";
	echo "ERROR\n";
}
?>