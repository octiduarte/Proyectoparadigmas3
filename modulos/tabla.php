<?php
//eliminar
if ($_GET['accion'] == 'guardar_eliminar') {
    $sql = "UPDATE ropas SET eliminado=1 WHERE id=" . $_GET['id'];
    $sql = mysqli_query($con, $sql);
    if (!mysqli_error($con))
        echo "<script> alert('Producto eliminado con exito');</script>";
    else
        echo "<script> alert('ERROR NO SE PUDO eliminar EL PRODUCTO);</script>";
}
?>



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
                    <td> <a href="index.php?modulo=procesar_disfraz&accion=editar&id=<?php echo $r['id']; ?>">Editar</a>
                        -
                        <a
                            href="index.php?modulo=tabla&accion=guardar_eliminar&id=<?php echo $r['id']; ?>">Eliminar</a>
                    </td>
                </tr>
                <tr>
                    <?php
            }
        }
        ?>
    </tbody>
</table>

<div class="org_registro">
    <form class="org_form_registro" form action="<?php echo $url; ?>" method="POST" enctype="multipart/form-data">
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