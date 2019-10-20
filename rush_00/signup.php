<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
if (!isset($_POST["submit"]) || !isset($_POST["login"]) || !isset($_POST["passwd"]) || $_POST["submit"] != "OK")
    return NULL;
if ($_POST["login"] != NULL && $_POST["passwd"] != NULL
&& strlen($_POST["login"]) > 4 && strlen($_POST["passwd"]) > 4
&& ctype_alnum($_POST["login"]) && ctype_alnum($_POST["passwd"]))
{
    $hashed_pwd = hash('whirlpool', $_POST["passwd"]);
    $query_check = "SELECT login FROM users WHERE login='" . $_POST["login"] . "'";
    $run = mysqli_query($con, $query_check);
    if ($run && mysqli_num_rows($run))
    {
        $_SESSION["user"] = $_POST["login"];
        echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head><html><body><h2>Account exists already. You have been signed in :)</h2></body></html>";
        header("Refresh: 2;url=index.php");
    }
    else
    {
        $query = "INSERT INTO users SET login = '" . $_POST["login"] . "', password ='" . $hashed_pwd . "'";
        $run_pro = mysqli_query($con, $query);
        if (!$run_pro)
            die("ERROR: " . mysqli_error($con));
        header("Refresh: 2;url=login.html");
        echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head><html><body><h2>Welcome ". $_SESSION["user"] . "! Happy shopping :)</h2></body></html>";
    }
}
else
{
    header("Refresh: 4;url=signup.html");
    echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head>
    <html><body><h2>
        Incorrect credentials, please try again.<br>
        Your username and password must contain between 5 and 30 letters or digits.
    </h2></body></html>";
}
?>