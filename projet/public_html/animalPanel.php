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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <title>Animal Panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <div id="animalContent" class="content">
                <form action="creer_animal.php" method="POST">
                    <label for="animal">RFID</label>
                    <input type="text" id="RFID" name="RFID" required placeholder="Numéro RFID">

                    <label for="animal">Nom de l'animal</label>
                    <input type="text" id="nom_animal" name="nom_animal" required placeholder="Nom de l'animal">

                    <label for="animal">Prénom de l'animal</label>
                    <input type="text" name="prenom_animal" required placeholder="Prénom de l'animal">

                    <label>Régime alimentaire</label>
                    <select name="regime_animal">
                        <option value="">Régime</option>
                        <?php
                            $sql="SELECT * FROM regime";
                            $params=[];
                            $result=db_all($sql,$params);
                            foreach ($result as $row) {
                                echo "<option value='{$row['ID_REGIME']}'>{$row['LIBELLE_REGIME']}</option>";
                            }
                        ?>
                    </select>

                    
                    <label for="animal">Date de naissance</label>
                    <select name="jour" required>
                        <option value="">Jour</option>
                        <?php
                            for ($i=1; $i < 31; $i++) { 
                                echo "<option value='{$i}'>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="mois" required>
                        <option value="">Mois</option>
                        <?php
                            for ($i=1; $i<=12 ; $i++) { 
                                echo "<option value='{$i}'>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="annee" required>
                        <option value="">Année</option>
                        <?php
                            $annee_actuelle=date("Y");
                            for ($i=$annee_actuelle; $i >= 1950 ; $i--) { 
                                echo "<option value='{$i}'>$i</option>";
                            }
                        ?>
                    </select><br>
                
                    <label for="animal">Sélection de l'espèce</label>
                    <select id="espece_animal" name="espece_animal">
                        <option value="">Espèce</option>
                    <?php
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
                <button type="submit">Ajouter l'animal</button>
                </form>
            </div>
            <div>
                <form action="" method="GET">
                    <label>Mot-clé:</label>
                    <input type="text" name="motcle">
                    <button type="submit" name="cherche_animal">Rechercher</button>
                </form>
                <?php
                    if (isset($_GET['cherche_animal'])){
                        $motcle = isset($_GET['motcle']) ? $_GET['motcle'] : '';
                        $sql = "SELECT animal.RFID_animal, animal.nom_animal, animal.prenom_animal, espece.nom_latin, espece.nom_usuel FROM animal LEFT JOIN espece ON animal.espece_animal=espece.id_espece LEFT JOIN alimentation ON animal.RFID_animal=alimentation.RFID_alimentation WHERE 1";
                        
                        $params = [];
                        
                        if (!empty($motcle)){
                            $sql .= " AND (LOWER(animal.RFID_animal) LIKE LOWER(:motcle) OR LOWER(animal.nom_animal) LIKE LOWER(:motcle) OR LOWER(animal.prenom_animal) LIKE LOWER(:motcle) OR LOWER(espece.nom_latin) LIKE LOWER(:motcle) OR LOWER(espece.nom_usuel) LIKE LOWER(:motcle))";
                            $params[':motcle']='%'.$motcle.'%';
                        }

                        $result=db_all($sql,$params);
                        foreach ($result as $tb){
                            echo "<p><strong>{$tb['NOM_ANIMAL']} - {$tb['PRENOM_ANIMAL']}</strong> — {$tb['RFID_ANIMAL']} (Espèce : {$tb['NOM_USUEL']} - {$tb['NOM_LATIN']})</p>";
                            echo "<div class='menu' style='align-items: left; justify-content: left; background-color: #f4f4f9;'><a href='supprimer_animal.php?RFID_animal={$tb['RFID_ANIMAL']}' style='text-decoration: none; color: black;'>Supprimer l'animal</a><BR><a href='modifier_animal.php?RFID_animal={$tb['RFID_ANIMAL']}' style='text-decoration: none; color: black;'>Modifier l'animal</a></div>";
                            $sql2="SELECT MAX(date_de_nour) AS DERNIERE_DATE FROM alimentation WHERE RFID_alimentation = :rfid";
                            $rfid=$tb['RFID_ANIMAL'];
                            $params2=[
                                ':rfid'=>$rfid
                            ];
                            $result2=db_one($sql2,$params2);
                            if ($result2) {
                                echo "<p>",$result2['DERNIERE_DATE'],"</p>";
                                echo "<form method='POST' action='nourrir_animal.php'><input type='hidden' name='RFID' value='{$tb['RFID_ANIMAL']}'><input type='text' name='quantite'><button type='submit'>Je l’ai nourri</button></form>";
                                
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div>
            
        </div>
    </div>
</body>
</html>