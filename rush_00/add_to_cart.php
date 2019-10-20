<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
$query_add_to_cart = "INSERT INTO cart (user_id, product_id, quantity) VALUES (" . $_SESSION['user_id'] . ", " . $_GET['id'] . ", " . $_GET['qty'] . ")";
if (($result = $con->query($query_add_to_cart)) == FALSE)
    echo "Error".mysqli_error($con)."<br>";
echo "Product added to cart<br>";
header("Refresh: 1;url=products.php");
?>