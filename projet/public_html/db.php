<?php
// db.php
require_once 'myparam.inc.php';

function db_conn() {
    static $conn = null;
    if ($conn) return $conn;

    $conn = oci_connect(MYUSER, MYPASS, MYHOST);
    if (!$conn) {
        $e = oci_error();
        die("Oracle connect error: " . htmlentities($e['message'], ENT_QUOTES));
    }
    return $conn;
}

/**
 * Exécute une requête et retourne toutes les lignes (tableau de tableaux associatifs)
 * $params = [':id' => $id, ':login' => $login, ...]
 */
function db_all(string $sql, array $params = []): array {
    $conn = db_conn();
    $stid = oci_parse($conn, $sql);
    if (!$stid) {
        $e = oci_error($conn);
        die("Parse error: " . htmlentities($e['message'], ENT_QUOTES));
    }

    foreach ($params as $key => $val) {
        // clé au format ':id'
        oci_bind_by_name($stid, $key, $params[$key]);
    }

    $r = oci_execute($stid);
    if (!$r) {
        $e = oci_error($stid);
        die("Execute error: " . htmlentities($e['message'], ENT_QUOTES));
    }

    $rows = [];
    while ($row = oci_fetch_assoc($stid)) {
        $rows[] = $row; // clés en MAJUSCULES
    }
    oci_free_statement($stid);

    return $rows;
}

/** Retourne une seule ligne (ou null si rien) */
function db_one(string $sql, array $params = []): ?array {
    $rows = db_all($sql, $params);
    return $rows[0] ?? null;
}

/**
 * INSERT/UPDATE/DELETE, avec commit auto si succès.
 * Retourne true/false.
 */
function db_exec(string $sql, array $params = []): bool {
    $conn = db_conn();
    $stid = oci_parse($conn, $sql);
    if (!$stid) {
        $e = oci_error($conn);
        die("Parse error: " . htmlentities($e['message'], ENT_QUOTES));
    }

    foreach ($params as $key => $val) {
        oci_bind_by_name($stid, $key, $params[$key]);
    }

    $ok = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);
    if (!$ok) {
        $e = oci_error($stid);
        die("Execute error: " . htmlentities($e['message'], ENT_QUOTES));
    }

    oci_free_statement($stid);
    return true;
}