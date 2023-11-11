<?php
if (!isset($_GET['accion'])) {
    $_GET['accion'] = '';
}
if ($_GET['accion'] == 'eliminar_carrito') {
    //eliminar producto del carrito
    if (isset($_GET['id'])) {
        $usuario_id = $_SESSION['id'];
        $id_producto = $_GET['id'];
        $sql = "DELETE FROM carrito WHERE usuario_id = '$usuario_id' AND producto_id = '$id_producto'";
        $sql = mysqli_query($con, $sql);
        if (mysqli_error($con)) {
            echo "<script> alert('ERROR NO SE PUDO ELIMINAR PRODUCTO DEL CARRITO);</script>";
        } else {
            echo "<script> alert('Producto eliminado del carrito con exito');</script>";
        }
    }
}


?>

<div class="org_carga_form org_carrito">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio Unitario</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $usuario_id = $_SESSION['id'];
            $sql = "SELECT c.producto_id, p.nombre, p.precio, c.cantidad FROM carrito c JOIN ropas p ON c.producto_id = p.id WHERE c.usuario_id = '$usuario_id' AND eliminado = 0";
            $sql = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql) != 0) {
                while ($r = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $r['producto_id']; ?>
                        </th>
                        <td>
                            <?php echo $r['nombre']; ?>
                        </td>
                        <td>
                            <?php echo $r['precio']; ?>$
                        </td>
                        <td>
                            <?php echo $r['cantidad']; ?>
                        </td>
                        <td>

                            <a
                                href="javascript:if(confirm('Desea eliminar el producto del carrito?')) window.location='index.php?modulo=carrito&accion=eliminar_carrito&id=<?php echo $r['producto_id']; ?>'">Eliminar</a>
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
        <a class="nav_a"
            href="index.php?modulo=formulario&id=<?php echo $usuario_id; ?>">Continuar</a>
    </div>
</div>