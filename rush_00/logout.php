<?php
session_start();
$con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
$query_delete_from_cart = "DELETE FROM cart WHERE user_id='" . $_SESSION["user_id"] . "'";
if (($result = $con->query($query_delete_from_cart)) == FALSE)
    echo "Error ".mysqli_error($con)."<br>";
if ($_SESSION["loggued_on_user"] != NULL)
{
    echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head><html><body><h2>See you soon " . $_SESSION["loggued_on_user"] . "!</h2></body></html>";
    header("Refresh: 2;url=index.php");
}
$_SESSION["loggued_on_user"] =  NULL;
$_SESSION["user_id"] = hash('whirlpool', "guest_".session_id());
$_SESSION["admin"] == FALSE;
?>