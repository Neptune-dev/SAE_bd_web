<?php
    session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>

        <h1>Zoo</h1>
        <h2>ENT</h2>

        <?php
            if (isset($_SESSION["user"]))
            {
                echo ('<a href="dashboard.php"><button>Ma page</button></a><a href="logout.php"><button>Se déconnecter</button></a>');
            } else
            {
                echo ('<a href="login.php"><button>Se connecter</button></a>');
            }
        ?>
    </header>
</body>
</html>