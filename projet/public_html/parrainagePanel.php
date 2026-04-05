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

    if (isset($_POST['ca_envoie'])) {
        $sql="INSERT INTO gagner VALUES (:id_boutique,TO_DATE(:date_ca,'DD-MM-YYYY'),:montant,:id_pers)";
        $params=[
            ":id_boutique"=>$_POST['id_boutique'],
            ":date_ca"=>date('d-m-Y'),
            ":montant"=>$_POST['CA'],
            ":id_pers"=>$user['ID_PERSONNEL']
        ];
        db_exec($sql,$params);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="page.css">
    <title>Parrainage Panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <form action="" method="POST">
                <input type="text" name="recherche" placeholder="Nom ou prénom du visiteur">
                <button type="submit" name="chercher">Rechercher</button>
            </form>
            <?php
                if (isset($_POST['chercher']) && !empty($_POST['recherche'])) {
                    $recherche = '%' . strtoupper(trim($_POST['recherche'])) . '%';

                    $sql = "SELECT id_visiteur, nom_visiteur, prenom_visiteur FROM visiteur WHERE UPPER(nom_visiteur) LIKE :rech OR UPPER(prenom_visiteur) LIKE :rech";

                    $resultat = db_all($sql, [':rech' => $recherche]);

                    if (!empty($resultat)) {
                        echo "<table border='1'>";
                        echo "<tr><th>Nom</th><th>Prénom</th><th>Action</th></tr>";

                        foreach ($resultat as $visiteur) {
                            $id = $visiteur['ID_VISITEUR'];
                            $nom = $visiteur['NOM_VISITEUR'];
                            $prenom = $visiteur['PRENOM_VISITEUR'];

                            echo "<tr>";
                            echo "<td>$nom</td>";
                            echo "<td>$prenom</td>";
                            echo "<td><a href='attribuerParrainage.php?id_visiteur=$id'>Gérer le parrainage</a></td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    }
                }
            ?>
        </div>
</body>
</html>