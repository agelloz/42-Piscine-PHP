<?php

function auth($login, $passwd)
{
    $con = mysqli_connect("127.0.0.1", "root", "root", "shop");
    $hashed_pwd = hash('whirlpool', $_POST["passwd"]);
    $query_check = "SELECT * FROM users WHERE login='" . $_POST["login"] . "' AND password='" . $hashed_pwd . "'";
    $result = mysqli_query($con, $query_check);
    if ($result && mysqli_num_rows($result))
    {
        $row_user = mysqli_fetch_array($result);
        $_SESSION["user_id"] = $row_user['id'];
        $_SESSION["admin"] = $row_user['is_admin'];
        return (TRUE);
    }
    else
        return (FALSE);
}

session_start();
if (!isset($_POST["login"]) && !isset($_POST["passwd"]))
{
    $_SESSION["loggued_on_user"] = "";
    echo "Wrong credentials, please try again.\n";
    header("Refresh: 2;url=login.html");
}
elseif ($_POST["login"] != NULL && $_POST["passwd"] != NULL && auth($_POST["login"], $_POST["passwd"]) == TRUE)
{
    $_SESSION["loggued_on_user"] = $_POST["login"];
    echo "<head><link rel='stylesheet' type='text/css' href='style.css'>
    </head><html><body><h2>
        Hello " . $_SESSION["loggued_on_user"] . "!
    </h2></body></html>";
    header("Refresh: 1;url=index.php");
}
else
{
    $_SESSION["loggued_on_user"] = "";
    echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head><html><body><h2>Wrong credentials, please try again :(</h2></body></html>";
    header("Refresh: 2;url=login.html");
}
?>