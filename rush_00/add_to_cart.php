<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
$sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('" . $_SESSION['user_id'] . "', " . $_POST['id'] . ", " . $_POST['qty'] . ")";
if (($result = $con->query($sql)) == FALSE)
    echo "Error".mysqli_error($con)."<br>";
echo "Product added to cart<br>";
header("Refresh: 2;url=products.php");
echo "<script>parent.location.reload()</script>";
?>