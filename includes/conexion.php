<?php
function conectar() {
    $url = getenv('MYSQL_PUBLIC_URL'); // Usamos la URL pública de Railway

    // Parsea la URL para obtener los datos de conexión
    $db_parts = parse_url($url);

    $host = $db_parts['mysql.railway.internal']; // Host de la base de datos
    $user = $db_parts['root']; // Usuario de la base de datos
    $pass = $db_parts['bsXbcSPYBxRtqnySclAwXFOyqGsdhfdU']; // Contraseña
    $db = ltrim($db_parts['railway'], '/'); // Nombre de la base de datos
    $port = $db_parts['3306']; // Puerto

    $con = mysqli_connect($host, $user, $pass, $db, $port);

    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $con;
}
?>
