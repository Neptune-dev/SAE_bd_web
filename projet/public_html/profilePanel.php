<?php
    // pas de session_start()
    // => si cette page n'est pas require() par une autre, la session n'est pas ouverte
    // => si la session n'est pas ouverte, cette condition est toujours vraie (pas de $_SESSION['user'])
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        #profile {
            display: flex;
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
    <h1>Mon profil</h1>

    <div id="profile">
        <div id="profileDisplay">
            <span id="prenom"><?= $user['PRENOM_PERSONNEL'] ?></span>
            <span id="nom"><?= $user['NOM_PERSONNEL'] ?></span>
            <button id="updateBtn">Mettre à jour mon profil</button>
        </div>

        <div id="updateProfileForm">
            <form action="#" method="POST">
                <label for="prenom">Prénom</label>
                <input type="text" value="<?= $user['PRENOM_PERSONNEL'] ?>" name="fprenom">
                <input type="text" value="<?= $user['NOM_PERSONNEL'] ?>" name="fnom">
                <button type="submit">Valider les changements</button>
            </form>
        </div>
    </div>

    <div>
        <a href="inscription.php"><button>Changer de mot de passe</Button></a>
    </div>

    <script src="profilePanel.js"></script>
</body>
</html>