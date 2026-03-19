<?php

function gotAdminPermission ($uType):bool {
    return ($uType == "ADMIN") ? true : false;
}

function gotTeamPermission ($uType):bool {
    if (!in_array($uType, array("DIRECTEUR")) || gotAdminPermission($uType)) {
        return true;
    }
    return false;
}

function gotAnimalPermission ($uType):bool {
    if (in_array($uType, array("SOIGNEUR", "VETERINAIRE")) || gotAdminPermission($uType)) {
        return true;
    }
    return false;
}

function gotTestPermission ($uType):bool {
    if (in_array($uType, array("CHEF", "TECHNICIEN", "DIRECTEUR")) || gotAdminPermission($uType)) {
        return true;
    }
    return false;
}

?>