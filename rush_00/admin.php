<!DOCTYPE html>
<?php
include('admin_functions.php');
session_start();
if (!isset($_SESSION["user_id"]))
    $_SESSION["user_id"] = hash('whirlpool', "guest_".session_id());
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Computer V3</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header" href="index.php">
            <a href="index.php"><img class="logo" src="images/logo.png"/></a>
            <?php
            if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"]) echo "<p>Welcome to <a href='admin.php'>Admin</a> board " . $_SESSION["loggued_on_user"] . "!</p>";
            if (!isset($_SESSION["loggued_on_user"]) || $_SESSION["loggued_on_user"] == "")
            {
                echo "<a href='signup.html'>Sign up</a> - ";
                echo "<a href='login.html'>Log in</a> - ";
            }
            else
            {
                echo "<a href='logout.php'>Log out</a> - ";
                echo "<a href='modif.html'>Change your password</a> - ";
            }
            if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"])
                echo "<a href='index.php'>Back to index page</a> - ";

            // Updates previously asked

            if (isset($_POST['action']))
            {
                if ($_POST['action'] == 'delete' && isset($_POST['product_id']))
                {
                    $product_id = $_POST['product_id'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_delete_product = "DELETE FROM `products` WHERE products.id = $product_id";
                    if (!($result_delete_product = $con->query($query_delete_product)))
                        echo "Error01 <br>";
                    $query_delete_product = "DELETE FROM `links_products_categories` WHERE `links_products_categories`.`product_id` = $product_id";
                    if (!($result_delete_product = $con->query($query_delete_product)))
                        echo "Error02 <br>";

                }
                if ($_POST['action'] == 'update' && isset($_POST['update_field']) && isset($_POST['product_id']) && isset($_POST['update_value']))
                {
                    echo "JE RENTRE";
                    $product_id = $_POST['product_id'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    if ($_POST['update_field'] == 'product_name')
                    {
                        echo "JE RENTREa<br />";
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `name` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03a <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                    if ($_POST['update_field'] == 'product_price')
                    {
                        echo "JE RENTREb<br />";
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `price` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03b <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                    if ($_POST['update_field'] == 'product_stock')
                    {
                        echo "JE RENTREc<br />";
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `stock` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03c <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                }
            }
            // View Users
            echo "<?php debug_view(); ?>";
            // View and delete Users

            // View, update and delete Products, add products
            $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
            $query_view_products = "SELECT products.id, products.name, products.price, products.stock FROM `products`";
            if (!($result_view_products = $con->query($query_view_products)))
                echo "Error0 <br>";
            else
            {
                echo "<br /><br /> <b>Select product to manage </b> : 
                        <form action='admin.php' method='post'>
                            <select id='product_id' name='product_id'>
                                <optgroup label='Products'>
                                    <option value='All'>All</option>";
                while ($row_view_products = mysqli_fetch_array($result_view_products)) 
                {
                    $product_id = $row_view_products['id'];
                    $product_name = $row_view_products['name'];
                    $product_price = $row_view_products['price'];
                    $product_stock = $row_view_products['stock'];
                    //$product_price = $row_view_products['stock'];
                    $option = $product_name." (id_".$product_id.")";
                    echo "<option value='$product_id'>$option</option>";
                }
                echo "          <input onclick='search' type='submit' value='Search' />
                                </optgroup>
                            </select>
                        </form>";
                if (isset($_POST['product_id']) && $_POST['product_id'] != "All")
                {
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_view_products = "SELECT products.id, products.name, products.price, products.stock FROM `products`";
                    if (!($result_view_products = $con->query($query_view_products)))
                        echo "Error0 <br>";
                    else
                    {
                        while ($row_view_products = mysqli_fetch_array($result_view_products))
                        {
                            if($row_view_products['id'] == $_POST['product_id'])
                            {
                                $product_id = $row_view_products['id'];
                                $product_name = $row_view_products['name'];
                                $product_price = $row_view_products['price'];
                                $product_stock = $row_view_products['stock'];
                                echo "<form action='admin.php' method='post'>";
                                echo "Product_id: ".$_POST['product_id']."<br />";
                                echo "Product_name: "."    ";
                                echo "<input type='text' name='update_value' style='width: 100px' value='$product_name'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_name'/>";
                                echo "<input type='submit' name='action' value='update'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "Product_price (€): "."    ";
                                echo "<input type='text' name='update_value' style='width: 100px' value='$product_price'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_price'/>";
                                echo "<input type='submit' name='action' value='update'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "Product_stock: "."    ";
                                echo "<input type='text' name='update_value' style='width: 100px' value='$product_stock'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_stock'/>";
                                echo "<input type='submit' name='action' value='update'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='$product_id'/>";
                                echo "<input type='submit' name='action' value='delete'/>"."<br />";
                                echo "</form>";

                            }
                        }
                    }

                }
                else
                    echo "  ";
            }
            ?>
    </body>
</html>
