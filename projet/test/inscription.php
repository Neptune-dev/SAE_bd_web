<html>
    <head>
        <title>Première connexion</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div class="login" style="max-width: ;">
        <h2>Création du compte</h2>
        <form action="inscription2.php" method="POST">
            <label for="id">Identifiant</label>
            <input type="text" id="id_pers" name="id_pers" required placeholder="Entrez votre identifiant">

            <label for="nom">Nom</label>
            <input type="text" id="nom_pers" name="nom_pers" required placeholder="Entrez votre nom">

            <label for="login">Identifiant de connexion</label>
            <input type="text" name="login" required placeholder="Choisissez votre identifiant de connexion">

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required placeholder="Choisissez votre mot de passe">
            <br>
            <label for="pers">Sélectionnez votre acréditation :</label>
            <select name="id_type" id="type" required>
                <option value="">Choisissez votre acréditation</option>
                    <?php
                        require_once 'db.php';
                        $sql="SELECT * FROM type_personnel";
                        $rows = db_all($sql);
                        echo "NB=" . count($rows);
                        foreach ($rows as $row) {
                            $id=htmlentities($row['ID_TYPE']);
                            $libelle=htmlentities($row['LIBELLE']);
                            echo "<option value='$id'>$libelle</option>";
                        }
                    ?>
            <br>
            <label for="pers">Sélectionnez une équipe :</label>
            <select name="id_equipe" id="equipe" required>
                <option value="">Choisissez une équipe</option>
                    <?php
                        require_once 'db.php';
                        $sql="SELECT id_equipe FROM equipe";
                        $rows = db_all($sql);
                        foreach ($rows as $row) {
                            $id=htmlentities($row['ID_EQUIPE']);
                            echo "<option value='$id'>$id</option>";
                        }
                    ?>
            </select>
            <br>
            <label>Date de naissance :</label>

            <select name="jour" required>
            <option value="">Jour</option>
            <?php 
                for ($i = 1; $i <= 31; $i++){
                    echo "<option value='{$i}'>$i</option>";
                }
            ?>
            </select>
            <select name="mois" required>
            <option value="">Mois</option>
            <?php 
                for ($i = 1; $i <= 12; $i++){
                    echo "<option value='{$i}'>$i</option>";
                }
            ?>
            </select>
            <select name="annee" required>
            <option value="">Année</option>
            <?php
                $annee_actuelle = date("Y");
                for ($i = $annee_actuelle; $i >= 1900; $i--){
                    echo "<option value='{$i}'>$i</option>";
                }
            ?>
            </select>
            <br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>