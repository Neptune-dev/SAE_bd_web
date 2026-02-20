<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    </header>

    <?php
        //si l'utilisateur est déjà connecté, on peut rediriger directement
        /*if (isset($_SESSION["user"]))
        {
            header("Location: dashboard.php");
            exit();
        }*/
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $userID = $_POST["userID"];
            $pwd = $_POST["pwd"];

            require_once('db.php');

            $sql = "SELECT * FROM personnel WHERE id_personnel=:id";
            $user = db_one($sql, [":id" => $userID]);
            if (!$user) {
                $error = "Utilisateur introuvable.";
            } elseif (!password_verify($pwd, $user['PWD'])) {
                $error = "Mot de passe incorrect";
            } else {
                if ((int)$user['ACTIF'] === 0){
                    $_SESSION['user']=$user;
                    header("Location: inscription.php");
                    exit();
                }

                $_SESSION['user']=$user;
                header("Location: dashboard.php");
                exit;
            }
        }
    ?>

    <form action="#" method="POST">
        Numéro d'utilisateur: <input type="text" name="userID" required><br>
        Mot de passe : <input type="password" name="pwd" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>