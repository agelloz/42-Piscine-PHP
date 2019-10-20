<?php

function ft_retrieve_cats() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $query_cats = "SELECT categories.cat_name FROM categories, products WHERE products.stock > 0 AND categories.cat_name = products.cat GROUP BY categories.cat_name";
    if (($result = $con->query($query_cats)) === FALSE)
        echo "Error - no categories found\n";
    echo "<div class='tags'>";
    echo "<div class=cats><a href='products.php?cat=all'>all</a></div>";
    while ($row_cat = mysqli_fetch_array($result)) 
    {
        $cat_name = $row_cat['cat_name'];
        echo "<div class=cats><a href='products.php?cat=$cat_name'>$cat_name</a></div>";
    }
    echo "</div>";
}
?>