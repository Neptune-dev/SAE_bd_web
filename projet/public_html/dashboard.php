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
            <button id="profilButton" class="sidebarButton">Mon Profil</button>
            <button id="teamButton" class="sidebarButton">Mon Équipe</button>
            <button id="animalButton" class="sidebarButton">L'animal</button>
            <button id="testButton" class="sidebarButton">Test</button>
        </div>
    </div>

    <div id="contentContainer">
        <div class="content" style="visibility:visible;">Bienvenue, <?= $user["PRENOM_PERSONNEL"]?> !</div>
        <span id="profilContent" class="content">Profil</span>
        <span id="teamContent" class="content">Team</span>
        <div id="animalContent" class="content">le contenu animal</div>
        <div id="testContent" class="content">
            <?php require_once("testView.php") ?>
        </div>
    </div>

    <script src="dashboard.js"></script>
</body>
</html>