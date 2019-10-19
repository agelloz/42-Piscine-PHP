<?php
include('ft_add_to_cart.php');
session_start();
if (!isset($_SESSION["user_id"]))
    $_SESSION["user_id"] = hash('whirlpool', "guest_".session_id());
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
        </div>
    </body>
</html>

<?php
$_SESSION["product_id"] = $_POST["product_id"];
$_SESSION["quantity"] = $_POST["quantity"];
ft_add_to_cart();
?>