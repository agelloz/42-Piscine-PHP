<!DOCTYPE html>
<?php
    session_start();
    include('ft_get_products_by_cat.php');
    include('ft_retrieve_cats.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="main-nav">
            <?php ft_retrieve_cats(); ?>
        </div>
        <ul class="main-nav">
            <?php ft_get_products_by_cat(); ?>
            <li>
                <form action="add_to_cart.php"></form>
            </li>
        </ul>
    </body>
</html>