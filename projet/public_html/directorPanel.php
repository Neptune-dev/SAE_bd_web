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
        if (isset($_GET["modify"])) {
            if ($_GET["modify"] == 'team' && isset($_GET["tid"])) {
                $tid = $_GET["tid"];
                $newTeamLeader = $_POST["fteamLeader"];
                $newTeamZone = $_POST["fteamZone"];

                if ($newTeamZone == 'NULL') {
                    $newTeamZone = null;
                } 

                $sql = "UPDATE equipe SET id_chef_equipe=:newTeamLeader, zone_equipe=:newTeamZone WHERE id_equipe=:tid";
                $params = [":newTeamLeader" => $newTeamLeader, ":newTeamZone" => $newTeamZone, ":tid" => $tid];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                header("Location: directorPanel.php#teams");
                exit();
            } elseif ($_GET["modify"] == 'addTeam') {
                //selection du nouvel id
                $sql = "SELECT Max(id_equipe) as max FROM equipe";
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
                $sql = "INSERT INTO equipe(id_equipe, id_chef_equipe) VALUES(:newID, :chefID)";
                $params = [":newID" => $newID, ":chefID" => $user["ID_PERSONNEL"]];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                header("Location: directorPanel.php#teams");
                exit();
            } elseif ($_GET["modify"] == 'deleteTeam') {
                $tid = $_POST["ftid"];

                // maj des personnels
                $sql = "UPDATE personnel SET id_equipe_personnel=NULL WHERE id_equipe_personnel=:tid";
                $params = [":tid" => $tid];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                // maj des boutiques
                $sql = "UPDATE boutique SET id_equipe_boutique=NULL WHERE id_equipe_boutique=:tid";
                $params = [":tid" => $tid];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                // supression
                $sql = "DELETE FROM equipe WHERE id_equipe=:tid";
                $params = [":tid" => $tid];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                header("Location: directorPanel.php#teams");
                exit();
            } elseif ($_GET["modify"] == 'deletezone') {
                $zoneID = $_POST["fzoneID"];

                $sql = "DELETE FROM zone WHERE id_zone=:zid";
                $params = [":zid" => $zoneID];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }
                header("Location: directorPanel.php#zones");
                exit();
            } elseif ($_GET["modify"] == 'addzone') {

                //selection du nouvel id
                $sql = "SELECT Max(id_zone) as max FROM zone";
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
                $sql = "INSERT INTO zone(id_zone) VALUES(:newID)";
                $params = [":newID" => $newID];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                header("Location: directorPanel.php#zones");
                exit();
            } elseif ($_GET["modify"] == 'worker') {

                $pid = $_POST["fpid"];
                $team = $_POST["fteam"];
                $name = $_POST["fname"];
                $surname = $_POST["fsurname"];
                $type = $_POST["ftype"];
                $salary = $_POST["fsalary"];

                if ($team == 'NULL') {
                    $team = null;
                }

                $sql = "UPDATE personnel SET id_equipe_personnel=:team, nom_personnel=:name, prenom_personnel=:surname, type_personnel=:type, salaire_personnel=:salary WHERE id_personnel=:pid";
                $params = [":team" => $team, ":name" => $name, ":surname" => $surname, ":type" => $type, ":salary" => $salary, ":pid" => $pid];
                $stmt = db_exec($sql, $params);
                if (!$stmt) {
                    http_response_code(500);
                    header("Location: dashboard.php");
                    exit();
                }

                header("Location: directorPanel.php#workers");
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
    <style>
        #content {
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 2050px) {
            #content {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="sidebar">
            <?php require('navbar.php'); ?>
        </div>
        <div id="content">
            <div class="panel">
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
                            $teamLeader = $user;
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
                        <form action="?modify=team&tid=<?= $_GET["tid"] ?>" method="POST">
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
                                    $asZone = false;
                                    foreach ($zones as $zone) {
                                        echo "<option value='".$zone["ID_ZONE"]."'";
                                        if ($zone["ID_ZONE"] == $selectedTeam["ZONE_EQUIPE"]) {
                                            echo " selected = 'selected'";
                                            $asZone = true;
                                        }
                                        echo ">".$zone["ID_ZONE"]."</option>";
                                    }
                                    if ($asZone) {
                                        echo "<option value='NULL'>-</option>";
                                    } else {
                                        echo "<option value='NULL' selected='selected'>-</option>";
                                    }
                                ?>
                            </select>
                            <button class="secondary" type="submit">Mettre à jour</button>
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
                        <form action="?modify=deleteTeam" method='POST'>
                            <input type='hidden' name='ftid' value='<?= $_GET["tid"] ?>'></input>
                            <button class='red'>Supprimer l'Équipe</button>
                        </form>
                    </div>
                <!-- affichage principal -->
                <?php else: ?>

                    <?php
                        $sql = "SELECT id_equipe, zone_equipe, id_personnel, nom_personnel, prenom_personnel FROM equipe OUTER JOIN personnel ON id_chef_equipe = id_personnel ORDER BY id_equipe ASC";
                        $params = [];
                        $teams = db_all($sql, $params);

                        $sql = "SELECT * FROM zone ORDER BY id_zone ASC";
                        $params = [];
                        $zones = db_all($sql, $params);
                    ?>

                    <section id="teams">
                        <h1>Mes Équipes</h1>
                        <form action='?modify=addTeam' method='POST'><button type='submit'>Nouvelle Équipe</button></form>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Zone</th>
                                <th>Chef</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Modifier</th>
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
                    </section>
                    <section id="zones">
                        <h1>Les Zones</h1>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Modification</th>
                            </tr>
                            <?php
                                foreach ($zones as $zone) {
                                    echo "<tr><td>".$zone["ID_ZONE"]."</td>";

                                    $sql = "SELECT zone_enclos FROM enclos WHERE zone_enclos=:zoneID UNION SELECT id_zone_boutique FROM boutique WHERE id_zone_boutique=:zoneID UNION SELECT zone_equipe FROM equipe WHERE zone_equipe=:zoneID";
                                    $params = [":zoneID" => $zone["ID_ZONE"]];
                                    $stmt = db_one($sql, $params);

                                    if ($stmt) {
                                        echo "<td>De cette zone dépendent des entités</td>";
                                    } else {
                                        echo "<td><form action='?modify=deletezone' method='POST'><input type='hidden' name='fzoneID' value='".$zone["ID_ZONE"]."'></input><button class='red' type='submit'>🗑️</button></form></td>";
                                    }

                                    echo "</tr>";
                                }
                            ?>
                            <tr>
                                <td><b>Ajouter une zone</b></td>
                                <td><form action='?modify=addzone' method='POST'><button class='secondary' type='submit'>+</button></form></td>
                            </tr>
                        </table>
                    </section>
                <?php endif; ?>
            </div>
            <div class="panel">
                <?php if(!isset($_GET["tid"])): ?>

                    <?php
                        $sql = "SELECT * FROM personnel OUTER JOIN type_personnel ON type_personnel = id_type ORDER BY nom_personnel ASC";
                        $params = [];
                        $personnels = db_all($sql, $params);

                        $sql = "SELECT * FROM type_personnel ORDER BY id_type ASC";
                        $params = [];
                        $types = db_all($sql, $params);

                        $sql = "SELECT * FROM equipe ORDER BY id_equipe ASC";
                        $params = [];
                        $teams = db_all($sql, $params);

                        $sql = "SELECT id_personnel FROM personnel INNER JOIN equipe ON id_personnel = id_chef_equipe ORDER BY id_personnel ASC";
                        $params = [];
                        $chefs = db_all($sql, $params);
                    ?>

                    <section id="workers">
                        <h1>Les Personnels</h1>
                        <button id="blurSalaryBtn">Afficher les salaires</button>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Équipe</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Fonction</th>
                                <th>Salaire (€)</th>
                                <th>Modifier</th>
                            </tr>
                            <?php
                                if (isset($_GET["pid"])) {
                                    $pid = $_GET["pid"];
                                } else {
                                    $pid = "";
                                }
                                foreach ($personnels as $personnel) {
                                    if ($personnel["ID_PERSONNEL"] == $pid) {
                                        echo "<tr><form action='?modify=worker' method='POST'>"
                                            ."<input type='hidden' name='fpid' value='".$pid."'></input>"
                                            ."<td>".$personnel["ID_PERSONNEL"]."</td>";
                                        
                                        // selection d'équipe
                                        $isChef = false;
                                        foreach ($chefs as $chef) {
                                            if ($chef["ID_PERSONNEL"] == $personnel["ID_PERSONNEL"]) {
                                                $isChef = true;
                                            }
                                        }
                                        if ($isChef) {
                                            echo "<td>Chef de l'Équipe <a href='?tid=".$personnel["ID_EQUIPE_PERSONNEL"]."'>".$personnel["ID_EQUIPE_PERSONNEL"]."</a></td>";
                                        } else {
                                            $asTeam = false;
                                            echo "<td><select name='fteam'>";
                                            foreach ($teams as $team) {
                                                echo "<option value='".$team["ID_EQUIPE"]."'";
                                                if ($personnel["ID_EQUIPE_PERSONNEL"] == $team["ID_EQUIPE"]) {
                                                    echo " selected='selected'";
                                                    $asTeam = true;
                                                }
                                                echo ">".$team["ID_EQUIPE"]."</option>";
                                            }

                                            if ($asTeam) {
                                                echo "<option value='NULL'>-</option>";
                                            } else {
                                                echo "<option value='NULL' selected='selected'>-</option>";
                                            }
                                            echo "</select></td>";
                                        }
                                                
                                        echo "<td><input type='text' name='fname' value=".$personnel["NOM_PERSONNEL"]." required></input></td>"
                                            ."<td><input type='text' name='fsurname' value=".$personnel["PRENOM_PERSONNEL"]." required></input></td>";
                                        
                                        // selection du type
                                        echo "<td><select name='ftype'>";
                                        foreach ($types as $type) {
                                            echo "<option value='".$type["ID_TYPE"]."'";
                                            if ($personnel["TYPE_PERSONNEL"] == $type["ID_TYPE"]) {
                                                echo " selected='selected'";
                                            }
                                            echo ">".$type["LIBELLE_PERSONNEL"]."</option>";
                                        }
                                        echo "</select></td>";

                                        echo "<td><input type='number' name='fsalary' value=".$personnel["SALAIRE_PERSONNEL"]." required></input></td>"
                                            ."<td><button class='secondary' type='submit'>✅</button></td>"
                                            ."</form></tr>";
                                    } else {
                                        echo "<tr>"
                                                ."<td>".$personnel["ID_PERSONNEL"]."</td>"
                                                ."<td><a href='?tid=".$personnel["ID_EQUIPE_PERSONNEL"]."'>".$personnel["ID_EQUIPE_PERSONNEL"]."</a></td>"
                                                ."<td>".$personnel["NOM_PERSONNEL"]."</td>"
                                                ."<td>".$personnel["PRENOM_PERSONNEL"]."</td>"
                                                ."<td>".$personnel["LIBELLE_PERSONNEL"]."</td>"
                                                ."<td class='salary blurry'>".$personnel["SALAIRE_PERSONNEL"]."</td>"
                                                ."<td><a href='?pid=".$personnel["ID_PERSONNEL"]."#workers'><button>✏️</button></a></td>"
                                                ."</tr>";
                                    }
                                }
                            ?>
                        </table>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        let active = document.getElementById("navDirector");
        active.classList.toggle('active');
        let submenu = document.getElementById("navDirectorSubmenu");
        submenu.classList.toggle('submenu');
    </script>

    <script>
        let blurry = true;

        let salaries = document.querySelectorAll('.salary');
        let blurSalaryBtn = document.getElementById('blurSalaryBtn');

        blurSalaryBtn.addEventListener("click", () => {
            salaries.forEach(salary => {
                salary.classList.toggle('blurry');
            });

            blurry = !blurry;

            if (blurry) {
                blurSalaryBtn.innerText = "Afficher les salaires";
            } else {
                blurSalaryBtn.innerText = "Masquer les salaires";
            }
        });
    </script>
</body>
</html>