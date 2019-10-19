<?php
include 'auth.php';
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
}
else
{
    $_SESSION["loggued_on_user"] = "";
	echo "ERROR\n";
}
?>