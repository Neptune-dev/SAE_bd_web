<?php
    // pas de session_start()
    // => si cette page n'est pas require() par une autre, la session n'est pas ouverte
    // => si la session n'est pas ouverte, cette condition est fausse
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    coucou, c'est un exemple
</body>
</html>