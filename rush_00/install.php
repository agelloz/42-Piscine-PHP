<?php
    $connection = mysqli_connect("localhost:8000", "admin", "admin");
    $sql = file_get_contents("database.sql");
    $sql_array = explode(";", $sql);
    foreach ($sql_array as $elem) 
      mysqli_query($connection, $elem);
?>