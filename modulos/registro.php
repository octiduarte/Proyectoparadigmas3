<?php
if (isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["clave"])) {
    //verifico que no exista el usuario
    $sql = "SELECT *FROM usuarios where correo = '" . $_POST['correo'] . "'";
    $sql = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql) != 0) {
        echo "<script> alert('EL USUARIO YA EXISTE EN LA BD');</script>";
    } else {
        //inserto nuevo usuario
        $rol = 'usuario';
        $sql = "INSERT INTO usuarios (nombre,correo,clave, rol) values ('" . $_POST['nombre'] . "','" . $_POST['correo'] . "','" . $_POST['clave'] . "','" . $rol . "')";
        $sql = mysqli_query($con, $sql);
        if (mysqli_error($con)) {
            echo "<script> alert('ERROR NO SE PUDO INSERTAR EL REGISTRO);</script>";
        } else {
            echo "<script> alert('Registro insertado con exito');</script>";
            echo "<script>window.location='index.php?modulo=iniciar_sesion';</script>";
        }
    }
}
?>

<div class="org_carga_form">
    <div>
        <h1>Registro</h1>
        <hr>
    </div>
    <div class="org_registro">
        <form class="org_form_registro" form action="index.php?modulo=registro" method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="correo" name="correo">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="clave" name="clave">
            </div>
            <button type="submit" class="btn btn-dark">Registrarse</button>
        </form>
    </div>
</div>