<?php
if (!isset($_GET['accion']))
$_GET['accion'] = '';


$sql = "SELECT *FROM ropas WHERE eliminado =0";
$sql = mysqli_query($con, $sql);
if (mysqli_num_rows($sql) != 0) {
    while ($r = mysqli_fetch_array($sql)) {
        ?>
        <div class="org_boxes">
            <div class="org_box">
                <p><img src="imagenes/<?php echo $r['foto']; ?>" alt="" width="100%"></p>
                <div class="org_box_separacion">
                    <h1>
                        <?php echo $r['nombre']; ?>
                        <hr>
                    </h1>
                    <p>
                        <?php echo $r['descripcion']; ?>
                    </p>
                    <h3>
                        <?php echo $r['precio']; ?>$
                    </h3>
                    <div class="org_a_box">
                        <a class="nav_a" href="index.php?modulo=producto&accion=ver_ficha&id=<?php echo $r['id']; ?>">Ver</a>
                        <?php
                        if (!empty($_SESSION['nombre_usuario'])) {
                            ?>
                            <form action="index.php?modulo=box&accion=agregar_carrito&id=<?php echo $r['id']; ?>" method="post">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" value="1" min="1">
                                <input class="nav_a" type="submit" value="Agregar al carrito">
                            </form>
                            <?php
                        }
                        ?>
                    </div>

                </div>

            </div>
            <hr style="border: 2px solid black">
        </div>
        <?php
    }
}

//cargar producto al carrito
if ($_GET['accion'] == 'agregar_carrito') {
    //inserto nuevo producto en carrito
    $usuario_id = $_SESSION['id'];
    $id_producto=  $_GET['id'];
    $cantidad = $_POST['cantidad'];
   
    $sql = "INSERT INTO carrito (usuario_id, producto_id,cantidad) VALUES ($usuario_id, $id_producto , $cantidad)";
    $sql = mysqli_query($con, $sql);
    if (mysqli_error($con)) {
        echo "<script> alert('ERROR NO SE PUDO INSERTAR EL PRODUCTO EN EL CARRITO);</script>";
    } else {
        echo "<script> alert('Producto cargado en el carrito con exito');</script>";
    }
}
?>