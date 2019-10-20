<?php
function    debug_view()
{
    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
    $sql = "SELECT * FROM users";
    $run = mysqli_query($con, $sql);
    if (isset($_SESSION["loggued_on_user"]) != NULL)
        echo "<br>Users: (session id:" . substr($_SESSION["user_id"], 0, 10) . " user:" . $_SESSION["loggued_on_user"] . ")<br><br>";
    else
        echo "<br>Users: (session id:" . substr($_SESSION["user_id"], 0, 10) . ")<br><br>";
    while ($res = mysqli_fetch_array($run)) 
    {
        if ($user_status = $res['is_admin'])
            $status = "admin";
        else
            $status = "regular";
        echo $res['login'] . " - $status - id:" . $res['id'];
        if ($_SESSION["user_id"] == $res['id'])
            echo " - loggued in";
        echo "<br>";
    }
    $sql = "SELECT cart.product_id, products.name, SUM(cart.quantity) FROM cart, products WHERE products.id = cart.product_id AND cart.user_id='". $_SESSION["user_id"] . "' GROUP BY cart.product_id";
    $run = mysqli_query($con, $sql);
    echo "<br>Cart:<br><br>";
    while ($res = mysqli_fetch_array($run)) 
        echo $res['name'] . " - " . $res['SUM(cart.quantity)'] . "<br>";
}
?>