<?php
include('display_cart.php');
include('remove_from_cart.php');
include('finalize_cart.php');
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <a  class='logo' href='index.php'><img class='logo' src="images/logo.png" width=8%/></a>
        <?php
        echo "<h2>Your cart</h2>";
        if (isset($_POST["remove_from_cart"]) && $_POST["remove_from_cart"] == "yes")
        {
            $_SESSION["product_id"] = $_POST["product_id"];
            remove_from_cart();
            $_POST["remove_from_cart"] = NULL;
            echo "We have updated your cart, removing the products you asked<br /><br />";
        }
        if (isset($_POST["checkout"]) && $_POST["checkout"] == "yes")
            finalize_cart();
        display_cart();
        ?>
    </body>
</html>
