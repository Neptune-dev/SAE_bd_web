<?php
    require_once('permission.php');
    
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
    } elseif (!gotAdminPermission($_SESSION['userType'])) {
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
    <title>Admin panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <h1>
                C'est l'admin panel
            </h1>
        </div>
    </div>
</body>
</html>