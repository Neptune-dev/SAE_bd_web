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

    if (isset($_POST['valide'])) {
        $id_vis=$_POST['id_visiteur'];
        $rfid=$_POST['RFID'];
        $niv=$_POST['niveaux'];
        $sql="SELECT * FROM parrainage WHERE id_visiteur_parrainage=:id";
        $res=db_one($sql,[':id'=>$id_vis]);
        if (!empty($res)) {
            $id=$res['ID_PARRAINAGE'];
            $params=[
                ":id"=>$id,
                ":rfid"=>$rfid,
                ":niveau"=>$niv
            ];
            $sql="UPDATE parrainage SET RFID_parrainage=:rfid, niveau_parrainage=:niveau WHERE id_parrainage=:id";
            db_exec($sql,$params);
        } else {
            $sql="SELECT MAX(id_parrainage) AS max_par FROM parrainage";
            $res=db_one($sql,[]);
            $der_id=$res['MAX_PAR'];
            $numero = (int) str_replace('PAR', '', $dernier_id);
            $numero++;
            $id = 'PAR' . sprintf('%05d', $numero); //longueur chaine de chiffre 5 compléter avec des zéros une valeur entière (voir cours lang C)
            $sql="INSERT INTO parrainage VALUES (:id,:id_vis,:rfid,:niveau)";
            $params=[
                ":id"=>$id,
                ":id_vis"=>$id_vis,
                ":rfid"=>$rfid,
                ":niveau"=>$niv
            ];
            db_exec($sql,$params);
        }
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
            <?php
                $sql="SELECT * FROM parrainage WHERE id_visiteur_parrainage=:id";
                $res=db_one($sql,[':id'=>$_GET['id_visiteur']]);
                if (!empty($res)) {
                    echo "<table border='1'><tr><th>Identifiant visiteur</th><th>RFID animal parrainé</th><th>Niveau parrainage</th></tr><tr><td>{$res['ID_VISITEUR_PARRAINAGE']}</td><td>{$res['RFID_PARRAINAGE']}</td><td>{$res['NIVEAU_PARRAINAGE']}</td></tr></table>";
                    echo "<h2>Prestation</h2>";
                    echo "<table border='1'><tr><th>Libelle prestation</th></tr>";
                    $sql="SELECT libelle_prestation FROM prestation WHERE 1";
                    if ($res['NIVEAU_PARRAINAGE']=="BRONZE") {
                        $sql .= " AND niveau_min_prestation='BRONZE'";
                        $res2=db_all($sql,[]);
                        foreach ($res2 as $row) {
                            echo "<tr><td>{$row['LIBELLE_PRESTATION']}</td></tr>";
                        }
                        echo "</table>";
                    } elseif ($res['NIVEAU_PARRAINAGE']=="ARGENT") {
                        $sql .= " AND niveau_min_prestation='BRONZE' OR niveau_min_prestation='ARGENT'";
                        $res2=db_all($sql,[]);
                        foreach ($res2 as $row) {
                            echo "<tr><td>{$row['LIBELLE_PRESTATION']}</td></tr>";
                        }
                        echo "</table>";
                    } elseif ($res['NIVEAU_PARRAINAGE']=="OR") {
                        $res2=db_all($sql,[]);
                        foreach ($res2 as $row) {
                            echo "<tr><td>{$row['LIBELLE_PRESTATION']}</td></tr>";
                        }
                        echo "</table>";
                    }
                }
            ?>
            <form action="" method="POST">
                <?php
                    echo "<input type='hidden' name='id_visiteur' value='{$_GET['id_visiteur']}'>";
                    echo "<select name='RFID'>";
                    $sql="SELECT RFID_animal FROM animal";
                    $res=db_all($sql,[]);
                    foreach ($res as $row) {
                        echo "<option value'{$row['RFID_ANIMAL']}'>{$row['RFID_ANIMAL']}</option>";
                    }
                    echo "</select>";
                ?>
                <select name="niveaux">
                    <option value="BRONZE">BRONZE</option>
                    <option value="ARGENT">ARGENT</option>
                    <option value="OR">OR</option>
                </select>
                <button type="submit" name="valide">Validez</button>
            </form>