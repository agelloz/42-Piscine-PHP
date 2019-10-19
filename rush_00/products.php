#!/usr/bin/php
<?php
    session_start();
    $_SESSION["user_id"] = 42;
?>
<!DOCTYPE html>
<?php
    include('ft_get_products_by_cat.php');
    include('ft_retrieve_cats.php');
?>
<html>
    <head>
        <style>
        .main-nav {
        font-size: 16px;
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 1px 1px 5px #D3D3D3;
        }
        .periodic {
            position: relative;
            height: 20vw;
            margin-right: -1px;
            text-shadow: none;
        }
        .periodic-row {
            clear: both;
            height: 30%;
        }
        .tags {
            float: left;
            position: relative;
            width: 5.55%;
            height: 10%; 
        }
        .cell {
            float: left;
            position: relative;
            width: 15.55%;
            height: 100%;
        }
        h1 {
            color: black;
            font-size: 5vw;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
        }
        h3 {
            color: black;
            font-size: 1vw;
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
        }
        img {
            margin: 0.875% 0;
            display:block;
            border: 1px solid;
        }
        </style>
    </head>
    <body>
        <div class="main-nav">
            <?php ft_retrieve_cats(); ?>
        </ul>
        </div>
        <ul class="main-nav">
            <?php ft_get_products_by_cat(); ?>
            <li>
                <form action="add_to_cart.php">
                    <?PHP
                        /*foreach ($_GET as $key => $param)
                        {
                            if ($param !== NULL)
                                $param = $param;
                        }
                        echo '<input type="hidden" name="pro_id" value="'.$param.'"/>';
                        echo '<input type="submit" name="submit" value="Add to cart"/>';*/
                    ?>
                </form>
            </li>
        </ul>

        <div class="footer">
        <h2>© agelloz / rbeaufre 2019</h2>
        </div>

    </body>
</html>