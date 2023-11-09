<?php
if (isset($_POST["nombre"]) && isset($_POST["descripcion"])) {
    //verifico que no exista el producto
    $sql = "SELECT *FROM ropas where nombre = '" . $_POST['nombre'] . "'";
    $sql = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql) != 0) {
        echo "<script> alert('EL PRODUCTO YA EXISTE EN LA BD');</script>";
    } else {
        
        //procesar la foto
        if(is_uploaded_file($_FILES['foto']['tmp_name']))
        {
            $nombre = explode('.', $_FILES['foto']['name']);
            $foto = time() .'.'.end($nombre);
            copy($_FILES['foto']['tmp_name'],'imagenes/'.$foto);
        }
        //fin de procesar la foto


        //inserto nuevo disfraz
        $sql = "INSERT INTO ropas (nombre,descripcion, precio,foto) values ('" . $_POST['nombre']."','" . $_POST['descripcion']."','" . $_POST['precio']."','".$foto."')";
        $sql = mysqli_query($con, $sql);
        if (mysqli_error($con)) {
            echo "<script> alert('ERROR NO SE PUDO INSERTAR EL DISFRAZ);</script>";
        } else {
            echo "<script> alert('Disfraz cargado con exito');</script>";
        }
    }
}
?>


<div>
    <h1>Carga de Productos</h1>
    <hr>
</div>
<div class="org_registro">
    <form class="org_form_registro" form action="index.php?modulo=carga" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion">
        </div>
        <div class="mb-3">
            <label  class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio">
        </div>
        <div class="mb-3">
            <label  class="form-label">foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <button type="submit" class="btn btn-dark">Cargar</button>
    </form>
</div>