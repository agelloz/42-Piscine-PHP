<?php
function    view_users()
{
    $get_users = "SELECT * FROM users";
    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
    $run = mysqli_query($con, $get_users);

    while ($row_users = mysqli_fetch_array($run)) 
    {
        $user_login = $row_users['login'];
        if ($user_status = $row_users['is_admin'])
            $status = "admin";
        else
            $status = "regular";
        if ($user_login)
            echo "<li>$user_login - $status</li>";
    }
}
?>