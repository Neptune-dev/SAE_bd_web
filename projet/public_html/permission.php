<?php

function gotAdminPermission ($uType):bool {
    return ($uType == "ADMIN") ? true : false;
}

function gotDirectorPermission ($uType):bool {
    if (in_array($uType, array("DIRECTEUR")) || gotAdminPermission($uType)) {
        return true;
    }
    return false;
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

function gotChefPermission ($uType):bool {
    if (in_array($uType, array("CHEF")) || gotAdminPermission($uType)) {
        return true;
    }
    return false;
}
?>