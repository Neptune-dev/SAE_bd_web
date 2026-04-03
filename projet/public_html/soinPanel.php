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
    } elseif (!gotAnimalPermission($_SESSION['userType'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="page.css">
    <title>Soin Panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <form action="" method="GET">
                <label>Mot clé:</label>
                <input type="text" name="motcle">
                <button type="submit" name="cherche_animal">Rechercher</button>
            </form>
            <?php
                if (isset($_GET['cherche_animal'])) {
                    $motcle = $_GET['motcle'] ? $_GET['motcle'] : '';
                    $sql = "SELECT animal.RFID_animal, animal.nom_animal, animal.prenom_animal, espece.nom_latin, espece.nom_usuel FROM animal LEFT JOIN espece ON animal.espece_animal=espece.id_espece WHERE 1";
                    $params = [];

                    if (!empty($motcle)) {
                        $sql .= " AND (LOWER(animal.RFID_animal) LIKE LOWER(:motcle) OR LOWER(animal.nom_animal) LIKE LOWER(:motcle) OR LOWER(animal.prenom_animal) LIKE LOWER(:motcle) OR LOWER(espece.nom_latin) LIKE LOWER(:motcle) OR LOWER(espece.nom_usuel) LIKE LOWER(:motcle))";
                        $params[':motcle']='%'.$motcle.'%';
                    }

                    $result=db_all($sql,$params);
                    foreach ($result as $tb) {
                        echo "<p><strong>{$tb['NOM_ANIMAL']} - {$tb['PRENOM_ANIMAL']}</strong> — {$tb['RFID_ANIMAL']} (Espèce : {$tb['NOM_USUEL']} - {$tb['NOM_LATIN']})</p>";
                        echo "<form action='soigner_animal.php' method='POST'><input type='hidden' name='RFID' value='{$tb['RFID_ANIMAL']}'><button type='submit'>Soigner</button></form><a href='historique_soin.php?RFID={$tb['RFID_ANIMAL']}'>Historique des soins</a>";
                    }
                }
            ?>
        </div>
</body>
</html>