<?php
session_start();
if ($_SESSION["loggued_on_user"])
{
    echo "Goodbye " . $_SESSION["loggued_on_user"] . " !\n";
    header("Refresh: 1;url=index.php");
}
$_SESSION["loggued_on_user"] =  "";
$_SESSION["user_id"] = 42;
?>