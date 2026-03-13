<?php

function gotAnimalPermission ($uType):bool {
    if (in_array($uType, array("ADMIN", "SOIGNEUR", "VETERINAIRE"))) {
        return true;
    }
    return false;
}

function gotTestPermission ($uType):bool {
    if (in_array($uType, array("ADMIN", "CHEF", "TECHNICIEN", "DIRECTEUR"))) {
        return true;
    }
    return false;
}
?>