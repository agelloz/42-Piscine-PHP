<?php
    $hostname = "127.0.0.1";
    $username = "raphael";
    $password = "raphael";
    if ($con = mysqli_connect($hostname, $username, $password, "rush00_test"))
      echo "Connection initiated successfully <br /><br />";
    else
      echo "Connection failed: ".mysqli_connect_error()."<br /><br />";
    //$db = "users";
    //mysqli_select_db($con,$db);
    $field = "id";
    $db = "rush00_test_10";
    $query = "DROP DATABASE $db";
    if ($con->query($query) === TRUE) 
    {
      printf("Database $db droppe avec succès.<br /><br />");
    }
    else 
      echo("Error description: " . mysqli_error($con))."<br /><br />";
    $query2 = "USE $db";
    //$con->select_db("rush00_test_5");
    if (($con->query($query2)) === TRUE) 
    {
      printf("Use database successfully performed <br /><br />");
      //while ($row = mysqli_fetch_row($res))
      //  echo $row[0], '<br/>';
    }
    else 
      echo("Error description: <br /> " . mysqli_error($con). "<br /><br />");
    $table = "prout";
    $query3 = "CREATE TABLE `categories` (
      `cat_id` int(11) NOT NULL,
      `cat_name` text NOT NULL,
      `parent_id` int(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    //$con->select_db("rush00_test_5");
    if ($res = ($con->query($query3)) === TRUE) 
    {
      printf("Table successfully created <br /><br />");
      //while ($row = mysqli_fetch_row($res))
      //  echo $row[0], '<br/>';
    }
    else 
      echo("Error description:" . mysqli_error($con))."<br /><br />";

    $query4 = "INSERT INTO `categories` (`cat_id`, `cat_name`, `parent_id`) VALUES
    (1, 'Beauty', 0),
    (2, 'Hair', 0),
    (3, 'Scent', 0),
    (4, 'Gifts', 0)";
    
    /*CINSERT INTO `categories` (`cat_id`, `cat_name`, `parent_id`) VALUES
    (1, 'Beauty', 0),
    (2, 'Hair', 0),
    (3, 'Scent', 0),
    (4, 'Gifts', 0);*/
    //$con->select_db("rush00_test_5");
    if ($res = ($con->query($query4)) === TRUE) 
    {
      printf("Data succesfully inserted<br /><br />");
      //while ($row = mysqli_fetch_row($res))
      //  echo $row[0], '<br/>';
    }
    else 
      echo("Error description: <br /> " . mysqli_error($con)."<br /><br />");

      $query2 = "USE $db";
      //$con->select_db("rush00_test_5");
      if (($con->query($query2)) === TRUE) 
      {
        printf("Use database successfully performed <br /><br />");
        //while ($row = mysqli_fetch_row($res))
        //  echo $row[0], '<br/>';
      }
      else 
        echo("Error description: <br /> " . mysqli_error($con). "<br /><br />");


      $table = "prout";
      $query3 = "CREATE TABLE `jouets` (
        `cat_id` int(11) NOT NULL,
        `cat_name` text NOT NULL,
        `parent_id` int(100) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      //$con->select_db("rush00_test_5");
      if ($res = ($con->query($query3)) === TRUE) 
      {
        printf("Table successfully created <br /><br />");
        //while ($row = mysqli_fetch_row($res))
        //  echo $row[0], '<br/>';
      }
      else 
        echo("Error description:" . mysqli_error($con))."<br /><br />";
  
      $query4 = "INSERT INTO `jouets` (`cat_id`, `cat_name`, `parent_id`) VALUES
      (1, 'Beauty', 0),
      (2, 'Hair', 0),
      (3, 'Scent', 0),
      (4, 'Gifts', 0)";
      
      /*CINSERT INTO `categories` (`cat_id`, `cat_name`, `parent_id`) VALUES
      (1, 'Beauty', 0),
      (2, 'Hair', 0),
      (3, 'Scent', 0),
      (4, 'Gifts', 0);*/
      //$con->select_db("rush00_test_5");
      if ($res = ($con->query($query4)) === TRUE) 
      {
        printf("Data succesfully inserted<br /><br />");
        //while ($row = mysqli_fetch_row($res))
        //  echo $row[0], '<br/>';
      }
      else 
        echo("Error description: <br /> " . mysqli_error($con)."<br /><br />");


    /*if ($result = mysqli_query($con, "SELECT Name FROM City LIMIT 10")) 
    {
      printf("Select a retourné %d lignes.\n", $result->num_rows);
      $result->close();
    }*/

    /*if ($result = $mysqli->query("SELECT $field FROM $database LIMIT 10"))
    {
      printf("Select a retourné %d lignes.\n", $result->num_rows);
    }
    else 
      echo "-- RATE\n";*/

    /*if ($sql = file_get_contents("database.sql"))
      echo "CCOOL\n";
    else
    {
      echo "PROUT\n";
      $sql_array = explode(";", $sql);
      foreach ($sql_array as $elem) 
        mysqli_query($connection, $elem);
    }*/
?>