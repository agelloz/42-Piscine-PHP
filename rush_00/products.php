<!DOCTYPE html>
<?php
    session_start();
    include('get_products_by_cat.php');
    include('retrieve_cats.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="main-nav">
            <?php retrieve_cats(); ?>
        </div>
        <br>
        <ul class="main-nav">
            <?php get_products_by_cat(); ?>
        </ul>
    </body>
</html>