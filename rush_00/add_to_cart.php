<?php
session_start();
$con = mysqli_connect('', 'root', 'root', 'shop');
if ($_POST['qty'] > 0 && $_POST['qty'] < 10000)
{
    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('" . $_SESSION['user_id'] . "', " . $_POST['id'] . ", " . $_POST['qty'] . ")";
    if (($result = $con->query($sql)) == FALSE)
        echo "Error".mysqli_error($con)."<br>";
    header("Refresh: 2;url=products.php");
    echo "<script>parent.location.reload()</script>";
}
else
{
    echo "
    <head><link rel='stylesheet' type='text/css' href='style.css'>
    </head><html><body><h2>
    Incorrect product quantity, please try again with a positive and realistic value :(
    </h2></body></html>";
    header("Refresh: 2;url=products.php");
}
?>