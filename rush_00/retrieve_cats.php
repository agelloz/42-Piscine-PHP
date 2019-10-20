<?php 
function retrieve_cats() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $query_cats = "SELECT categories.id, categories.name
    FROM categories, products, links_products_categories
    WHERE products.stock > 0
    AND products.id = links_products_categories.product_id
    AND categories.id = links_products_categories.cat_id
    GROUP BY categories.name, categories.id";
    if (($result = $con->query($query_cats)) === FALSE)
        echo "Error - no categories found\n";
    echo "<div><ul>";
    echo "<li><a href='products.php?cat=all'>all</a></li>";
    while ($row_cat = mysqli_fetch_array($result)) 
        echo "<li><a href='products.php?cat=" . $row_cat['id'] . "'>" . $row_cat['name'] . "</a></li>";
    echo "</ul></div>";
}
?>