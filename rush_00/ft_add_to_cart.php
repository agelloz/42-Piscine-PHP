<?php 
function ft_add_to_cart() 
{
    $hostname = "127.0.0.1";
    $username = "raphael";
    $password = "raphael";
    if (!($con = mysqli_connect($hostname, $username, $password)))
      echo "Error <br /><br />";
    $db = "rush00_test";
    $query_use_db = "USE $db";
    if (!($con->query($query_use_db)))
        echo "Error <br /><br />";

    $quantity = $_SESSION["quantity"];
    $product_id = $_SESSION["product_id"];
    $user_id = $_SESSION["user_id"];
        
    $query_add_to_cart = "INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES (NULL, $user_id, $product_id, $quantity)";
    if (!($result = $con->query($query_add_to_cart)))
        echo "Error <br /><br />";
    else
        echo "Nous avons bien mis a jour votre panier. Pour memoire, il se compose maintenant des elements suivants : <br /><br />";

    $query_display_cart = "SELECT product_id, SUM(quantity) FROM cart GROUP BY product_id";
    if (!($result = $con->query($query_display_cart)))
        echo "Error <br /><br />";
    else
    {
        while ($row_cart = mysqli_fetch_array($result)) 
        {
            $cart_product = $row_cart['product_id'];
            $cart_product_quantity = $row_cart['SUM(quantity)'];
            echo $cart_product_quantity." X ".$cart_product."<br /><br />";
        }
    }
    

    /*while ($row_product = mysqli_fetch_array($result)) 
    {
        $product_id = $row_product['product_id'];
        $product_name = $row_product['product_name'];
        $product_price = $row_product['product_price'];
        $product_stock = $row_product['product_stock'];
        $product_img = $row_product['product_img'];
        $product_cat = $row_product['product_cat'];
        if (!empty($_GET['cat_'.$product_cat]) || (!empty($_GET['cat'])))
        {
            echo "<div id = periodic-row>";
            echo "
            <div id='product'>
                <div class='cell'>
                <h3>$product_name</h3>
                <a href='products.php?prod_id=$product_id'>
                <img src='$product_img' height='150' />
                </a>
                <h3>$product_price $</h3>
                <form action='add_to_cart.php'>
                <input type='submit' name='submit' value='Add to cart'/>
                </form>
                </div>
            </div>
            ";
            echo "</div>";
        }
    }*/
}
?>