<?php
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
$nom = trim($_POST['nom_animal'] ?? '');
$prenom = trim($_POST['prenom_animal'] ?? '');
$espece = trim($_POST['espece_animal'] ?? '');

// Vérification des champs
if ($rfid === '' || $nom === '' || $prenom === '' || $espece === '') {
    die("Tous les champs sont obligatoires.");
}

$sql="INSERT INTO individu(RFID_individu) VALUES (:rfid)";

db_exec($sql,[':rfid'=>$rfid]);

// Requête d'insertion
$sql = "INSERT INTO animal (RFID_animal, nom_animal, prenom_animal, espece_animal, regime_animal) VALUES (:rfid, :nom, :prenom, :espece, :regime)";

$params = [
    ':rfid' => $rfid,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':espece' => $espece,
    ':regime' => 'REG00001'
];

// Exécution
db_exec($sql, $params);

// Redirection après succès
header("Location: dashboard.php");
exit();
?>