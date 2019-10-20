<?php 
function get_products_by_cat() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
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
        echo "<div id='periodic-row'>";
        echo "
        <div id='product'>
            <div class='cell'>
            <h3>$product_name for only <br />$product_price €</h3>
            <a href='products.php?cat=all'>
            <img class='products' src='$product_img'/>
            </a>
            <form action='add_to_cart.php' method='get'>
                <input type ='submit' name='add' value='Add to cart'/>
                <input type ='text' name='qty' value='1'/>
                <input type ='hidden' name='id' value='$product_id'/>
            </form>
            </div>
        </div>
        ";
        echo "</div>";
    }
}
?>