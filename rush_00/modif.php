<?php
session_start();
$con = mysqli_connect("127.0.0.1", "root", "root", "shop");
if (!isset($_POST["submit"]) || !isset($_POST["oldpw"])
 || !isset($_POST["newpw"]) || $_POST["submit"] != "OK")
    return NULL;
if ($_POST["oldpw"] != NULL && $_POST["newpw"]
&& strlen($_POST["newpw"]) > 4 && ctype_alnum($_POST["newpw"]))
{
    $old_hashed_pwd = hash('whirlpool', $_POST["oldpw"]);
    $query_check = "SELECT * FROM users WHERE login='".$_SESSION['loggued_on_user']."' AND password='".$old_hashed_pwd."'";
    $run = mysqli_query($con, $query_check);
    if ($run && mysqli_num_rows($run))
    {
        $new_hashed_pwd = hash('whirlpool', $_POST["newpw"]);
        $query = "UPDATE users SET password='".$new_hashed_pwd."' WHERE login='".$_SESSION["loggued_on_user"]."'";
        $run_pro = mysqli_query($con, $query);
        if (!$run_pro)
            die("ERROR: ".mysqli_error($con));
            echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head><html><body><h2>" . $_SESSION["loggued_on_user"] . ", your password has been successfully changed.</h2></body></html>";
        header("Refresh: 2;url=index.php");
    }
    else
    {
        echo "<head><link rel='stylesheet' type='text/css' href='style.css'>
        </head><html><body><h2>
            Wrong old password, please try again.
        </h2></body></html>";
        header("Refresh: 2;url=modif.html");
    }
}
else
{
    echo "<head><link rel='stylesheet' type='text/css' href='style.css'></head>
    <html><body><h2>
        Incorrect credentials, please try again.<br>
        Your new password must contain between 5 and 30 letters or digits.
    </h2></body></html>";
    header("Refresh: 4;url=modif.html");
}
?>