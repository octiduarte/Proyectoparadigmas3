<?php
function conectar()
{
    global $con;
    
    $host = "trolley.proxy.rlwy.net"; // Usa el host público de Railway
    $user = "root"; // Usuario de Railway
    $pass = "SWrZBkuPenTQpMTYEvPPVNzJfzZPhEpr"; // Pon la contraseña que aparece en Railway
    $db   = "railway"; // Nombre de la base de datos
    $port = 56502; // Puerto de Railway

    $con = mysqli_connect($host, $user, $pass, $db, $port);

    if (!$con) {
        printf("Fallo la conexión: %s\n", mysqli_connect_error());
        exit();
    } else {
        $con->set_charset("utf8");
        return true;
    }
}

function desconectar()
{
    global $con;
    if ($con) {
        mysqli_close($con);
    }
}
?>
