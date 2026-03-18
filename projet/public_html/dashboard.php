<?php
    // vérification de la session
    session_start();
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    } elseif (!isset($_SESSION['userType'])) {
        http_response_code(500);
        header("Location: logout.php");
        exit();
    }

    $user = $_SESSION['user'];
    $userType = $_SESSION['userType'];

    require_once("permission.php");
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
            <button id="profileButton" class="sidebarButton">Mon Profil</button>
            
            <?php if(gotTeamPermission($userType)): ?>
                <button id="teamButton" class="sidebarButton">Mon Équipe</button>
            <?php endif; ?>
            <?php if(gotAdminPermission($userType)): ?>
                <button id="admButton" class="sidebarButton">Paneau Administrateur</button>
            <?php endif; ?>
            <?php if(gotAnimalPermission($userType)): ?>
                <button id="animalButton" class="sidebarButton">Animaux</button>
            <?php endif; ?>
            <?php if(gotTestPermission($userType)): ?>
                <button id="testButton" class="sidebarButton">Test</button>
            <?php endif; ?>
            
            
            <button id="logoutBtn" onclick="location.href='logout.php'">Se déconnecter</button>
        </div>
    </div>

    <div id="contentContainer">
        <div class="content" style="visibility:visible;">Bienvenue, <?= $user["PRENOM_PERSONNEL"]?> !</div>
        
        <span id="profileContent" class="content">Profil</span>
        
        <?php if(gotTeamPermission($userType)): ?>
            <span id="teamContent" class="content">Team</span>
        <?php endif; ?>
        <?php if(gotAdminPermission($userType)): ?>
            <div id="admContent" class="content">panneau admin</div>
        <?php endif; ?>
        <?php if(gotAnimalPermission($userType)): ?>
            <div id="animalContent" class="content">le contenu animal</div>
        <?php endif; ?>
        <?php if(gotTestPermission($userType)): ?>
            <div id="testContent" class="content">
                <?php require("testView.php") ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="dashboard.js"></script>
</body>
</html>