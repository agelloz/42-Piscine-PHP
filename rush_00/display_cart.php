<?php 
function display_cart() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $query_display_cart = "SELECT cart.product_id, products.price, products.img, products.name, SUM(cart.quantity) FROM cart, products WHERE products.id = cart.product_id GROUP BY cart.product_id";
    if (!($result = $con->query($query_display_cart)))
        echo "Error <br>";
    else
    {
        $supertotal = 0;
        while ($row_cart = mysqli_fetch_array($result))
        {
            $cart_product_name = $row_cart['name'];
            $cart_product_quantity = $row_cart['SUM(cart.quantity)'];
            $product_id = $row_cart['product_id'];
            $price = number_format($row_cart['price'], 2, ',', ' ');
            $total = $cart_product_quantity * $row_cart['price'];
            $supertotal = $supertotal + $total;
            $total = number_format($total, 2, ',', ' ');
            echo $cart_product_quantity." <b>".$cart_product_name."</b> at ".$price." € each for a total of <b>$total</b> € (VAT included)";
            echo "<form action='checkout.php' method='post'>
                    <input type='submit' name='trash' value='Remove all those products'/>
                    <input type='hidden' name='product_id' value='$product_id'/>
                    <input type='hidden' name='remove_from_cart' value='yes'/>
                </form>
                <br />
            ";
        }
        $supertotal = number_format($supertotal, 2, ',', ' ');
        if ($supertotal == 0)
        {
            echo "<br /> Your cart is currenty empty. Want to see our <a href='products.php'>best products</a> ? </b><br />";
        }
        else
        {
            echo "<br /> <u>Total order amount</u> : <b>".$supertotal." € (VAT included)</b><br />";
            //<!--<TO BE FINISHED>--->
            echo " <br />
            <form action='index.php' method='post'>
            <input type='submit' name='trash' value='Add new products to cart'/>
                </form>
                <br />
            ";
            if ($_SESSION["loggued_on_user"])
            {
                echo "<form action='checkout.php' method='post'>
                        <input type='hidden' name='checkout' value='yes'/>
                        <input type='submit' name='trash' value='Complete your order'/>
                        </form>
                        <br />
                ";
            }
            else
            {
                echo "<br />To complete your order, please <a href='login.html'>log in</a> or <a href='signup.html'>sign up</a> first. <br />Dont' worry, we will remember your cart contents.<br />";
            }
        }
    }
}
?>