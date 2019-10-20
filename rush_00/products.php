<!DOCTYPE html>
<?php
    session_start();
    include('ft_get_products_by_cat.php');
    include('ft_retrieve_cats.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
        </div>
        <div class="header" href="index.php">
            <a href="signup.html"><h2>Sign up</a> - 
            <a href="login.html">Log in</a> - 
            <?php 
            if ($_SESSION["loggued_on_user"])
            {
                echo "<a href='logout.php'>Log out</a> - ";
                echo "<a href='modif.html'>Change password</a> - ";
            }
            ?>
            <a href="products.php?cat=all">Discover our products</a> -
            <a href="checkout.php">Check your cart</h2></a>
        </div>
        <div class="main-nav">
            <?php ft_retrieve_cats(); ?>
        </div>
        <ul class="main-nav">
            <?php ft_get_products_by_cat(); ?>
            <li>
                <form action="add_to_cart.php">
                    <?PHP
                        /*foreach ($_GET as $key => $param)
                        {
                            if ($param !== NULL)
                                $param = $param;
                        }
                        echo '<input type="hidden" name="pro_id" value="'.$param.'"/>';
                        echo '<input type="submit" name="submit" value="Add to cart"/>';*/
                    ?>
                </form>
            </li>
        </ul>
    </body>
</html>