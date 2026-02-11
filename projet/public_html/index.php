<?php
ob_start();
?>

<h1>Coucou Test</h1>

<?php
$content = ob_get_clean();
$title = "Home";
require('./views/base.php');
?>