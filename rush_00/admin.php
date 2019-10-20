<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <title>Computer V3</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <a  class='logo' href='index.php'><img class='logo' src="images/logo.png" width=8%/></a>
        <?php
        echo "<ul><li><a href='logout.php'>Log out</a></li>";
        echo "<li><a href='modif.html'>Change your password</a></li>";
        if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"])
            echo "<li><a href='index.php'>Back to main page</a></li></ul>";
        if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"]) 
            echo "<p>Welcome to the admin board " . $_SESSION["loggued_on_user"] . "!</p>";
        // Updates previously asked
        $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
        if (isset($_POST['action']))
        {
            if ($_POST['action'] == 'add_category' && isset($_POST['category_name']))
            {
                $category_name = $_POST['category_name'];
                $query_add_category = "INSERT INTO categories (name) VALUES ('$category_name')";
                if (!($result_add_category = $con->query($query_add_category)))
                    echo "Error01e <br>".mysqli_error($con)."<br>";
            }
            if ($_POST['action'] == 'add_product' && isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_stock']))
            {
                $product_name = $_POST['product_name'];
                $product_price = $_POST['product_price'];
                $product_stock = $_POST['product_stock'];
                if (!isset($_POST['product_img']) || $_POST['product_img'] == '')
                    $product_img = 'http://hansatoysusa.com/image/cache/data/productImages/3159-penguin-small-hansa-toys-usa-500x500.jpg';
                else
                    $product_img = $_POST['product_img'];
                $query_add_product = "INSERT INTO products (name, price, stock, img) VALUES ('$product_name', '$product_price', '$product_stock', '$product_img')";
                if (!($result_add_product = $con->query($query_add_product)))
                    echo "Error01d1 <br>".mysqli_error($con)."<br>";
                //Start new work
                $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                $query_special_id = "SELECT * FROM `products` WHERE `name` LIKE '$product_name' AND `price` = '$product_price' AND `stock` = '$product_stock'";
                if (!($result_special_id = $con->query($query_special_id)))
                    echo "Error0q <br>";
                else
                {
                    while ($row_special_id = mysqli_fetch_array($result_special_id)) 
                    {
                        $product_id = $row_special_id['id'];
                    }
                }
                $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                $query_view_categories = "SELECT id, name FROM categories";
                if (!($result_view_categories = $con->query($query_view_categories)))
                    echo "Error0q3 <br>";
                else
                {
                    while ($row_view_categories = mysqli_fetch_array($result_view_categories))
                    {
                        $cat_id = $row_view_categories['id'];
                        if (isset($_POST[$cat_id]) && $_POST[$cat_id] == "on")
                        {
                            $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                            $query_insert_link = "INSERT INTO `links_products_categories` (`product_id`, `cat_id`) VALUES ('$product_id', '$cat_id') ";
                            if (!($result_insert_link = $con->query($query_insert_link)))
                                echo "Error0q3 <br>";
                        }
                    }
                }
            }
            if ($_POST['action'] == 'delete_product' && isset($_POST['product_id']))
            {
                $product_id = $_POST['product_id'];
                $query_delete_product = "DELETE FROM products WHERE products.id = $product_id";
                if (!($result_delete_product = $con->query($query_delete_product)))
                    echo "Error01 <br>".mysqli_error($con)."<br>";
                $query_delete_product = "DELETE FROM links_products_categories WHERE links_products_categories.product_id = $product_id";
                if (!($result_delete_product = $con->query($query_delete_product)))
                    echo "Error02 <br>".mysqli_error($con)."<br>";
            }
            if ($_POST['action'] == 'delete_category' && isset($_POST['cat_id']))
            {
                $cat_id = $_POST['cat_id'];
                $query_delete_category = "DELETE FROM categories WHERE id = $cat_id";
                if (!($result_delete_category = $con->query($query_delete_category)))
                    echo "Error01qw <br>".mysqli_error($con)."<br>";
                $query_delete_category = "DELETE FROM links_products_categories WHERE cat_id = $cat_id";
                if (!($result_delete_category = $con->query($query_delete_category)))
                    echo "Error02qwe <br>".mysqli_error($con)."<br>";
            }
            if ($_POST['action'] == 'delete_user' && isset($_POST['user_id']))
            {
                $user_id = $_POST['user_id'];
                $query_delete_category = "DELETE FROM users WHERE id = $user_id";
                if (!($result_delete_category = $con->query($query_delete_category)))
                    echo "Error01qudw <br>".mysqli_error($con)."<br>";
            }
            if ($_POST['action'] == 'update_category' && isset($_POST['update_value']) && isset($_POST['cat_id']) && isset($_POST['update_field']))
            {
                $cat_id = $_POST['cat_id'];
                if ($_POST['update_field'] == 'cat_name')
                {
                    $category_update_value = $_POST['update_value'];
                    $query_update_category = "UPDATE categories SET name='$category_update_value' WHERE id = '$cat_id'";
                    if (!($result_update_category = $con->query($query_update_category)))
                        echo "Error03aqa <br>".mysqli_error($con)."<br>";
                    $_POST['update_value'] = "";
                }
            }
            if ($_POST['action'] == 'update_login' && isset($_POST['update_value']) && isset($_POST['user_id']) && isset($_POST['update_field']))
            {
                $user_id = $_POST['user_id'];
                if ($_POST['update_field'] == 'user_login')
                {
                    $category_update_value = $_POST['update_value'];
                    $query_update_category = "UPDATE users SET login='$category_update_value' WHERE id='$user_id'";
                    if (!($result_update_category = $con->query($query_update_category)))
                        echo "Error03aqayui <br>".mysqli_error($con)."<br>";
                    $_POST['update_value'] = "";
                }
            }
            if ($_POST['action'] == 'update_pw' && isset($_POST['update_value']) && isset($_POST['user_id']) && isset($_POST['update_field']))
            {
                $user_id = $_POST['user_id'];
                if ($_POST['update_field'] == 'user_pw')
                {
                    $category_update_value = $_POST['update_value'];
                    $query_update_category = "UPDATE users SET password='$category_update_value' WHERE id='$user_id'";
                    if (!($result_update_category = $con->query($query_update_category)))
                        echo "Error03aqapui <br>".mysqli_error($con)."<br>";
                    $_POST['update_value'] = "";
                }
            }
            if ($_POST['action'] == 'update_admin' && isset($_POST['user_id']))
            {
                $user_id = $_POST['user_id'];
                if ($_POST['admin'] == "on")
                    $category_update_value = 1;
                else
                    $category_update_value = 0;
                $query_update_category = "UPDATE users SET is_admin=$category_update_value WHERE id='$user_id'";
                if (!($result_update_category = $con->query($query_update_category)))
                    echo "Error03aqawqui <br>".mysqli_error($con)."<br>";
                $_POST['update_value'] = "";
            }
            if ($_POST['action'] == 'update_product' && isset($_POST['update_field']) && isset($_POST['product_id']) && isset($_POST['update_value']))
            {
                $product_id = $_POST['product_id'];
                $product_update_value = $_POST['update_value'];
                if ($_POST['update_field'] == 'product_name')
                    $query_update_product = "UPDATE products SET name='$product_update_value' WHERE products.id='$product_id'";
                if ($_POST['update_field'] == 'product_price')
                    $query_update_product = "UPDATE products SET price='$product_update_value' WHERE products.id='$product_id'";
                if ($_POST['update_field'] == 'product_stock')
                    $query_update_product = "UPDATE products SET stock='$product_update_value' WHERE products.id='$product_id'";
                if ($_POST['update_field'] == 'product_img')
                    $query_update_product = "UPDATE products SET img='$product_update_value' WHERE products.id='$product_id'";
                if (!($result_update_product = $con->query($query_update_product)))
                    echo "Error03a <br>".mysqli_error($con)."<br>";
                $_POST['update_value'] = "";
            }
        }

        // View, add, update and delete products
        $query_view_products = "SELECT products.id, products.name, products.price, products.stock FROM products";
        if (!($result_view_products = $con->query($query_view_products)))
            echo "Error0 <br>";
        else
        {
            echo "<b>Select product to manage</b>: 
                    <form action='admin.php' method='post'>
                        <select id='product_id' name='product_id'>
                            <optgroup label='Products'>
                                <option value='All'>All</option>";
            while ($row_view_products = mysqli_fetch_array($result_view_products)) 
            {
                $product_id = $row_view_products['id'];
                $product_name = $row_view_products['name'];
                $option = $product_name." (id_".$product_id.")";
                echo "<option value='$product_id'>$option</option>";
            }
            echo "          <input onclick='search' type='submit' value='Search' />
                            </optgroup>
                        </select>
                    </form>";
            if (isset($_POST['product_id']) && $_POST['product_id'] != "All")
            {
                $query_view_products = "SELECT products.id, products.name, products.price, products.stock, products.img FROM products";
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
                            echo "Product_id: ".$_POST['product_id']."<br>";
                            echo "Product_name:     ";
                            echo "<input type='text' name='update_value' style='width: 200px' value='$product_name'/>";
                            echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                            echo "<input type='hidden' name='update_field' style='width: 24px' value='product_name'/>";
                            echo "<input type='submit' name='action' value='update_product'/>"."<br>";
                            echo "</form>";

                            echo "<form action='admin.php' method='post'>";
                            echo "Product_price (€):     ";
                            echo "<input type='text' name='update_value' style='width: 50px' value='$product_price'/>";
                            echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                            echo "<input type='hidden' name='update_field' style='width: 24px' value='product_price'/>";
                            echo "<input type='submit' name='action' value='update_product'/>"."<br>";
                            echo "</form>";

                            echo "<form action='admin.php' method='post'>";
                            echo "Product_stock:     ";
                            echo "<input type='text' name='update_value' style='width: 100px' value='$product_stock'/>";
                            echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                            echo "<input type='hidden' name='update_field' style='width: 24px' value='product_stock'/>";
                            echo "<input type='submit' name='action' value='update_product'/>"."<br>";
                            echo "</form>";

                            echo "<form action='admin.php' method='post'>";
                            echo "Product_img_link (facultative):     <br>";
                            echo "<input type='text' name='update_value' style='width: 400px' value='$product_img'/>";
                            echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                            echo "<input type='hidden' name='update_field' style='width: 24px' value='product_img'/>";
                            echo "<input type='submit' name='action' value='update_product'/>"."<br>";
                            echo "</form>";

                            //WORK HERE before push
                            echo "<form action='admin.php' method='post'>";
                            $query_view_categories = "SELECT id, name FROM categories";
                            if (!($result_view_categories = $con->query($query_view_categories)))
                                echo "Error0q1qq <br>";
                            else
                            {
                                echo "Categories (facultative - cannot be updated): <br />";
                                //echo "<input type='submit' name='action' value='update_categories'/>"."<br>";
                                while ($row_view_categories = mysqli_fetch_array($result_view_categories)) 
                                {
                                    $cat_id = $row_view_categories['id'];
                                    $cat_name = $row_view_categories['name'];

                                    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
                                    $query_insert_link = "SELECT cat_id FROM `links_products_categories` WHERE `product_id` = $product_id AND `cat_id` = $cat_id ";
                                    if (!($result_insert_link = $con->query($query_insert_link)))
                                        echo "Error0q3 <br>";
                                    else
                                    {
                                        while ($row_insert_link = mysqli_fetch_array($result_insert_link))
                                        {
                                            if ($row_insert_link['cat_id'] = $cat_id)
                                                echo "<input type='checkbox' name='$cat_id' checked><label for='$cat_id'>$cat_name</label>";
                                            //else
                                            //   echo "<input type='checkbox' name='$cat_id'><label for='$cat_id'>$cat_name</label>";
                                            echo "<br>";
                                        }
                                    }
                                }
                            }
                            echo "<input type='hidden' name='product_id' style='width: 24px' value='$product_id'/>";
                            echo "</form>";

                            //WORK HERE before push

                            echo "<form action='admin.php' method='post'>";
                            echo "<input type='hidden' name='product_id' value='$product_id'/>";
                            echo "<input type='submit' name='action' value='delete_product'/>"."<br>";
                            echo "</form>";
                        }
                    }
                }
            }
            else
                echo "  ";
        }
        echo "<br><b>Fill in the product to create</b>:<br>";
        echo "<form action='admin.php' method='post'>";
        echo "Product_name:     ";
        echo "<input type='text' name='product_name' style='width: 200px' value=''/><br>";
        echo "Product_price (€):     ";
        echo "<input type='text' name='product_price' style='width: 50px' value=''/><br>";
        echo "Product_stock:     ";
        echo "<input type='text' name='product_stock' style='width: 100px' value=''/><br>";
        echo "Product_img_link (facultative):     <br>";
        echo "<input type='text' name='product_img' style='width: 400px' value=''/><br>";

        $query_view_categories = "SELECT id, name FROM categories";
        if (!($result_view_categories = $con->query($query_view_categories)))
            echo "Error0q1 <br>";
        else
        {
            echo "Categories (facultative):<br>";
            while ($row_view_categories = mysqli_fetch_array($result_view_categories)) 
            {
                $cat_id = $row_view_categories['id'];
                $cat_name = $row_view_categories['name'];
                echo "<input type='checkbox' name='$cat_id'><label for='$cat_id'>$cat_name</label>";
                echo "<br>";
            }
        }
        echo "<input type='submit' name='action' value='add_product'/>"."<br>";
        echo "</form>";

        // Category management
        $query_view_categories = "SELECT id, name FROM categories";
        if (!($result_view_categories = $con->query($query_view_categories)))
            echo "Error0q2 <br>";
        else
        {
            echo "<br><b>Select a category to manage</b>: 
            <form action='admin.php' method='post'>
                <select id='cat_id' name='cat_id'>
                    <optgroup label='Categories'>
                        <option value='All'>All</option>";
            while ($row_view_categories = mysqli_fetch_array($result_view_categories)) 
            {
                $cat_id = $row_view_categories ['id'];
                $cat_name = $row_view_categories ['name'];
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
            $query_view_categories = "SELECT id, name FROM categories";
            if (!($result_view_categories = $con->query($query_view_categories)))
                echo "Error0q3 <br>";
            else
            {
                while ($row_view_categories = mysqli_fetch_array($result_view_categories))
                {
                    if($row_view_categories['id'] == $_POST['cat_id'])
                    {
                        $cat_id = $row_view_categories['id'];
                        $cat_name = $row_view_categories['name'];
                        echo "<form action='admin.php' method='post'>";
                        echo "Category_id: ".$_POST['cat_id']."<br>";
                        echo "Category_name: "."    ";
                        echo "<input type='text' name='update_value' style='width: 200px' value='$cat_name'/>";
                        echo "<input type='hidden' name='cat_id' style='width: 24px' value='$cat_id'/>";
                        echo "<input type='hidden' name='update_field' style='width: 24px' value='cat_name'/>";
                        echo "<input type='submit' name='action' value='update_category'/>"."<br>";
                        echo "</form>";

                        echo "<form action='admin.php' method='post'>";
                        echo "<input type='hidden' name='cat_id' value='$cat_id'/>";
                        echo "<input type='submit' name='action' value='delete_category'/>"."<br>";
                        echo "</form>";
                    }
                }
            }
        }

        // Create new category
        echo "<br><b>Enter the category to create</b>:<br>";
        echo "<form action='admin.php' method='post'>";
        echo "Category_name: "."    ";
        echo "<input type='text' name='category_name' style='width: 200px' value=''/><br>";
        echo "<input type='submit' name='action' value='add_category'/>"."<br>";
        echo "</form>";

        // Users management
        $sql = "SELECT * FROM users WHERE login!='" . $_SESSION["loggued_on_user"] . "'";
        if (!($res = $con->query($sql)))
            echo "Error0qxx <br>";
        else
        {
            echo "<br><b>Select a user to manage</b>: 
            <form action='admin.php' method='post'>
                <select id='user_id' name='user_id'>
                    <optgroup label='Users'>
                    <option value='All'>All</option>";
            while ($row_res = mysqli_fetch_array($res)) 
            {
                $user_id = $row_res['id'];
                $user_login = $row_res['login'];
                $option = $user_login." (id_".$user_id.")";
                echo "<option value='$user_id'>$option</option>";
            }
            echo "          <input onclick='search' type='submit' value='Search'/>
                            </optgroup>
                        </select>
                    </form>";
        }
        if (isset($_POST['user_id']) && $_POST['user_id'] != "All")
        {
            $sql = "SELECT * FROM users";
            if (!($res = $con->query($sql)))
                echo "Error0q3x <br>";
            else
            {
                while ($row_res = mysqli_fetch_array($res))
                {
                    if($row_res['id'] == $_POST['user_id'])
                    {
                        $user_id = $row_res['id'];
                        $user_login = $row_res['login'];
                        $user_pw = $row_res['password'];
                        $user_admin = $row_res['is_admin'];

                        echo "<form action='admin.php' method='post'>";
                        echo "User_id: " . $_POST['user_id'] . "<br>";
                        echo "User_login:     ";
                        echo "<input type='text' name='update_value' style='width: 200px' value='$user_login'/>";
                        echo "<input type='hidden' name='user_id' style='width: 24px' value='$user_id'/>";
                        echo "<input type='hidden' name='update_field' style='width: 24px' value='user_login'/>";
                        echo "<input type='submit' name='action' value='update_login'/>"."<br>";
                        echo "</form>";

                        echo "<form action='admin.php' method='post'>";
                        echo "User_password: ";
                        echo "<input type='text' name='update_value' style='width: 200px' value='$user_pw'/>";
                        echo "<input type='hidden' name='user_id' style='width: 24px' value='$user_id'/>";
                        echo "<input type='hidden' name='update_field' style='width: 24px' value='user_pw'/>";
                        echo "<input type='submit' name='action' value='update_pw'/>"."<br>";
                        echo "</form>";

                        echo "Admin_rights:     ";
                        echo "<form action='admin.php' method='post'>";
                        echo "<input type='checkbox' name='admin' ";
                        if ($user_admin == TRUE)
                            echo "checked";
                        echo "><label for='admin'>is_admin  </label>";
                        echo "<input type='hidden' name='user_id' style='width: 24px' value='$user_id'/>";
                        echo "<input type='hidden' name='update_field' style='width: 24px' value='user_admin'/>";
                        echo "<input type='submit' name='action' value='update_admin'/>"."<br>";
                        echo "</form>";

                        echo "<form action='admin.php' method='post'>";
                        echo "<input type='hidden' name='user_id' value='$user_id'/>";
                        echo "<input type='submit' name='action' value='delete_user'/>"."<br>";
                        echo "</form>";
                    }
                }
            }
        }

        // Afficher les commandes passees
        echo "<br><b>Validated orders to send out </b>:<br>";
        $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
        $query_display_cart = "SELECT user_id, product_id, quantity FROM `orders` GROUP BY `user_id`, `product_id`, `quantity`";
        if (!($result = $con->query($query_display_cart)))
            echo "Error 78 <br>";
        else
        {
            while ($row_cart = mysqli_fetch_array($result))
            {
                $cart_product_quantity = $row_cart['quantity'];
                $product_id = $row_cart['product_id'];
                $user_id = $row_cart['user_id'];
                echo $cart_product_quantity." product id <b>".$product_id."</b> to user ".$user_id."<br />";
            }
        }
        ?>
    </body>
</html>