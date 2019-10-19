<?php 
function ft_add_to_cart() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $quantity = $_SESSION["quantity"];
    $product_id = $_SESSION["product_id"];
    $user_id = $_SESSION["user_id"];
    $query_add_to_cart = "INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES (NULL, '$user_id', $product_id, $quantity)";
    if (($result = $con->query($query_add_to_cart)) == FALSE)
        echo "Error".mysqli_error($con)."<br />";
    else
        echo "<h2>We have updated your cart: </h2><br /><br />";
    $query_display_cart = "SELECT products.price, products.img, products.name, SUM(cart.quantity) FROM cart, products WHERE products.id = cart.product_id GROUP BY cart.product_id";
    if (!($result = $con->query($query_display_cart)))
        echo "Error <br>";
    else
    {
        $supertotal = 0;
        while ($row_cart = mysqli_fetch_array($result)) 
        {
            $cart_product_name = $row_cart['name'];
            $cart_product_quantity = $row_cart['SUM(cart.quantity)'];
            $total = $cart_product_quantity * $row_cart['price'];
            $supertotal = $supertotal + $total;
            $total = number_format($total, 2, ',', ' ');
            echo $cart_product_quantity." ".$cart_product_name." for a total of $total € (VAT included)<br /><br />";
            /*echo "<div id = periodic-row>";
            echo "
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
            ";
            echo "</div>";*/
        }
        $supertotal = number_format($supertotal, 2, ',', ' ');
        echo "<br /> <u>Total order amount</u> : <b>".$supertotal." € (VAT included)</b><br />";
    }
}
?>