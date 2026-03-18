<?php

function gotAdminPermission ($uType):bool {
    return ($uType == "ADMIN") ? true : false;
}

function gotTeamPermission ($uType):bool {
    if (!in_array($uType, array("ADMIN", "DIRECTEUR"))) {
        return true;
    }
    return false;
}

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