<?php
session_start();
date_default_timezone_set("Europe/Paris");
if ($_SESSION["loggued_on_user"] != NULL && $_POST["msg"] != NULL)
{
    if (file_exists("../private") == FALSE)
        mkdir("../private", 0777);
    if (file_exists("../private/chat") == TRUE)
        $unser_chat = unserialize(file_get_contents("../private/chat"));
    $unser_chat[] = array('login' => $_SESSION["loggued_on_user"], 'time' => mktime(), 'msg' => $_POST["msg"]);
    $chat[] = serialize($unser_chat);
    file_put_contents("../private/chat", $chat);
}
?>
<html>
    <head>
        <script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
    </head>
    <body>
        <form action="speak.php" method="post">
            <input type="text" name="msg" value=""/>
            <input type = "submit" name="submit" value="Envoyer"/>
        </form>
    </body>
</html>