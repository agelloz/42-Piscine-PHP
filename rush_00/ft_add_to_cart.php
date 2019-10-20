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
}
?>