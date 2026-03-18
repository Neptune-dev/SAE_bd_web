<?php

function gotAdminPermission ($utype):bool {
    return ($utype == "ADMIN") ? true : false;
}

function gotTeamPermission ($utype):bool {
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