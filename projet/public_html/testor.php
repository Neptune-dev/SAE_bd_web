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
            $conn = oci_connect(constant("MYUSER"), constant("MYPASS"), constant("MYHOST"));
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
            while ($line = oci_fetch(_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)))
            {
                echo ("<tr><td>".$line['Id']."</td><td>".$line['Nom']."</td><td>".$line['Prenom']."</td></tr>");
            }
        ?>

    </table>
</body>
</html>