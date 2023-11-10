<?php
$sql = "SELECT *FROM ropas";
$sql = mysqli_query($con, $sql);
if (mysqli_num_rows($sql) != 0) {
    while ($r = mysqli_fetch_array($sql)) {
        ?>
        <div class="org_boxes">
            <div class="org_box">
                <p><img src="imagenes/<?php echo $r['foto']; ?>" alt="" width="100%"></p>
                <div>
                    <h2>
                        <?php echo $r['nombre']; ?>
                    </h2>
                    <hr>
                    <p>
                        <?php echo $r['descripcion']; ?>
                    </p>
                    <h3>
                        <?php echo $r['precio']; ?>
                    </h3>
                </div>
            </div>
        </div>
        <?php
    }
}
?>