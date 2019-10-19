<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
if (!isset($_POST["submit"]) || !isset($_POST["login"]) || !isset($_POST["passwd"]) || $_POST["submit"] != "OK")
    return NULL;
if ($_POST["login"] != NULL && $_POST["passwd"] != NULL)
{
    $hashed_pwd = hash('whirlpool', $_POST["passwd"]);
    $query_check = "SELECT login FROM users WHERE login='" . $_POST["login"] . "'";
    $run = mysqli_query($con, $query_check);
    if ($run && mysqli_num_rows($run))
    {
        $_SESSION["user"] = $_POST["login"];
        echo "Account exists already. You have been signed in.\n";
        header("Refresh: 2;url=index.php");
    }
    else
    {
        $query = "INSERT INTO users SET login = '" . $_POST["login"] . "', password ='" . $hashed_pwd . "'";
        $run_pro = mysqli_query($con, $query);
        if (!$run_pro)
            die("ERROR: " . mysqli_error($con));
        header("Refresh: 2;url=login.html");
        echo "Account created\n";
    }
}
else
{
    header("Refresh: 2;url=signup.html");
    echo "Error creating account\n";
}
?>