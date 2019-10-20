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
            function ft_update()
            {

            }
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
            // View Users
            echo "<?php debug_view(); ?>";
            // View and delete Users

            // View, update and delete Products
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
                                echo "<form action='admin.php' method='get'>";
                                echo "Product_id: ".$_POST['product_id']."<br />";
                                echo "Product_name: ".$row_view_products['name']."    ";
                                echo "<input type='text' name='update_valut' style='width: 50px' value=' '/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value=$product_id/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value=product_name/>";
                                echo "<input type='submit' name='action' value='Update name'/>"."<br />";
                                echo "Product_price: ".$row_view_products['price']."<br />";
                                echo "Product_price: ".$row_view_products['stock']."<br />";
                                echo "<input type='submit' name='action' value='Delete'/>"."<br />";
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

