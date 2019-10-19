<?php
session_start();
include('ft_add_to_cart.php');
$_SESSION["quantity"] = $_POST["quantity"];
$_SESSION["product_id"] = $_POST["product_id"];
ft_add_to_cart();
?>