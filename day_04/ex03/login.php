<?php
include 'auth.php';
session_start();
if (!isset($_GET["login"]) && !isset($_GET["passwd"]))
    return (NULL);
if ($_GET["login"] != NULL && $_GET["passwd"] != NULL && auth($_GET["login"], $_GET["passwd"]) == TRUE)
{
    $_SESSION["loggued_on_user"] = $_GET["login"];
    echo "OK\n";
}
else
{
    $_SESSION["loggued_on_user"] = "";
	echo "ERROR\n";
}
?>