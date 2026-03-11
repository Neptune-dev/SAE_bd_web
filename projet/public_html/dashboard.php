<?php
    // vérification de la session
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
</head>
<body>

    <div id="sidebar">
        <h1><?= strtoupper($user["NOM_PERSONNEL"]), " ", $user["PRENOM_PERSONNEL"]?></h1>
        <h2>N° de Personnel : <?= $user["ID_PERSONNEL"] ?></h2>

        <label>Mes services :</label>
        <div>
            <button>Mon Profil</button>
            <button>Mon Équipe</button>
        </div>
    </div>

    <div id="content">
        <span>Coucou</span>
    </div>

</body>
</html>