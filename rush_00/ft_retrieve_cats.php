<?php 
function ft_retrieve_cats() 
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
    $query_cats = "SELECT * FROM `cats` WHERE 1";
    if (!($result = $con->query($query_cats)))
        echo "Error-- <br /><br />";
    echo "<div class=tags>";
    while ($row_cat = mysqli_fetch_array($result)) 
    {
        $cat_id = $row_cat['cat_id'];
        $cat_name = $row_cat['cat_name'];
        echo "<div><a href='products.php?cat_$cat_id=yes'>$cat_name</a></div>";
    }
    echo "</div>";
    echo "<div >  
    <a href='products.php?cat=all'>
    Tout voir
    </a></div>";
}
?>