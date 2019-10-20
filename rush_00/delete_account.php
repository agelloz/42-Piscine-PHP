<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
$query = "DELETE FROM users WHERE id='".$_SESSION["user_id"]."'";
if (($run = mysqli_query($con, $query)) == FALSE)
    die("ERROR: ".mysqli_error($con));
echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head><html><body><h2>" . $_SESSION["loggued_on_user"] . ", your account has been successfully deleted.<br>We are sad to see you go :(</h2></body></html>";
$_SESSION["loggued_on_user"] = NULL;
$_SESSION["user_id"] = hash('whirlpool', "guest_".session_id());
$_SESSION["admin"] == FALSE;
header("Refresh: 4;url=index.php");
?>