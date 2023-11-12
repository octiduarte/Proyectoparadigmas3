<?php
if (!isset($_GET['accion'])) {
    $_GET['accion'] = '';
}
if ($_GET['accion'] == 'form') {
    ?>
    <form class="row g-3" form action="index.php?modulo=formulario&accion=cargar_direccion" method="POST">
        <div class="col-12">
            <label for="inputAddress" class="form-label">Direccion</label>
            <input type="text" class="form-control" name="direccion" id="direccion" required />
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" required />
        </div>
        <div class="col-md-4">
            <label for="inputCity" class="form-label">Pais</label>
            <input type="text" class="form-control" id="pais" name="pais" required />
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-dark">Cargar Direccion</button>
        </div>
    </form>
    <?php
}
if ($_GET['accion'] == 'cargar_direccion') {
    ?>
    <form class="row g-3" form action="index.php?modulo=formulario&accion=cargar_tarjeta" method="POST">
        <div class="col-6">
            <label for="inputAddress" class="form-label">Tarjeta</label>
            <input type="number" class="form-control" name="tarjeta" id="tarjeta" required />
        </div>
        <div class="col-md-2">
            <label for="inputCity" class="form-label">Codigo</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required />
        </div>
        <div class="col-md-2">
            <label for="inputCity" class="form-label">Mastercard/Visa</label>
            <input type="text" class="form-control" id="metodo" name="metodo" required />
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-dark">Cargar tarjeta</button>
        </div>
    </form>
    <?php
}
if ($_GET['accion'] == 'cargar_tarjeta') {
    ?>
    <div style="text-align:center; padding-top:3rem;">
        <a class="btn btn-danger" href="index.php?modulo=formulario&accion=confirmar_compra">Confirmar Compra</a>
    </div>
    <?php
}
?>
<?php

if ($_GET['accion'] == 'cargar_tarjeta') {
    //CARGAR TARJETA

    $usuario_id = $_SESSION['id'];
    $tarjeta = $_POST['tarjeta'];
    $codigo = $_POST['codigo'];
    $metodo = $_POST['metodo'];
    $sql = "INSERT INTO pagos (id_usuario, tarjeta, codigo, metodo) VALUES ('$usuario_id', '$tarjeta', '$codigo', '$metodo')";
    $sql = mysqli_query($con, $sql);
    if (mysqli_error($con)) {
        echo "<script> alert('Tarjeta no cargada');</script>";
    } else {
        echo "<script> alert('Tarjeta cargada con exito');</script>";
    }
}


if ($_GET['accion'] == 'cargar_direccion') {
    //CARGAR DIRECCION

    $usuario_id = $_SESSION['id'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $sql = "INSERT INTO direcciones (usuario_id, direccion, ciudad, pais) VALUES ('$usuario_id', '$direccion', '$ciudad', '$pais')";
    $sql = mysqli_query($con, $sql);
    if (mysqli_error($con)) {
        echo "<script> alert('ERROR NO SE PUDO ELIMINAR PRODUCTO DEL CARRITO);</script>";
    } else {
        echo "<script> alert('Direccion guardada con exito');</script>";
    }
}


if ($_GET['accion'] == 'confirmar_compra') {
    $usuario_id = $_SESSION['id'];
    $sql = "INSERT INTO compras (usuario_id, total) VALUES ('$usuario_id', 0)";
    $sql = mysqli_query($con, $sql);
    $id_compra = mysqli_insert_id($con);
    // Calcular el total del carrito directamente en la base de datos

    // Inicializar el total de la compra
    $total_compra = 0;

    // Obtener los productos del carrito para el usuario actual
    $sql_carrito = "SELECT producto_id, cantidad FROM carrito WHERE usuario_id = '$usuario_id'";
    $resultado_carrito = mysqli_query($con, $sql_carrito);

    if ($resultado_carrito) {
        while ($fila_carrito = mysqli_fetch_assoc($resultado_carrito)) {
            $producto_id = $fila_carrito['producto_id'];
            $cantidad = $fila_carrito['cantidad'];

            // Obtener el precio del producto desde la tabla 'ropas'
            $sql_precio = "SELECT precio FROM ropas WHERE id = '$producto_id'";
            $resultado_precio = mysqli_query($con, $sql_precio);

            if ($resultado_precio && $fila_precio = mysqli_fetch_assoc($resultado_precio)) {
                // Calcular el subtotal y agregar al total de la compra
                $precio_unitario = $fila_precio['precio'];
                $subtotal = $precio_unitario * $cantidad;
                $total_compra += $subtotal;

                // Crear un registro en la tabla 'detalle_compra' para cada producto
                $sql_detalle = "INSERT INTO detalle_compra (compras_id, producto_id, cantidad, precio_unitario) VALUES ('$id_compra', '$producto_id', '$cantidad', '$precio_unitario')";
                $resultado_detalle = mysqli_query($con, $sql_detalle);


            }
        }

        // Actualizar el total de la compra en la tabla 'compras'
        $sql_actualizar_total = "UPDATE compras SET total = '$total_compra' WHERE id = '$id_compra'";
        $resultado_actualizar_total = mysqli_query($con, $sql_actualizar_total);

        if ($resultado_actualizar_total) {
            $sql_limpiar_carrito = "DELETE FROM carrito WHERE usuario_id = '$usuario_id'";
            mysqli_query($con, $sql_limpiar_carrito);
            echo "<script> alert('COMPRA REALIZADA! MUCHAS GRACIAS!');</script>";
        }
    }
}


?>