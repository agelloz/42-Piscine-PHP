<?php 
function get_products_by_cat() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $flag = 0;
    if (isset($_GET['cat']) && $_GET['cat'] != 'all')
        $query_products = "SELECT products.id, products.name, products.price, products.img
        FROM products, categories, links_products_categories
        WHERE products.stock > 0
        AND products.id = links_products_categories.product_id
        AND links_products_categories.cat_id = " . $_GET['cat'] . " GROUP BY products.id";
    else
        $query_products = "SELECT products.id, products.name, products.price, products.img
        FROM products, categories, links_products_categories
        WHERE products.stock > 0 GROUP BY products.id";
    $result = $con->query($query_products);
    while ($row_product = mysqli_fetch_array($result))
    {
        $product_id = $row_product['id'];
        $product_name = $row_product['name'];
        $product_price = number_format($row_product['price'], 2, ',', ' ');
        $product_img = $row_product['img'];
        $flag = 1;
        echo "<div id = periodic-row>";
        echo "
        <div id='product'>
            <div class='cell'>
            <h3>$product_name for only <br />$product_price €</h3>
            <a href='products.php?cat=all'><img class=products src='$product_img'/></a>
            <form action='add_to_cart.php' method='POST'>
                <input type='text' name='qty' value='1' size='3'/>
                <input type='hidden' name='id' value='$product_id'/>
                <input type='submit' value='Add to cart'/>
            </form>
            </div>
        </div>
        ";
        echo "</div>";
    }
    if ($flag == 0)
        echo "Sorry we don't have any products in stock. Please come back later !<br />";
}
?>