<?php 
function ft_add_to_cart() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root");
    $quantity = $_SESSION["quantity"];
    $product_id = $_SESSION["product_id"];
    $user_id = $_SESSION["user_id"];
    $query_add_to_cart = "INSERT INTO cart (id, user_id, product_id, quantity) VALUES (NULL, $user_id, $product_id, $quantity)";
    if (($result = $con->query($query_add_to_cart)) == FALSE)
        echo "Error <br>";
    else
        echo "Nous avons bien mis a jour votre panier. Pour memoire, il se compose maintenant des elements suivants : <br><br>";

    $query_display_cart = "SELECT product_id, SUM(quantity) FROM cart GROUP BY product_id";
    if (!($result = $con->query($query_display_cart)))
        echo "Error <br>";
    else
    {
        while ($row_cart = mysqli_fetch_array($result)) 
        {
            $cart_product = $row_cart['product_id'];
            $cart_product_quantity = $row_cart['SUM(quantity)'];
            echo $cart_product_quantity." X ".$cart_product."<br>";
        }
    }
}
?>