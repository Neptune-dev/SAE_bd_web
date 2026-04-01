<html>
    <head>
        <title>Modifier un animal</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="login" style="max-width: ;">
        <h2>Modification du compte d'un animal</h2>
        <?php
        session_start();
        require_once('db.php');
        require_once('permission.php');
        $id_animal=$_GET['RFID_animal'];
        echo "<form action='#' method=''><label for='id'>Identifiant</label>";
        $sql = "SELECT * FROM animal WHERE RFID_animal=:RFID";
        $result=db_one($sql,[':RFID'=>$id_animal]);
        if ($result) {
            echo "<input type='text' id='RFID_animal' name='RFID_animal' required placeholder='Entrez l'identifiant de l'animal' value='$id_animal' readonly>";

            echo "<label for='animal'>Nom de l'animal</label><input type='text' id='nom_animal' name='nom_animal' required placeholder='Entrez le nom de l'animal' value='{$result['NOM_ANIMAL']}'>";

            echo "<label for='animal'>Prénom de l'animal</label><input type='text' name='prenom_animal' required placeholder='Entrez le prénon de l'animal' value='{$result['PRENOM_ANIMAL']}'>";

            echo "<label for='animal'>Mot de passe</label><input type='password' id='mot_de_passe' name='mot_de_passe' required placeholder='Saisissez votre mot de passe'>";

            echo "<label for='animal'>Espèce</label><select type='text' name='id_espece' required>";
            $sql="SELECT nom_usuel,id_espece FROM espece WHERE id_espece!=:id";
            $result2=db_all($sql,[':id'=>$result['ESPECE_ANIMAL']]);
            $sql="SELECT id_espece, nom_usuel FROM espece WHERE id_espece=:id";
            $result3=db_one($sql,[':id'=>$result['ESPECE_ANIMAL']]);
            echo "<option value='{$result3['ID_ESPECE']}'>{$result3['NOM_USUEL']}</option>";
            foreach ($result2 as $row) {
                echo "<option value='{$row['ID_ESPECE']}'>{$row['NOM_USUEL']}</option>";
            }

            echo "</select><br><label>Régime de l'animal</label><select type='text' name='id_regime' required>";
            $sql="SELECT * FROM regime WHERE id_regime=:id";
            $result3=db_one($sql,[':id'=>$result['REGIME_ANIMAL']]);
            echo "<option value='{$result3['ID_REGIME']}'>{$result3['LIBELLE_REGIME']}</option>";
            $sql="SELECT * FROM regime WHERE id_regime!=:id";
            $result2=db_all($sql,[':id'=>$result['REGIME_ANIMAL']]);
            foreach ($result2 as $row) {
                echo "<option value='{$row['ID_REGIME']}'>{$row['LIBELLE_REGIME']}</option>";
            }
            echo "</select><br>";


            echo "<label>Date de naissance :</label><select name='jour' required>";

            $date = new DateTime($result['DATE_DE_NAISSANCE_ANIMAL']);

            $jour = (int)$date->format('d');
            $mois = (int)$date->format('m');
            $annee = (int)$date->format('Y');

            echo "<option value='{$jour}'>$jour</option>";
            for ($i = 1; $i <= 31; $i++){
                if ($i!=$jour) {
                    echo "<option value='{$i}'>$i</option>";
                }
            }
            echo "</select><select name='mois' required><option value='{$mois}'>$mois</option>";
                for ($i = 1; $i <= 12; $i++){
                    if ($i!=$mois) {
                        echo "<option value='{$i}'>$i</option>";
                    }
                }
            echo "</select><select name='annee' required><option value='$annee'>$annee</option>";
            $annee_actuelle=date("Y");
                for ($i = $annee_actuelle; $i >= 1900; $i--){
                    if ($i!=$annee) {
                        echo "<option value='{$i}'>$i</option>";
                    }
                }
            echo "</select><br>";
        }
          echo "<button type='submit'>Modifier</button></form>";
        ?>
    </div>
</body>
</html>