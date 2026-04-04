<?php
    require_once('permission.php');
    require_once('db.php');
    
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
    } elseif (!gotTeamPermission($_SESSION['userType'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <title>Team Panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <div id="animalContent" class="content">
                
            </div>
        </div>
    </div>

    <script>
        let active = document.getElementById("navTeam");
        active.classList.toggle('active');
    </script>
</body>
</html>