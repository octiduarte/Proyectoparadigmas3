<?php
function conectar() {
    $host = "mysql.railway.internal";
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
