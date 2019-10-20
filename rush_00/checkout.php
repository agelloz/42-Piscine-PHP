<?php
include('ft_add_to_cart.php');
include('ft_display_cart.php');
include('ft_remove_from_cart.php');
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
    <!--<div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
        </div>
    </body>*/--> 
</html>

<?php
echo "<h2>Your cart</h2>";
if (isset($_POST["add_to_cart"]) && $_POST["add_to_cart"] == "yes")
{
    $_SESSION["quantity"] = $_POST["quantity"];
    $_SESSION["product_id"] = $_POST["product_id"];
    ft_add_to_cart();
    $_POST["add_to_cart"] = "";
    echo "We have updated your cart with the new products<br /><br />";
}
if (isset($_POST["remove_from_cart"]) && $_POST["remove_from_cart"] == "yes")
{
    $_SESSION["product_id"] = $_POST["product_id"];
    ft_remove_from_cart();
    $_POST["remove_from_cart"] = "";
    echo "We have updated your cart, removing the products you asked<br /><br />";
}
ft_display_cart();

/*echo "
<div id='product'>
    <div class='cell'>
    <h3>$product_name for only <br />$product_price €</h3>
    <a href='products.php?cat=all'>
    <img class=products src='$product_img' height='150' width='150'/>
    </a>
    <form action='checkout.php' method='post'>
        <input type='text' name='quantity' value='1'/>
        <input type='submit' name='trash' value='Discount ! - Add to cart'/>
        <input type='hidden' name='product_id' value='$product_id'/>
    </form>
    </div>
</div>
";*/
?>