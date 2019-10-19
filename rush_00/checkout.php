<?php
    session_start();
?>
<!DOCTYPE html>
<?php
    include('ft_add_to_cart.php');
?>
<?php
$_SESSION["quantity"] = $_POST["quantity"];
$_SESSION["product_id"] = $_POST["product_id"];
ft_add_to_cart();
?>