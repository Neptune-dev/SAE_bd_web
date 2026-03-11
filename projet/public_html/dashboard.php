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
    <title>Dashboard</title>

    <!-- redirection après 10 secondes -->
    <meta http-equiv="refresh" content="10;url=logout.php">
</head>
<body>

    <h1><?= $user["prenom_personnel"], " ", strtoupper($user["nom_personnel"])?></h1>
    <h2><?= $user["id_personnel"] ?></h2>

</body>
</html>