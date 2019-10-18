<?php
session_start();
if (!isset($_SESSION["loggued_on_user"]) || $_SESSION["loggued_on_user"] == "")
{
    echo "ERROR\n";
    return (NULL);
}
echo $_SESSION["loggued_on_user"] . "\n";
?>