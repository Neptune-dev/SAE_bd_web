<?php
session_start();

// Vérification
$connected = isset($_SESSION["user"]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Check session</title>

    <!-- redirection après 10 secondes -->
    <meta http-equiv="refresh" content="10;url=logout.php">
</head>
<body>

<?php if ($connected): ?>
    <h1>OK</h1>
<?php else: ?>
    <h1>NON</h1>
<?php endif; ?>

<p>Redirection vers login dans 10 secondes...</p>

<?php
// destruction de la session user
unset($_SESSION['user']);
?>

</body>
</html>