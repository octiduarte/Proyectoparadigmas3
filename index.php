<?php
session_start();
include('includes/conexion.php');
conectar();

if (!isset($_GET['accion']))
    $_GET['accion'] = '';

if ($_GET['accion'] == 'descontar') {
  $sql = "CALL descuento()";
  $resultado = mysqli_query($con, $sql);
  echo mysqli_error($con);
  // Manejar el resultado
  if ($resultado) {
      echo "<script> alert('Descuento aplicado');</script>";
  } else {
      echo "Error al llamar al stored procedure: " . mysqli_error($con);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Proyecto paradigmas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
</head>

<body>
  <header class="header_estilo">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand logo_carrito" href="index.php">Air.</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link logo_carrito" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link logo_carrito" href="#">Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link logo_carrito " href="index.php?modulo=box">Productos</a>
            </li>
            <?php
            if (!empty($_SESSION['nombre_usuario'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link logo_carrito" href="index.php?modulo=miscompras">Mis compras</a>
              </li>

              <a href="index.php?modulo=carrito">
                <img class="logo_carrito" src="imagenes/carrito/carrito.png" alt="" width="40px">
              </a>

            <?php
            }
            ?>
          </ul>
          <div class="org_botones_sesion">
            <?php
            if (!empty($_SESSION['nombre_usuario'])) {
            ?>


              <?php

              if ($_SESSION['roles'] == 'admin') {
              ?>

                <div class="separacion_botones_sesion logo_carrito">
                  <a href="index.php?modulo=carga" class="main_div_a_pink logo_carrito">ABM Productos</a>
                </div>
              <?php
              }
              ?>

              <div class="separacion_botones_sesion">
                <p>Bienvenido
                  <?php echo $_SESSION['nombre_usuario']; ?>
                </p>
              </div>
              <div class="separacion_botones_sesion logo_carrito">
                <a href="index.php?modulo=iniciar_sesion&salir=ok" class="nav_a logo_carrito">Cerrar Sesión</a>
              </div>
            <?php
            } else {
            ?>
              <a class="nav_a logo_carrito" href="index.php?modulo=registro">Registrarse</a>
              <a class="nav_a logo_carrito" href="index.php?modulo=iniciar_sesion">Iniciar Sesion</a>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main class="main_org">
    <?php

    if (!empty($_GET['modulo'])) {
      include('modulos/' . $_GET['modulo'] . '.php');
    } else {
    ?>
      <div id="popup" style="display: none">
        <div class="content-popup">
          <div>
            <div class="organizacion_popup">
              <div class="parte_izquierda_popup">
                <div class="close">
                  <a href="#" id="close">X</a>
                </div>
              </div>
              <div class="parte_derecha_popup">
                <h1>15% por tu primera compra</h1>
                <p class="p_popup">
                  Completa tu correo para recibir el regalo!
                </p>
                <div>
                  <div class="col-12 centrado_popup">
                    <input type="text" class="form-control mail_popup" id="inputAddress" placeholder="Correo electronico" />
                  </div>
                  <div class="col-12">
                    <a href="index.php?accion=descontar" class="btn btn-light confirmar_popup"> 
                    Confirmar</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="popup-overlay"></div>
      <div class="main_div_organizacion main_div_estilos">
        <div class="main_div_separacion">
          <h1 class="main_div_h1">
            Tu estilo, tu personalidad, tu e-comerce de ropa.
          </h1>
          <h4 class="main_div_h4">Viste con estilo, compra online.</h4>
        </div>
        <div class="botones_inicio">
          <a class="main_div_a main_div_a_yellow main_div_a-hover" href="index.php?modulo=box">Mostrar Productos</a>
        </div>
        <div id="carouselExampleInterval" class="carousel slide carrousel_org" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <img src="imagenes/CarrouselInicio/Remera.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="imagenes/CarrouselInicio/remera2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="imagenes/CarrouselInicio/remera3.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    <?php
    }

    ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script>
    $(document).ready(function() {
      // Establecer un tiempo de espera de 3 segundos (3000 milisegundos)
      setTimeout(function() {
        // Abrir el popup
        $("#popup").fadeIn("slow");
        $(".popup-overlay").fadeIn("slow");
        $(".popup-overlay").height($(window).height());
      }, 5000); // Fin del tiempo de espera

      // Cerrar el popup al hacer clic en el botón de cerrar
      $("#close, #conf").on("click", function() {
        $("#popup").fadeOut("slow");
        $(".popup-overlay").fadeOut("slow");
        return false;
      });
    });
  </script>
</body>

</html>