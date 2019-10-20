<?php
include('add_to_cart.php');
include('display_cart.php');
include('remove_from_cart.php');
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
        <div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
        </div>
        <?php
        echo "<h2>Your cart</h2>";
        if (isset($_POST["add_to_cart"]) && $_POST["add_to_cart"] == "yes")
        {
            $_SESSION["quantity"] = $_POST["quantity"];
            $_SESSION["product_id"] = $_POST["product_id"];
            add_to_cart();
            $_POST["add_to_cart"] = "";
            echo "We have updated your cart with the new products<br /><br />";
        }
        if (isset($_POST["remove_from_cart"]) && $_POST["remove_from_cart"] == "yes")
        {
            $_SESSION["product_id"] = $_POST["product_id"];
            remove_from_cart();
            $_POST["remove_from_cart"] = "";
            echo "We have updated your cart, removing the products you asked<br /><br />";
        }
        display_cart();
        ?>
    </body>
</html>