<?php 
function ft_get_products_by_cat() 
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
    $query_products = "SELECT * FROM `products` WHERE 1";
    if (!($result = $con->query($query_products)))
        echo "Error <br /><br />";
    while ($row_product = mysqli_fetch_array($result)) 
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
                <a href='products.php?cat=all'>
                <img src='$product_img' height='150' />
                </a>
                <h3>$product_price $</h3>
                <form action='checkout.php' method='post'>
                    <input type='text' name='quantity' value='1'/>
                    <input type='submit' name='trash' value='Discount ! - Add to cart'/>
                    <input type='hidden' name='product_id' value='$product_id'/>
                </form>
                </div>
            </div>
            ";
            echo "</div>";
        }
    }
}
?>