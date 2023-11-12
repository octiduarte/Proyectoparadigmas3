<div class="org_ficha">
    <?php
    if ($_GET['accion'] == 'ver_ficha') {
        $url = 'index.php?modulo=producto&accion=ver_fichar&id=' . $_GET['id'];
        $sql = "SELECT *FROM ropas WHERE id = " . $_GET['id'];
        $sql = mysqli_query($con, $sql);
        if (mysqli_num_rows($sql) != 0) {
            $r = mysqli_fetch_array($sql);
        }
    }
    ?>
    <div class="org_ficha_unidad">
        <img src="imagenes/<?php echo $r['foto']; ?>" alt="" width="100%">
        <div class="org_ficha_separacion">
            <h1>
                <?php echo $r['nombre']; ?>
            </h1>
            <hr>

            <p>
                <?php echo $r['descripcion']; ?>
            </p>
            <h4>
                <?php echo $r['precio']; ?>$
            </h4>
            <a href="">Ver medios de pago</a>
            <p>Llega entre el jueves y el martes 21 de noviembre por 2574,99$ Antes: 2879,99$</p>
            <a href="">Mas formas de entrega</a>
            <strong>Stock disponible</strong>
            <a href="">Devolucion gratis</a>
            <p>Tenes 30 dias desde que lo recibis</p>
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
    <?php
    ?>
</div>