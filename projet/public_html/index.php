<?php
    ob_start();
?>

<!-- CONTENU DE LA PAGE -->

<?php
    session_start();
?>

<h1>Coucou Test</h1>

<!-- FIN DU CONTENU -->

<?php
    $content = ob_get_clean();
    $title = "Home";
    require('views/base.php');
?>