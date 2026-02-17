<?php
    session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Oracle</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <header>
    </header>

    <table>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>

        <?php
            //recupération des constantes
            require_once('myparam.inc.php');

            //connexion à la db
            $conn = oci_connect(MYUSER, MYPASS, MYHOST);
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            // Préparation de la requête
            $stid = oci_parse($conn, 'SELECT * FROM Test');
            if (!$stid) {
                $e = oci_error($conn);
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            // Exécution de la logique de la requête
            $r = oci_execute($stid);
            if (!$r) {
                $e = oci_error($stid);
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            // fetch et affichage
            while (oci_fetch($stid))
            {
                echo ("<tr><td>".oci_result($stid, 'ID')."</td><td>".oci_result($stid, 'NOM')."</td><td>".oci_result($stid, 'PRENOM')."</td></tr>");
            }

            oci_free_statement($stid);
            oci_close($conn);
        ?>

    </table>
</body>
</html>