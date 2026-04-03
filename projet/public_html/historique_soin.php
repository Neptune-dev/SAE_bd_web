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
            <table border="1">
                <tr>
                    <th>Date du soin</th>
                    <th>Type du soin</th>
                    <th>Soigneur</th>
                </tr>
            <?php
                $sql="SELECT * FROM soin WHERE rfid_soin=:rfid";
                $rfid=$_GET['RFID'];
                $result=db_all($sql,[':rfid'=>$rfid]);
                foreach ($result as $row) {
                    echo "<tr><td>{$row['DATE_DE_SOIN']}</td><td>{$row['TYPE_SOIN']}</td><td>{$row['ID_PERSONNEL_SOIN']}</td></tr>";
                }
            ?>
            </table>
        </div>
    </div>
</body>
</html>