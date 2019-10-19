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
    echo "<iframe name='chat' frameborder='1' src='chat.php' width='400px' height='550px'></iframe>";
    echo "<br \>";
    echo "<iframe name='speak' frameborder='1' src='speak.php' width='400px' height='50px'></iframe>";
}
else
{
    $_SESSION["loggued_on_user"] = "";
	echo "ERROR\n";
}
?>