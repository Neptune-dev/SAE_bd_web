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

    $user = $_SESSION["user"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $latin = $_POST["flatin"];
        $usuel = $_POST["fusuel"];
        $menace = isset($_POST['fmenace']) ? "1" : "0";

        //selection du nouvel id
        $sql = "SELECT Max(id_espece) as max FROM espece";
        $params = [];
        $maxID = db_one($sql, $params);
        if (!$maxID) {
            http_response_code(500);
            header("Location: dashboard.php");
            exit();
        }

        if (!preg_match('/^([A-Za-z_]+)(\d+)$/', $maxID["MAX"], $m)) {
            http_response_code(500);
            header("Location: dashboard.php");
            exit();
        }

        $prefix = $m[1];
        $number = $m[2];

        // Incrémente le nombre en conservant le remplissage par zéros (longueur d'origine)
        $length = strlen($number);
        $newNumber = str_pad((string) (intval($number) + 1), $length, '0', STR_PAD_LEFT);

        $newID = $prefix . $newNumber;

        //insertion
        $sql = "INSERT INTO espece(id_espece, nom_latin, nom_usuel, menacee) VALUES(:newID, :latin, :usuel, :menace)";
        $params = [":newID" => $newID, ":latin" => $latin, ":usuel" => $usuel, ":menace" => $menace];
        $stmt = db_exec($sql, $params);
        if (!$stmt) {
            http_response_code(500);
            header("Location: dashboard.php");
            exit();
        }
    }

    $sql = "SELECT * FROM espece ORDER BY nom_latin ASC";
    $params = [];
    $species = db_all($sql, $params);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <title>Espèces</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <h1>Espèces</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom Latin</th>
                    <th>Nom Usuel</th>
                    <th>Est Menacée</th>
                </tr>
                <?php
                    foreach ($species as $s) {
                        echo "<tr>"
                            ."<td>".$s["ID_ESPECE"]."</td>"
                            ."<td>".$s["NOM_LATIN"]."</td>"
                            ."<td>".$s["NOM_USUEL"]."</td>";

                        if ($s["MENACEE"] == 1) {
                            echo "<td>⚠️ Cette espèce est menacée</td>";
                        } else {
                            echo "<td></td>";
                        }

                        echo "</tr>";
                    }
                ?>
            </table>
            <h1>Nouvelle Espèce</h1>
            <form action="" method='POST'>
                <label for="flatin">Nom Latin</label>
                <input type="text" name='flatin' required>
                <label for="fusuel">Nom Usuel</label>
                <input type="text" name='fusuel' required>
                <label for="fmenace">L'Espèce est Menacée</label>
                <input type="checkbox" name='fmenace'>
                <button type='submit'>Créer l'Espèce</button>
            </form>
        </div>
    </div>

    <script>
        let active = document.getElementById("navEspece");
        active.classList.toggle('active');
    </script>
</body>
</html>