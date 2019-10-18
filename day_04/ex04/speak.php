<?php
if ($_SESSION("loggued_on_user") != "")
{
    if (file_exists("../private") == FALSE)
        mkdir($pwd_dir, 0777);
    if (file_exists("../private/chat") == TRUE)
        $unser_chat = unserialize(file_get_contents("../private/chat"));
    $unser_chat[] = array('login' => $_SESSION["login"], 'time' => mktime(), 'msg' => $_POST["msg"]);
    $accounts[] = serialize($unser_accounts);
    file_put_contents($pwd_file, $accounts);
}
?>
<html>
    <head>
        <script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
    </head>
    <body>
        <form action="speak.php" method="post">
            Message: <input type="text" name="msg" value=""/>
            <input type = "submit" name="submit" value="Envoyer"/>
        </form>
    </body>
</html>