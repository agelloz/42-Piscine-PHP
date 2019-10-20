<?php 
function ft_get_products_by_cat() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $flag = 0;
    if (isset($_GET['cat']) && $_GET['cat'] != 'all')
        $query_products = "SELECT * FROM products WHERE cat='" . $_GET['cat'] . "'";
    else
        $query_products = "SELECT * FROM products";
    $result = $con->query($query_products);
    while ($row_product = mysqli_fetch_array($result))
    {
        $product_id = $row_product['id'];
        $product_name = $row_product['name'];
        $product_price = number_format($row_product['price'], 2, ',', ' ');
        $product_stock = $row_product['stock'];
        $product_img = $row_product['img'];
        $product_cat = $row_product['cat'];
        if ($product_stock > 0)
        {
            $flag = 1;
            echo "<div id = periodic-row>";
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
                    <input type='hidden' name='add_to_cart' value='yes'/>
                </form>
                </div>
            </div>
            ";
            echo "</div>";
        }
    }
    if ($flag == 0)
    {
        echo "Sorry we don't have any products in stock. Please come back later !<br />";
    }
}
?>