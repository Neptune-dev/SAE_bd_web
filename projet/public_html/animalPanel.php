<?php
    require_once('permission.php');
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
    } elseif (!gotAnimalPermission($_SESSION['userType'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div id="animalContent" class="content">
            <form action="creer_animal.php" method="POST">
                <label for="animal">RFID</label>
                <input type="text" id="RFID" name="RFID" required placeholder="Numéro RFID">

                <label for="animal">Nom de l'animal</label>
                <input type="text" id="nom_animal" name="nom_animal" required placeholder="Nom de l'animal">

                <label for="animal">Prénom de l'animal</label>
                <input type="text" name="prenom_animal" required placeholder="Prénom de l'animal">
                
                <label for="animal">Date de naissance</label>
                
            
                <label for="animal">Sélection de l'espèce</label>
                <select id="espece_animal" name="espece_animal">
                <?php
                	require_once('db.php');
                    $sql = "SELECT id_espece,nom_usuel FROM espece";
                    $result = db_all($sql,[]);

                    if ($result) {
                        foreach ($result as $row) {
                             echo "<option value='{$row['ID_ESPECE']}'>{$row['NOM_USUEL']}</option>";
                        }
                    }
                ?>
                </select>
            <br>
            <button type="submit">Ajouter l\'animal</button>
            </form>
        </div>
        <div>
            <form action="" method="GET">
                <label>Mot-clé:</label>
                <input type="text" name="motcle">
                <button type="submit" name="cherche_animal">Rechercher</button>
            </form>
            <?php
                require_once('db.php');
                if (isset($_GET['cherche_animal'])){
                    $motcle = isset($_GET['motcle']) ? $_GET['motcle'] : '';
                    $sql = "SELECT animal.RFID_animal, animal.nom_animal, animal.prenom_animal, espece.nom_latin, espece.nom_usuel FROM animal LEFT JOIN espece ON animal.espece_animal=espece.id_espece WHERE 1";
                    if (!empty($motcle)){
                        $sql .= " AND (animal.RFID_animal LIKE ':motcle' OR animal.nom_animal LIKE ':motcle' OR animal.prenom_animal LIKE ':motcle' OR espece.nom_latin LIKE ':motcle' OR espece.nom_usuel LIKE ':motcle')";
                    }
                    $test='%'.$motcle.'%';
                    $result=db_all($sql,[':motcle' => $test]);
                }
            ?>
        </div
</body>
</html>