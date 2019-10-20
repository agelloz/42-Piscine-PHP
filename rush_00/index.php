<!DOCTYPE html>
<?php
include('admin_functions.php');
session_start();
if (!isset($_SESSION["user_id"]))
    $_SESSION["user_id"] = hash('whirlpool', "guest_".session_id());
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Computer V3</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
            <?php 
            if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"]) echo "<p>Hello " . $_SESSION["loggued_on_user"] . "!</p>";
            if (!isset($_SESSION["loggued_on_user"]) || $_SESSION["loggued_on_user"] == "")
            {
                echo "<a href='signup.html'>Sign up</a> - ";
                echo "<a href='login.html'>Log in</a> - ";
            }
            else
            {
                echo "<a href='logout.php'>Log out</a> - ";
                echo "<a href='modif.html'>Change your password</a> - ";
            }
            if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"])
                echo "<a href='admin.php'>Admin</a> - ";
            $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
            $sql = "SELECT products.name FROM cart, products WHERE products.id = cart.product_id AND cart.user_id='" . $_SESSION["user_id"] . "' GROUP BY products.name";
            $run = mysqli_query($con, $sql);
            $i = 0;
            while ($res = mysqli_fetch_array($run))
                $i++;
            if ($i != 0)
                echo "<a href='checkout.php'>Your cart (". $i . ")</h2></a>";
            else
                echo "<a href='checkout.php'>Your cart</h2></a>";
            ?>
        </div>
        <div>
            <?php 
                echo "<iframe name='products' frameborder='0' src='products.php' width='100%' height='500px'></iframe>";
            ?>
        </div>
        <hr size="5" width="100%" color="white">
        <?php debug_view(); ?>
    </body>
</html>