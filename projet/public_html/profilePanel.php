<?php
    // vérification de la session
    session_start();
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION["user"];

    // gestion, mise à jour du profil
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nom = $_POST["fnom"];
        $prenom = $_POST["fprenom"];
        $pwd = $_POST["fpwd"];

        if (!password_verify($pwd, $user['PWD'])) {
            $status = 401;
            $error = "Mot de passe incorrect";
        } else {

            require_once('db.php');

            $sql = "UPDATE personnel SET nom_personnel = :nom, prenom_personnel = :prenom WHERE id_personnel = :id";
            $stmt = db_exec($sql, [":nom" => $nom, ":prenom" => $prenom, ":id" => $user["ID_PERSONNEL"]]);
            if (!$stmt) {
                $status = 500;
                $error = "La requete a échoué.";
            } else {
                // rechargement de la session
                $sql = "SELECT * FROM personnel WHERE id_personnel=:id";
                $user = db_one($sql, [":id" => $user["ID_PERSONNEL"]]);
                if (!$user) {
                    $status = 401;
                    $error = "Utilisateur introuvable.";
                } else {
                    $_SESSION['user']=$user;
                    header("Location: #");
                    exit();
                }
            }
        }
        http_response_code($status);
        echo($error);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <style>
        .flexed {
            display: flex;
        }

        #profile {
            background-color: #979797;
            padding: 15px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        #profileDisplay {
            display: flex;
            flex-direction: column;
        }

        #updateProfileForm {
            display: none;
            flex-direction: column;
        }
    </style>


</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <h1>Mon profil</h1>

            <div id="profile" class="flexed">
                <div id="profileDisplay">
                    <span id="prenom"><?= $user['PRENOM_PERSONNEL'] ?></span>
                    <span id="nom"><?= $user['NOM_PERSONNEL'] ?></span>
                    <button id="updateBtn">Mettre à jour mon profil</button>
                </div>

                <div id="updateProfileForm">
                    <form action="#" method="POST">
                        <label for="prenom">Prénom</label>
                        <input type="text" value="<?= $user['PRENOM_PERSONNEL'] ?>" name="fprenom" required>
                        <label for="prenom">Nom</label>
                        <input type="text" value="<?= $user['NOM_PERSONNEL'] ?>" name="fnom" required>
                        <label for="prenom">Mot de Passe</label>
                        <input type="password" name="fpwd" required>
                        <button type="submit">Valider les changements</button>
                    </form>
                    <a href="#"><button id="cancelUpdateBtn">Annuler</button></a>
                </div>
            </div>

            <br><br>

            <div class="flexed">
                <a href="inscription.php"><button>Changer de mot de passe</Button></a>
            </div>

            <script src="profilePanel.js"></script>
        </div>
    </div>
</body>
</html>