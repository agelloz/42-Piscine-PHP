<?php 
function ft_remove_from_cart() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $product_id = $_SESSION["product_id"];
    $query_delete_from_cart = "DELETE FROM `cart` WHERE `cart`.`product_id` = $product_id";
    if (($result = $con->query($query_delete_from_cart)) == FALSE)
        echo "Error".mysqli_error($con)."<br />";
}
?>