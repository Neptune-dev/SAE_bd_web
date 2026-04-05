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
                    <a id="navAdmin" href="adminPanel.php">Panneau Administrateur</a>
                </li>
            <?php endif; ?>

            <?php if(gotDirectorPermission($userType)): ?>
                <li>
                    <a id="navDirector" href="directorPanel.php">Gestion</a>
                </li>
                <div class="submenu" id="navDirectorSubmenu">
                    <li>
                        <a id="navDirector" class="sub" href="directorPanel.php#teams">Équipes</a>
                    </li>
                    <li>
                        <a id="navDirector" class="sub" href="directorPanel.php#zones">Zones</a>
                    </li>
                    <li>
                        <a id="navDirector" class="sub" href="directorPanel.php#workers">Personnels</a>
                    </li>
                </div>
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
                    <a id="navEspece" href="especePanel.php">Espèces</a>
                </li>
                <li>
                    <a id="navAnimal" href="animalPanel.php">Animaux</a>
                </li>
                <li>
                    <a id="navSoin" href="soinPanel.php">Soins</a>
                </li>
            <?php endif; ?>
            <?php if (gotChefPermission($userType)): ?>
                <li>
                    <a id="navBoutique" href="boutiquePanel.php">Boutique</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="parrainagePanel.php">Parrainage</a>
            </li>
            <li>
                <a href="index.php">Page d'accueil</a>
            </li>
            <li>
                <a id="logoutbtn" href="logout.php">Se déconnecter</a>
            </li>
        </ul>
    </div>
</body>
</html>