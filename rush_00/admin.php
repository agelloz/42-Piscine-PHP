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
                echo "<a href='index.php'>Back to index page</a> ";

            // Updates previously asked

            if (isset($_POST['action']))
            {
                if ($_POST['action'] == 'add_category' && isset($_POST['category_name']))
                {
                    $category_name = $_POST['category_name'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_add_category = "INSERT INTO `categories` (`cat_name`) VALUES ('$category_name')";
                    if (!($result_add_category = $con->query($query_add_category)))
                        echo "Error01e <br>".mysqli_error($con)."<br>";
                }
                if ($_POST['action'] == 'add_product' && isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_stock']))
                {
                    $product_name = $_POST['product_name'];
                    $product_price = $_POST['product_price'];
                    $product_stock = $_POST['product_stock'];
                    if (!isset($_POST['product_img']) || $_POST['product_img'] == '')
                        $product_img = "http://hansatoysusa.com/image/cache/data/productImages/3159-penguin-small-hansa-toys-usa-500x500.jpg";
                    else
                        $product_img = $_POST['product_img'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_add_product = "INSERT INTO `products` (`id`, `name`, `price`, `stock`, `img`) VALUES (NULL, '$product_name', '$product_price', '$product_stock', '$product_img')";
                    if (!($result_add_product = $con->query($query_add_product)))
                        echo "Error01d <br>".mysqli_error($con)."<br>";
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_add_product = "SELECT INTO `products` (`id`, `name`, `price`, `stock`, `img`) VALUES (NULL, '$product_name', '$product_price', '$product_stock', '$product_img')";
                    if (!($result_add_product = $con->query($query_add_product)))
                        echo "Error01d <br>".mysqli_error($con)."<br>";

                    /* SECTION TO ADD TO CATEGORY LINK ONLY to trigger if 
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_special_id = "SELECT * FROM `products` WHERE `name` LIKE '$product_name' AND `price` = '$product_price' AND `stock` = '$product_stock'";
                    if (!($result_special_id = $con->query($query_special_id)))
                        echo "Error0q <br>";
                    else
                    {
                        while ($row_special_id = mysqli_fetch_array($result_special_id)) 
                        {
                            $product_id = $row_special_id['cat_id'];
                        }
                    }
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_add_link = "INSERT INTO `links_products_categories` (`product_id`, `cat_id`) VALUES ('$product_id', '') ";
                    if (!($result_add_link = $con->query($query_add_link)))
                        echo "Error0q <br>";*/
                }
                if ($_POST['action'] == 'delete_product' && isset($_POST['product_id']))
                {
                    $product_id = $_POST['product_id'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_delete_product = "DELETE FROM `products` WHERE products.id = $product_id";
                    if (!($result_delete_product = $con->query($query_delete_product)))
                        echo "Error01 <br>".mysqli_error($con)."<br>";
                    $query_delete_product = "DELETE FROM `links_products_categories` WHERE `links_products_categories`.`product_id` = $product_id";
                    if (!($result_delete_product = $con->query($query_delete_product)))
                        echo "Error02 <br>".mysqli_error($con)."<br>";

                }
                if ($_POST['action'] == 'delete_category' && isset($_POST['cat_id']))
                {
                    $cat_id = $_POST['cat_id'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    $query_delete_category = "DELETE FROM `categories` WHERE cat_id = $cat_id";
                    if (!($result_delete_category = $con->query($query_delete_category)))
                        echo "Error01qw <br>".mysqli_error($con)."<br>";
                    $query_delete_category = "DELETE FROM `links_products_categories` WHERE `links_products_categories`.`cat_id` = $cat_id";
                    if (!($result_delete_category = $con->query($query_delete_category)))
                        echo "Error02qwe <br>".mysqli_error($con)."<br>";
                }

                if ($_POST['action'] == 'update_category' && isset($_POST['update_value']) && isset($_POST['cat_id']) && isset($_POST['update_field']))
                {
                    $cat_id = $_POST['cat_id'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    if ($_POST['update_field'] == 'cat_name')
                    {
                        $category_update_value = $_POST['update_value'];
                        $query_update_category = "UPDATE `categories` SET `cat_name` = '$category_update_value' WHERE `categories`.`cat_id` = '$cat_id' ";
                        if (!($result_update_category = $con->query($query_update_category)))
                            echo "Error03aqa <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                }

                if ($_POST['action'] == 'update_product' && isset($_POST['update_field']) && isset($_POST['product_id']) && isset($_POST['update_value']))
                {
                    $product_id = $_POST['product_id'];
                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                    if ($_POST['update_field'] == 'product_name')
                    {
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `name` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03a <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                    if ($_POST['update_field'] == 'product_price')
                    {
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `price` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03b <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                    if ($_POST['update_field'] == 'product_stock')
                    {
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `stock` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03c <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                    if ($_POST['update_field'] == 'product_img')
                    {
                        $product_update_value = $_POST['update_value'];
                        $query_update_product = "UPDATE `products` SET `img` = '$product_update_value' WHERE `products`.`id` = '$product_id' ";
                        if (!($result_update_product = $con->query($query_update_product)))
                            echo "Error03d <br>".mysqli_error($con)."<br>";
                        $_POST['update_value'] = "";
                    }
                }
            }


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
                    $query_view_products = "SELECT products.id, products.name, products.price, products.stock, products.img FROM `products`";
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
                                $product_img = $row_view_products['img'];
                                echo "<form action='admin.php' method='post'>";
                                echo "Product_id: ".$_POST['product_id']."<br />";
                                echo "Product_name: "."    ";
                                echo "<input type='text' name='update_value' style='width: 200px' value='$product_name'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_name'/>";
                                echo "<input type='submit' name='action' value='update_product'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "Product_price (€): "."    ";
                                echo "<input type='text' name='update_value' style='width: 50px' value='$product_price'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_price'/>";
                                echo "<input type='submit' name='action' value='update_product'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "Product_stock: "."    ";
                                echo "<input type='text' name='update_value' style='width: 100px' value='$product_stock'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_stock'/>";
                                echo "<input type='submit' name='action' value='update_product'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "Product_img_link (facultative): "."    "."<br />";
                                echo "<input type='text' name='update_value' style='width: 400px' value='$product_img'/>";
                                echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                                echo "<input type='hidden' name='update_field' style='width: 24px' value='product_img'/>";
                                echo "<input type='submit' name='action' value='update_product'/>"."<br />";
                                echo "</form>";

                                echo "<form action='admin.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='$product_id'/>";
                                echo "<input type='submit' name='action' value='delete_product'/>"."<br />";
                                echo "</form>";

                            }
                        }
                    }

                }
                else
                    echo "  ";
            }
            echo "<br /><br /><b>Select product to create </b> :<br />";
            echo "<form action='admin.php' method='post'>";

            echo "Product_name: "."    ";
            echo "<input type='text' name='product_name' style='width: 200px' value=''/><br />";

            echo "Product_price (€): "."    ";
            echo "<input type='text' name='product_price' style='width: 50px' value=''/><br />";

            echo "Product_stock: "."    ";
            echo "<input type='text' name='product_stock' style='width: 100px' value=''/><br />";

            echo "Product_img_link (facultative): "."    "."<br />";
            echo "<input type='text' name='product_img' style='width: 400px' value=''/><br />";

            $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
            $query_view_categories = "SELECT cat_id, cat_name FROM `categories`";
            if (!($result_view_categories = $con->query($query_view_categories)))
                echo "Error0q <br>";
            else
            {
                echo "Categories (facultative):<br />";
                while ($row_view_categories = mysqli_fetch_array($result_view_categories)) 
                {
                    $cat_id = $row_view_categories ['cat_id'];
                    $cat_name = $row_view_categories ['cat_name'];
                    echo "<input type='checkbox' name='$cat_id'><label for='$cat_id'>$cat_name</label>";
                    echo "<br />";
                }
            }
            
            echo "<input type='submit' name='action' value='add_product'/>"."<br />";
            echo "</form>";

            // category management
            $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
            $query_view_categories = "SELECT cat_id, cat_name FROM `categories`";
            if (!($result_view_categories = $con->query($query_view_categories)))
                echo "Error0q <br>";
            else
            {
                echo "<br /><br /> <b>Select category to manage </b> : 
                <form action='admin.php' method='post'>
                    <select id='cat_id' name='cat_id'>
                        <optgroup label='Categories'>
                            <option value='All'>All</option>";
                while ($row_view_categories = mysqli_fetch_array($result_view_categories)) 
                {
                    $cat_id = $row_view_categories ['cat_id'];
                    $cat_name = $row_view_categories ['cat_name'];
                    $option = $cat_name." (id_".$cat_id.")";
                    echo "<option value='$cat_id'>$option</option>";
                }
                echo "          <input onclick='search' type='submit' value='Search' />
                                </optgroup>
                            </select>
                        </form>";
            }
            if (isset($_POST['cat_id']) && $_POST['cat_id'] != "All")
            {
                $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                $query_view_categories = "SELECT cat_id, cat_name FROM `categories`";
                if (!($result_view_categories = $con->query($query_view_categories)))
                    echo "Error0q <br>";
                else
                {
                    while ($row_view_categories = mysqli_fetch_array($result_view_categories))
                    {
                        if($row_view_categories['cat_id'] == $_POST['cat_id'])
                        {
                            $cat_id = $row_view_categories ['cat_id'];
                            $cat_name = $row_view_categories ['cat_name'];
                            echo "<form action='admin.php' method='post'>";
                            echo "Category_id: ".$_POST['cat_id']."<br />";
                            echo "Category_name: "."    ";
                            echo "<input type='text' name='update_value' style='width: 200px' value='$cat_name'/>";
                            echo "<input type='hidden' name='cat_id' style='width: 24px' value='$cat_id'/>";
                            echo "<input type='hidden' name='update_field' style='width: 24px' value='cat_name'/>";
                            echo "<input type='submit' name='action' value='update_category'/>"."<br />";
                            echo "</form>";

                            echo "<form action='admin.php' method='post'>";
                            echo "<input type='hidden' name='cat_id' value='$cat_id'/>";
                            echo "<input type='submit' name='action' value='delete_category'/>"."<br />";
                            echo "</form>";
                        }
                    }
                }
            }

            // category creation
            echo "<br /><br /><b>Select category to create </b> :<br />";
            echo "<form action='admin.php' method='post'>";
            echo "Category_name: "."    ";
            echo "<input type='text' name='category_name' style='width: 200px' value=''/><br />";
            echo "<input type='submit' name='action' value='add_category'/>"."<br />";
            echo "</form>";

            // View Users
            echo "<br /><br /> <b>View users and your current cart </b> :";
            debug_view();
            // Delete Users
            ?>
    </body>
</html>
