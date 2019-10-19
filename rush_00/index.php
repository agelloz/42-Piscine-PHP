<!DOCTYPE html>
<?php
include('admin_functions.php');
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
        </div>
        <a href="signup.html">Sign up</a>
        <a href="login.html">Log in</a>
        <a href="logout.php">Log out</a>
        <a href="modif.html">Change password</a>
        <a href="products.php?cat=all">Products</a>
        <hr size="5" width="100%" color="white">
        <?php if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"]) echo "<p>Hello " . $_SESSION["loggued_on_user"] . " !</p>"; ?>
        <!--<?php view_users(); ?> -->
    </body>
</html>