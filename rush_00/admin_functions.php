<?php
function    view_users()
{
    $get_users = "SELECT * FROM users";
    $con = mysqli_connect('127.0.0.1', 'root', 'root', 'shop');
    $run = mysqli_query($con, $get_users);

    echo "<br /><b><u>List of users</u>: </b><br /><br />";
    while ($row_users = mysqli_fetch_array($run)) 
    {
        $user_login = $row_users['login'];
        if ($user_status = $row_users['is_admin'])
            $status = "<u>(ADMIN rights)</u>";
        else
            $status = "(regular rights)";
        if ($user_login)
            echo "<b>$user_login</b> - $status"."<br />";
    }
}
?>