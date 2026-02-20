<?php
    // on ferme et detruit la session
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
?>