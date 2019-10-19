<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
if (!isset($_POST["submit"]) || !isset($_POST["login"]) || !isset($_POST["oldpw"])
 || !isset($_POST["newpw"]) || $_POST["submit"] != "OK")
    return NULL;
if ($_POST["login"] != NULL && $_POST["oldpw"] != NULL && $_POST["newpw"])
{
    $old_hashed_pwd = hash('whirlpool', $_POST["oldpw"]);
    $query_check = "SELECT * FROM users WHERE login='".$_POST["login"]."' AND password='".$old_hashed_pwd."'";
    $run = mysqli_query($con, $query_check);
    if ($run && mysqli_num_rows($run))
    {
        $query = "UPDATE users SET password='".$old_hashed_pwd."' WHERE login='".$_POST["login"]."'";
        $run_pro = mysqli_query($con, $query);
        if (!$run_pro)
            die("ERROR: ".mysqli_error($con));
        echo "Password successfully changed\n";
        header("Refresh: 2;url=index.php");
    }
    else
    {
        header("Refresh: 2;url=modif.html");
        echo "Wrong credentials.\n";
    }
}
else
{
    header("Refresh: 2;url=modif.html");
    echo "Wrong credentials.\n";
}
?>