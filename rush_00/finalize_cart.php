<?php 
function finalize_cart() 
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $user_id = $_SESSION["user_id"];
    $flag = 0;
    $query_check_quantities = "SELECT products.name, products.id, products.stock, SUM(cart.quantity) FROM cart, products WHERE products.id = cart.product_id AND cart.user_id = $user_id GROUP BY cart.product_id";
    if (!($result_check_quantities = $con->query($query_check_quantities)))
        echo "Error0 <br>";
    else
    {
        while ($row_check_quantities = mysqli_fetch_array($result_check_quantities)) 
        {
            $check_quantities_product_id = $row_check_quantities['id'];
            $check_quantities_product_name = $row_check_quantities['name'];
            $check_quantities_product_stock = $row_check_quantities['stock'];
            $check_quantities_product_stock_needed = $row_check_quantities['SUM(cart.quantity)'];
            //echo "pour user ".$user_id." produit ".$check_quantities_product_id." faut ".$check_quantities_product_stock_needed." -- mais YA 'que':".$check_quantities_product_stock."<br />";
            if (($updated_stock = $check_quantities_product_stock - $check_quantities_product_stock_needed) >= 0)
            {
                $flag = 1;
                //echo $check_quantities_product_id."diff vaut ".$updated_stock."<br />";
                $query_delete_stock_from_products = "UPDATE `products` SET `stock` = $updated_stock WHERE `products`.`id` = $check_quantities_product_id";
                if (($result = $con->query($query_delete_stock_from_products)) == FALSE)
                {
                    echo "Error updating products for product id".$check_quantities_product_id."   ".mysqli_error($con)."<br />";
                }
                else
                    //echo "WELL UPDATED STOCK<br />";
                
                $query_empty_cart = "DELETE FROM `cart` WHERE `cart`.`user_id` = $user_id AND cart.product_id = $check_quantities_product_id";
                if (($result = $con->query($query_empty_cart)) == FALSE)
                    echo "Error updating products for product id".$check_quantities_product_id."   ".mysqli_error($con)."<br />";
                //else
                    //echo "WELL EMPTIED CART LINES<br />";
                
            }
            else 
                echo "(<u>WARNING</u>) : product ".$check_quantities_product_name." was not taken into account as we only have ".$check_quantities_product_stock." left in our stock.<br />";
        }
    }
    if ($flag == 1)
        echo "<b>Congratulations, your order has been completed.</b> We will ship the product shortly. You can now <a href='logout.php'>Log out</a>.<br /><br />";
}   
?>