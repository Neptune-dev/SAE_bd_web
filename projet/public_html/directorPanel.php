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
    } elseif (!gotDirectorPermission($_SESSION['userType'])) {
        http_response_code(401);
        header("Location: login.php");
        exit();
    }

    $user = $_SESSION["user"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_GET["modifyTeam"]) && isset($_GET["tid"])) {
            if ($_GET["modifyTeam"] == true) {
                $tid = $_GET["tid"];
                $newTeamLeader = $_POST["fteamLeader"];
                $newTeamZone = $_POST["fteamZone"];

                $sql = "UPDATE equipe SET id_chef_equipe=:newTeamLeader, zone_equipe=:newTeamZone WHERE id_equipe=:tid";
                $params = [":newTeamLeader" => $newTeamLeader, ":newTeamZone" => $newTeamZone, ":tid" => $tid];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }
                header("Location: directorPanel.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="page.css">
    <title>Direction</title>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <!-- affichage détaillé de l'équipe -->
            <?php if(isset($_GET["tid"])): ?>

                <?php
                    $sql = "SELECT * FROM personnel WHERE id_equipe_personnel = :idEq ORDER BY nom_personnel ASC";
                    $params = [":idEq" => $_GET["tid"]];
                    $teamMembers = db_all($sql, $params);

                    $sql = "SELECT * FROM personnel p INNER JOIN equipe e ON p.id_personnel = e.id_chef_equipe WHERE id_equipe_personnel = :idEq";
                    $params = [":idEq" => $_GET["tid"]];
                    $teamLeader = db_one($sql, $params);
                    if (!$teamLeader) {
                        http_response_code(500);
                        header("Location: dashboard.php");
                        exit;
                    }

                    $sql = "SELECT * FROM zone ORDER BY id_zone ASC";
                    $params = [];
                    $zones = db_all($sql, $params);

                    $sql = "SELECT * FROM equipe WHERE id_equipe = :idEq";
                    $params = [":idEq" => $_GET["tid"]];
                    $selectedTeam = db_one($sql, $params);
                    if (!$selectedTeam) {
                        http_response_code(500);
                        header("Location: dashboard.php");
                        exit;
                    }
                ?>
                <div>
                    <a href="directorPanel.php"><button>Retour</button></a>
                    <h1>Équipe <?= $_GET["tid"] ?></h1>
                </div>
                <div id="teamLeaderPanel">
                    <form action="?modifyTeam=true&tid=<?= $_GET["tid"] ?>" method="POST">
                        <label for="fteamLeader">Chef d'Équipe</label>
                        <select name="fteamLeader">
                            <?php
                                foreach ($teamMembers as $tm) {
                                    echo "<option value='".$tm["ID_PERSONNEL"]."'";
                                    if ($tm["ID_PERSONNEL"] == $teamLeader["ID_PERSONNEL"]) {
                                        echo " selected = 'selected'";
                                    }
                                    echo ">".$tm["PRENOM_PERSONNEL"]." ".strtoupper($tm["NOM_PERSONNEL"])."</option>";
                                }
                            ?>
                        </select>
                        <label for="fteamZone">Zone d'affectation</label>
                        <select name="fteamZone">
                            <?php
                                foreach ($zones as $zone) {
                                    echo "<option value='".$zone["ID_ZONE"]."'";
                                    if ($zone["ID_ZONE"] == $selectedTeam["ZONE_EQUIPE"]) {
                                        echo " selected = 'selected'";
                                    }
                                    echo ">".$zone["ID_ZONE"]."</option>";
                                }
                            ?>
                        </select>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </div>
                <div>
                    <label>Membres de l'Équipe</label>
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
            <!-- affichage principal -->
            <?php else: ?>

                <?php
                    $sql = "SELECT id_equipe, zone_equipe, id_personnel, nom_personnel, prenom_personnel FROM equipe INNER JOIN personnel ON id_chef_equipe = id_personnel ORDER BY id_equipe ASC";
                    $params = [];
                    $teams = db_all($sql, $params);
                ?>

                <h1>Mes Équipes</h1>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Zone</th>
                        <th>Chef</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                    </tr>
                    <?php
                        foreach ($teams as $team) {
                            echo "<tr>"
                                    ."<td>".$team["ID_EQUIPE"]."</td>"
                                    ."<td>".$team["ZONE_EQUIPE"]."</td>"
                                    ."<td>".$team["ID_PERSONNEL"]."</td>"
                                    ."<td>".strtoupper($team["NOM_PERSONNEL"])."</td>"
                                    ."<td>".$team["PRENOM_PERSONNEL"]."</td>"
                                    ."<td><a href='?tid=".$team["ID_EQUIPE"]."'><button>✏️</button></a></td>"
                                    ."</tr>";
                        }
                    ?>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
        let active = document.getElementById("navDirector");
        active.classList.toggle('active');
    </script>
</body>
</html>