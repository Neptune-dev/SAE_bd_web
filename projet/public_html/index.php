<?php
    session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <header>

        <h1>Coucou test 2</h1>

        <?php
            if (isset($_SESSION["user"]))
            {
                echo ('<a href="mypage.php">Ma page</a><a href="logout.php">Se déconnecter</a>');
            } else
            {
                echo ('<a href="login.php">Se connecter</a>');
            }
        ?>
    </header>
    <footer>
        <a href="phpinfo.php">php Info</a>
    </footer>
</body>
</html>