<html>
    <body>
        <form action="login.php" method="post">
            Identifiant: <input type="text" name="login" value=""/>
            <br />
            Mot de passe: <input type="password" name="passwd" value=""/>
            <input type = "submit" name="submit" value="OK"/>
        </form>
        <a href="create.html">Créer un compte</a>
        <br />
        <a href="modif.html">Changer son mot de passe</a>
        <?php print("<pre>" . print_r(unserialize(file_get_contents("../private/passwd")), true) . "</pre>"); ?>
    </body>
</html>