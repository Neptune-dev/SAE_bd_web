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
</head>
<body>

    <h1><?= strtoupper($user["NOM_PERSONNEL"]), " ", $user["PRENOM_PERSONNEL"]?></h1>
    <h2>N° de Personnel : <?= $user["ID_PERSONNEL"] ?></h2>

</body>
</html>