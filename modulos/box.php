<?php
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
                    <div class= "org_a_box">
                        <a class="nav_a" href="index.php?modulo=producto&accion=ver_ficha&id=<?php echo $r['id']; ?>">Ver</a>
                        <?php
                        if (!empty($_SESSION['nombre_usuario'])) {
                        ?>
                        <a class="nav_a" href="">Agregar a carrito</a>
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
?>