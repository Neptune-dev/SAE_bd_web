<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Vérifie que le formulaire a bien été envoyé en POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit();
}

require_once('db.php');

// Récupération et nettoyage simple
$rfid = $_POST['RFID'];
$nom = $_POST['nom_animal'];
$prenom = $_POST['prenom_animal'];
$espece = $_POST['espece_animal'];
$regime = $_POST['regime_animal'];

// Vérification des champs
if ($rfid === '' || $nom === '' || $prenom === '' || $espece === '' || $_POST['jour'] === '' || $_POST['mois'] === '' || $_POST['annee'] === '') {
    die("Tous les champs sont obligatoires.");
}

$sql="INSERT INTO individu(RFID_individu) VALUES (:rfid)";

db_exec($sql,[':rfid'=>$rfid]);

// Requête d'insertion
$sql = "INSERT INTO animal (RFID_animal, nom_animal, prenom_animal, espece_animal, regime_animal, date_de_naissance_animal) VALUES (:rfid, :nom, :prenom, :espece, :regime, TO_DATE(:date_naissance,'YYYY-MM-DD'))";
$date_naissance=$_POST['annee'] . '-' . $_POST['mois'] . '-' . $_POST['jour'];
$params = [
    ':rfid' => $rfid,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':espece' => $espece,
    ':regime' => $regime,
    ':date_naissance' => $date_naissance
];

// Exécution
db_exec($sql, $params);

// Redirection après succès
header("Location: dashboard.php");
exit();
?>