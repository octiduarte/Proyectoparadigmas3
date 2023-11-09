<?php
if (isset($_GET['salir'])) {
    session_destroy();
    echo "<script>window.location='index.php';</script>";
}
if (isset($_POST['correo']) && isset($_POST['clave'])) {
    $sql = "SELECT * FROM usuarios WHERE correo = '" . $_POST['correo'] . "' AND clave='" . $_POST['clave'] . "'";
    $sql = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql) != 0) {
        $r = mysqli_fetch_array($sql);
        $_SESSION['id'] = $r['id'];
        $_SESSION['nombre_usuario'] = $r['correo'];
        $_SESSION['roles'] = $r['rol'];
        echo "<script> alert ('Bienvenido: " . $_SESSION['nombre_usuario'] . "');</script>";
        //crear la sesion
    } else {
        echo "<script> alert('Verifique los datos.');</script>";
    }
    if ($_SESSION['roles'] != 'admin') {
    echo "<script>window.location='index.php';</script>";
    }
    else{
        echo "<script>window.location='index.php?modulo=carga';</script>";
    }
}
?>


<div>
    <h1>Iniciar Sesion</h1>
    <hr>
</div>
<div class="org_registro">
    <form class="org_form_registro" action="index.php?modulo=iniciar_sesion" method="POST">
        <div class="mb-3">
            <label class="form-label">Correo electronico</label>
            <input type="email" class="form-control" id="correo" name="correo">
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave">
        </div>
        <button type="submit" class="btn btn-dark">Loguearse</button>
    </form>
</div>