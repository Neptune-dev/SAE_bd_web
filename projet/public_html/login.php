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
        session_start();

        //si l'utilisateur est déjà connecté, on peut rediriger directement
        if (isset($_SESSION["user"]))
        {
            http_response_code(301);
            header("Location: dashboard.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $userID = $_POST["userID"];
            $pwd = $_POST["pwd"];

            require_once('db.php');

            $sql = "SELECT * FROM personnel WHERE id_personnel=:id";
            $user = db_one($sql, [":id" => $userID]);
            if (!$user) {
                $status = 401;
                $error = "Utilisateur introuvable.";
            } elseif (!password_verify($pwd, $user['PWD'])) {
                $status = 401;
                $error = "Mot de passe incorrect";
            } else {
                $_SESSION['user'] = $user;
                if ((int)$user['ACTIF'] === 0){
                    http_response_code(301);
                    header("Location: inscription.php");
                    exit();
                }
                
                // on recupère le type_personnel pour les droits d'accès
                $sql = "SELECT libelle_personnel FROM personnel INNER JOIN type_personnel ON personnel.type_personnel=type_personnel.id_type WHERE personnel.id_personnel=:id";
                $libPers = db_one($sql, [":id" => $userID]);
                if (!$libPers) {
                    $status = 500;
                    $error = "L'utilisateur n'a pas de type_personnel ou la requete a échoué.";
                } else {
                    $_SESSION['user']=$user;
                    $_SESSION['userType']=$libPers['LIBELLE_PERSONNEL'];
                    header("Location: dashboard.php");
                    exit;
                }   
            }
            http_response_code($status);
            echo($error);
        }
    ?>

    <form action="#" method="POST">
        Numéro d'utilisateur: <input type="text" name="userID" required><br>
        Mot de passe : <input type="password" name="pwd" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>