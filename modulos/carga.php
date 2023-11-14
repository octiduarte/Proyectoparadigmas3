<?php
if (!isset($_GET['accion']))
    $_GET['accion'] = '';

//insertar

if ($_GET['accion'] == 'guardar_insertar') {
    //verifico que no exista el producto
    $sql = "SELECT *FROM ropas where nombre = '" . $_POST['nombre'] . "'";
    $sql = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql) != 0) {
        echo "<script> alert('EL PRODUCTO YA EXISTE EN LA BD');</script>";
    } else {

        //procesar la foto
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

            //copiar en un directorio
            $nombre = explode('.', $_FILES['foto']['name']);
            $foto = time() . '.' . end($nombre);
            copy($_FILES['foto']['tmp_name'], 'imagenes/' . $foto);
        }
        //fin de procesar la foto


        //inserto nuevo producto
        $sql = "INSERT INTO ropas (nombre,descripcion, precio,foto) values ('" . $_POST['nombre'] . "','" . $_POST['descripcion'] . "','" . $_POST['precio'] . "','" . $foto . "')";
        $sql = mysqli_query($con, $sql);
        if (mysqli_error($con)) {
            echo "<script> alert('ERROR NO SE PUDO INSERTAR EL PRODUCTO);</script>";
        } else {
            echo "<script> alert('Producto cargado con exito');</script>";
        }
    }
}

//editar 
if ($_GET['accion'] == 'guardar_editar') {

    //controlo si tengo que editar la foto
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        //copiar en un directorio
        $nombre = explode('.', $_FILES['foto']['name']);
        $foto = time() . '.' . end($nombre);
        copy($_FILES['foto']['tmp_name'], 'imagenes/' . $foto);

        //armo la cadena para editar las fotos
        $mas_datos = ", foto='" . $foto . "'";
    } else {
        $mas_datos = '';
    }

    $sql = "UPDATE ropas SET nombre='{$_POST['nombre']}', descripcion='{$_POST['descripcion']}', precio='{$_POST['precio']}' {$mas_datos}  WHERE id=" . $_GET['id'];
    $sql = mysqli_query($con, $sql);
    if (!mysqli_error($con))
        echo "<script> alert('ROPA editada con exito');</script>";
    else
        echo "<script> alert('ERROR NO SE PUDO editar el producto);</script>";
}


//eliminar

if ($_GET['accion'] == 'guardar_eliminar') {
    if (isset($_GET['id'])) {
        $sql = "UPDATE ropas SET eliminado=1 WHERE id=" . $_GET['id'];
        $sql = mysqli_query($con, $sql);
        if (!mysqli_error($con))
            echo "<script> alert('ROPA eliminada con exito');</script>";
        else
            echo "<script> alert('ERROR NO SE PUDO eliminar la ropa);</script>";
    }
}

//store procedure 10% aumento
if ($_GET['accion'] == 'actualizar') {
    $sql = "CALL actualizar_precios()";
    $resultado = mysqli_query($con, $sql);

    // Manejar el resultado
    if ($resultado) {
        echo "<script> alert('Productos aumentados 10% con exito');</script>";
    } else {
        echo "Error al llamar al stored procedure: " . mysqli_error($con);
    }
}
?>


<div class="org_carga_form">
    <div>
        <h1>Carga de Productos</h1>
        <hr>
    </div>
    <div class="org_registro">
        <?php
        if ($_GET['accion'] == 'editar') {
            $url = 'index.php?modulo=carga&accion=guardar_editar&id=' . $_GET['id'];
            $sql = "SELECT *FROM ropas WHERE id = " . $_GET['id'];
            $sql = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql) != 0) {
                $r = mysqli_fetch_array($sql);
            }
        } else {
            $url = 'index.php?modulo=carga&accion=guardar_insertar';
            $r['nombre'] = $r['descripcion'] = $r['precio'] = $r['foto'] = '';
        }
        ?>
        <form class="org_form_registro" form action="<?php echo $url; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $r['nombre']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $r['descripcion']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $r['precio']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <?php
                if (!empty($r['foto'])) {
                ?>
                    <img src="imagenes/<?php echo $r['foto']; ?>" width="50%">
                <?php
                }
                ?>
            </div>
            <button type="submit" class="btn btn-dark">Cargar</button>
        </form>
    </div>
</div>

<div class="org_carga_tabla">
    <div>
        <h1>Productos cargados</h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id, nombre,precio FROM ropas where eliminado = 0 ORDER BY id";
            $sql = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql) != 0) {
                while ($r = mysqli_fetch_array($sql)) {
            ?>
                    <tr>
                        <th scope="row">
                            <?php echo $r['id']; ?>
                        </th>
                        <td>
                            <?php echo $r['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $r['precio']; ?>$
                        </td>
                        <td> <a href="index.php?modulo=carga&accion=editar&id=<?php echo $r['id']; ?>">Editar</a>
                            -
                            <a href="javascript:if(confirm('Desea eliminar el registro?')) window.location='index.php?modulo=carga&accion=guardar_eliminar&id=<?php echo $r['id']; ?>'">Eliminar</a>
                        </td>
                    </tr>
                    <tr>
                <?php
                }
            }
                ?>
        </tbody>
    </table>
    <div>
        <a class="nav_a" href="index.php?modulo=carga&accion=actualizar">Actualizar 10% todos los productos</a>
    </div>
</div>