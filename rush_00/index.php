<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["user_id"]))
    $_SESSION["user_id"] = hash('whirlpool', "guest_".session_id());
if (!isset($_SESSION["admin"]))
    $_SESSION["admin"] = FALSE;
if (!isset($_SESSION["loggued_on_user"]))
    $_SESSION["loggued_on_user"] = NULL;
include('admin_functions.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Computer V3</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header" href="index.php">
            <a  class='logo' href='index.php'><img class='logo' src="images/logo.png" width=8%/></a>
            <ul>
                <?php
                if (!isset($_SESSION["loggued_on_user"]) || $_SESSION["loggued_on_user"] == NULL)
                {
                    echo "<li><a href='signup.html'>Sign up</a></li>";
                    echo "<li><a href='login.html'>Log in</a></li>";
                }
                $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                $sql = "SELECT products.name FROM cart, products WHERE products.id = cart.product_id
                AND cart.user_id='" . $_SESSION["user_id"] . "' GROUP BY products.name";
                $run = mysqli_query($con, $sql);
                $i = 0;
                while ($res = mysqli_fetch_array($run))
                    $i++;
                if ($i != 0)
                    echo "<li><a href='checkout.php'>My cart (". $i . ")</h2></a></li>";
                else
                    echo "<li><a href='checkout.php'>My cart</h2></a></li>";
                if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != NULL
                && $_SESSION["admin"] == TRUE)
                    echo "<li><a href='admin.php'>Admin</a></li>";
                if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != NULL)
                    echo "<li><a href=\"delete_account.php\" onclick=\"return confirm('Are you sure?');\">
                    Delete my account</a></li>";
                if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != NULL)
                {
                    echo "<li><a href='modif.html'>Change my password</a></li>";
                    echo "<li><a href='logout.php'>Log out</a></li>";
                }
                if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"]) 
                    echo "<li><a href='index.php'>Hello " . $_SESSION["loggued_on_user"] . "!</a></li>";
                ?>
            </ul>
        </div>
        <?php 
            echo "<div><iframe name='products' frameborder='0' src='products.php' width='100%'
            height='500px'></iframe></div>";
        ?>
    </body>
</html>