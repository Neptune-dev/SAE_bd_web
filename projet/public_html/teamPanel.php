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
    } elseif (!gotTeamPermission($_SESSION['userType'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }

    $user = $_SESSION["user"];
    $teamId = $user["ID_EQUIPE_PERSONNEL"];

    $sql = "SELECT * FROM personnel WHERE id_equipe_personnel = :idEq";
    $params = [":idEq" => $teamId];
    $teamMembers = db_all($sql, $params);

    $sql = "SELECT * FROM personnel p INNER JOIN equipe e ON p.id_personnel = e.id_chef_equipe WHERE id_equipe_personnel = :idEq";
    $params = [":idEq" => $teamId];
    $teamLeader = db_one($sql, $params);
    if (!$teamLeader) {
        http_response_code(500);
        header("Location: dashboard.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <title>Team Panel</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <div>
                <h1>Mon Équipe</h1>
                <label>Numéro d'Équipe : <?= $teamId ?></label>
                <label>Chef d'Équipe : <?= $teamLeader["PRENOM_PERSONNEL"]." ".strtoupper($teamLeader["NOM_PERSONNEL"]) ?></label>
            </div>
            <div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                    </tr>
                    <?php
                        foreach ($teamMembers as $tm) {
                            echo "<tr>"
                                ."<td>".$tm["ID_PERSONNEL"]."</td>"
                                ."<td>".$tm["NOM_PERSONNEL"]."</td>"
                                ."<td>".$tm["PRENOM_PERSONNEL"]."</td>";

                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        let active = document.getElementById("navTeam");
        active.classList.toggle('active');
    </script>
</body>
</html>