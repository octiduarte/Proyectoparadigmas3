<?php
function conectar() {
    $host = "shinkansen.proxy.rlwy.net";
    $user = "root";
    $pass = "bsXbcSPYBxRtqnySclAwXFOyqGsdhfdU";
    $dbname = "railway";
    $con = mysqli_connect($host, $user, $pass, $dbname);

    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $con;
}
?>
