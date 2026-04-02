<html>
    <head>
        <title>Modifier un animal</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="login" style="max-width: ;">
        <h2>Modification d'un animal</h2>
        <?php
        session_start();
        require_once('db.php');
        require_once('permission.php');
        $id_animal=$_GET['RFID_animal'];
        echo "<form action='#' method='POST'><label for='id'>Identifiant</label>";
        $sql = "SELECT * FROM animal WHERE RFID_animal=:RFID";
        $result=db_one($sql,[':RFID'=>$id_animal]);
        if ($result) {
            echo "<input type='text' id='RFID_animal' name='RFID_animal' required placeholder='Entrez l'identifiant de l'animal' value='$id_animal' readonly>";

            echo "<label for='animal'>Nom de l'animal</label><input type='text' id='nom_animal' name='nom_animal' required placeholder='Entrez le nom de l'animal' value='{$result['NOM_ANIMAL']}'>";

            echo "<label for='animal'>Prénom de l'animal</label><input type='text' name='prenom_animal' required placeholder='Entrez le prénon de l'animal' value='{$result['PRENOM_ANIMAL']}'>";
            
            echo "<label>Poids de l'animal</label><input type='text' name='poids_animal' required placeholder='Entrez le poids de l'animal' value='{$result['POIDS_ANIMAL']}'>";

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
          echo "<button name='modifier' type='submit'>Modifier</button></form>";
          
          if (isset($_POST['modifier'])){
              $user = $_SESSION['user'];
              if (isset($user)&&(($user['TYPE_PERSONNEL']=='TPPE0003')||($user['TYPE_PERSONNEL']=='TPPE0004'))){
                  $sql="UPDATE animal SET nom_animal=:nom, prenom_animal=:prenom, espece_animal=:espece, date_de_naissance_animal=TO_DATE(:date_naissance,'YYYY-MM-DD'), regime_animal=:regime, poids_animal=:poids WHERE RFID_animal=:rfid";
                  if (password_verify($_POST['mot_de_passe'],$user['PWD'])){
                      $date_naissance = $_POST['annee'] . '-' . $_POST['mois'] . '-' . $_POST['jour'];
                      $params=[
                        ':prenom'=>$_POST['prenom_animal'],
                        ':nom'=>$_POST['nom_animal'],
                        ':rfid'=>$id_animal,
                        ':regime'=>$_POST['id_regime'],
                        ':espece'=>$_POST['id_espece'],
                        ':poids'=>$_POST['poids_animal'],
                        ':date_naissance'=>$date_naissance 
                      ];
                      db_exec($sql,$params);
                      echo "<script>
                        alert('Modification réussie');
                        window.location.href = 'animalPanel.php';
                    </script>";
                    exit();
                  } else {
                      echo "<br><p>mot de passe incorrect</p>";
                  }
              }
          }
        ?>
    </div>
</body>
</html>