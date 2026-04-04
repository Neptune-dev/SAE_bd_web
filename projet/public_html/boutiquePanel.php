<?php
    // vérification de la session
    session_start();
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }
    $user = $_SESSION["user"];
    require_once("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <title>Boutique Panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <?php
                $sql="SELECT gagner.id_boutique_ca,gagner.date_ca, gagner.montant FROM gagner LEFT JOIN boutique ON gagner.id_boutique_ca=boutique.id_boutique LEFT JOIN equipe ON boutique.id_equipe_boutique=equipe.id_equipe LEFT JOIN personnel ON equipe.id_equipe=personnel.id_equipe_personnel WHERE personnel.id_personnel=:id_pers AND boutique.id_equipe_boutique=personnel.id_equipe_personnel";
                $result=db_all($sql,[":id_pers"=>$user['ID_PERSONNEL']]);
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>ID Boutique</th>";
                echo "<th>Date chiffre d'affaire</th>";
                echo "<th>Montant</th>";
                echo "</tr>";
                foreach ($result as $row) {
                    echo "<tr><td>{$row['ID_BOUTIQUE_CA']}</td><td>{$row['DATE_CA']}</td><td>{$row['MONTANT']}</td></tr>";
                }
                echo "</table>";
            ?>
        </div>
    </div>
</body>
</html>