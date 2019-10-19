<?php
session_start();
echo $_SESSION['user_id'];
include('ft_add_to_cart.php');
$_SESSION["quantity"] = $_POST["quantity"];
$_SESSION["product_id"] = $_POST["product_id"];
ft_add_to_cart();
?>