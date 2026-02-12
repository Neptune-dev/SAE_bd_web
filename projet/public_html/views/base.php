<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style/base.css">
</head>
<body>
    <header>
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

    <?= $content ?>
    
    <footer>
        <a href="phpinfo.php">php Info</a>
    </footer>
</body>
</html>