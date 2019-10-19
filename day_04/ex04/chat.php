<?php
session_start();
date_default_timezone_set("Europe/Paris");
if ($_SESSION["loggued_on_user"] != "")
{
    if (file_exists("../private/chat"))
    {
        $messages = unserialize(file_get_contents("../private/chat"));
        if (!empty($messages))
            foreach ($messages as $mess)
                echo "[" . date("H:i", $mess["time"]) . "] " . "<b>" . $mess["login"] . "</b>: " . $mess["msg"] . "<br />";
    }
}
?>