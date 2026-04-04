<?php
    
    // pas de session_start()
    // => si cette page n'est pas require() par une autre, la session n'est pas ouverte
    // => si la session n'est pas ouverte, cette condition est toujours vraie (pas de $_SESSION['user'])
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
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <div>
        <ul>
            <?php if(gotAdminPermission($userType)): ?>
                <li>
                    <a id="navAdmin" href="adminPanel.php">Paneau Administrateur</a>
                </li>
            <?php endif; ?>

            <li>
                <a id="navProfile" href="profilePanel.php">Mon Profil</a>
            </li>
            
            <?php if(gotTeamPermission($userType)): ?>
                <li>
                    <a id="navTeam" href="teamPanel.php">Mon Équipe</a>
                </li>
            <?php endif; ?>
            <?php if(gotAnimalPermission($userType)): ?>
                <li>
                    <a id="navAnimal" href="animalPanel.php">Animaux</a>
                </li>
                <li>
                    <a id="navSoin" href="soinPanel.php">Soins</a>
                </li>
            <?php endif; ?>
        
            <li>
                <a href="logout.php">Se déconnecter</a>
            </li>
        </ul>
    </div>
</body>
</html>