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
    <link rel="stylesheet" href="page.css">
    <title>Dashboard</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <h1>
                Bienvenue,
                <?php
                    echo ($user["PRENOM_PERSONNEL"] != "") ? $user["PRENOM_PERSONNEL"] : $user["ID_PERSONNEL"];
                ?>
                !
            </h1>
        </div>
    </div>
</body>
</html>