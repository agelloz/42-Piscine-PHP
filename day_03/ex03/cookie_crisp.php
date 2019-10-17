<?php
if (isset($_GET["action"]) || isset($_GET["name"]))
	return null;
if ($_GET["action"] == "set")
	setcookie($_GET["name"], $_GET["value"], time() + 3600);
elseif ($_GET["action"] == "get" && isset($_COOKIE[$_GET["name"]]))
	echo $_COOKIE[$_GET["name"]] . "\n";
elseif (($_GET["action"] == "del") && isset($_COOKIE[$_GET["name"]]))
	setcookie($_GET["name"], "", time() - 3600);
?>
