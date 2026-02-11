<?php
    ob_start();
?>

<!-- CONTENU DE LA PAGE -->

<?php
    session_start();
?>

<h1>My page</h1>



<!-- FIN DU CONTENU -->

<?php
    $content = ob_get_clean();
    $title = "My page";
    require('views/base.php');
?>