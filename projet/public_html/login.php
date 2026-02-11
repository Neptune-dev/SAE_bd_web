<?php
    ob_start();
?>

<!-- CONTENU DE LA PAGE -->

<?php
    session_start();

    //si l'utilisateur est déjà connecté, on peut rediriger directement
    if (isset($_SESSION["user"]))
    {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $userID = $_POST["userID"];
        $pwd = $_POST["pwd"];

        //recupération des constantes
        require_once('myparam.inc.php');

        //connexion à la db
        $conn = oci_connect(constant("MYUSER"), constant("MYPASS"), constant("MYHOST"));
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        // Préparation de la requête
        $stid = oci_parse($conn, 'SELECT * FROM Personel WHERE Id = :userID');
        if (!$stid) {
            $e = oci_error($conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_bind_by_name($stid, ':userID', $userID);

        // Exécution de la logique de la requête
        $r = oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        // vérif pwd
    }
?>

<form action="#" method="POST">
    Numéro d'utilisateur: <input type="text" name="userID" required><br>
    Mot de passe : <input type="password" name="pwd" required>
    <button type="submit">Se connecter</button>
</form>

<!-- FIN DU CONTENU -->

<?php
    $content = ob_get_clean();
    $title = "Login";
    require('views/base.php');
?>