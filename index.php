<!DOCTYPE html>
<html lang="en">

<head>
  <title>Kurindacuaro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?>

    <div class="site-section">

      <div class="container">
        <h2>Conoce nuestras Galletas - ¡Elige tu favorita!</h2>
         <a href="./php/devextreme/formulario.php"><h2>Ir al nuevo</h2> </a>
        <div class="row mb-5">

          <div class="col-md-9 order-2">
            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="d-flex">

                  <!--
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                      <a class="dropdown-item" href="#">Men</a>
                      <a class="dropdown-item" href="#">Women</a>
                      <a class="dropdown-item" href="#">Children</a>
                    </div>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                      <a class="dropdown-item" href="#">Relevance</a>
                      <a class="dropdown-item" href="#">Name, A to Z</a>
                      <a class="dropdown-item" href="#">Name, Z to A</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Price, low to high</a>
                      <a class="dropdown-item" href="#">Price, high to low</a>
                    </div>
                    -->
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-5">

            <?php
            include('./php/conexion.php');

            $limite = 10;
            $totalQuery = $conexion->query('select count(*) from productos') or die($conexion->error);
            $totalProductos = mysqli_fetch_row($totalQuery);
            $totalBotones = round($totalProductos[0] / $limite);
            if (isset($_GET['limite'])) {
              $resultado = $conexion->query("select * from productos where id>0 limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
            } else {
              $resultado = $conexion->query("select * from productos where id>0 order by id ASC limit " . $limite) or die($conexion->error);
            }


            while ($fila = mysqli_fetch_array($resultado)) {
            ?>

              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id=<?php echo $fila['id']; ?>">
                      <img src="images/<?php echo $fila['imagen']; ?>" alt="<?php echo $fila['nombre']; ?>" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a></h3>
                    <p class="mb-0"> <abbr title="Contenido por Pedido" class="initialism"><?php echo $fila['empaque']; ?></abbr></p>
                    <p class="mb-0"><?php echo $fila['descripcion']; ?></p>
                    <p class="text-primary font-weight-bold">$<?php echo $fila['precio']; ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>



          </div>
          <div class="row" data-aos="fade-up">
            <div class="col-md-12 text-center">
              <div class="site-block-27">
                <ul>

                  <?php

                  if (isset($_GET['limite'])) {
                    if ($_GET['limite'] > 0) {
                      echo '<li><a href="index.php?limite=' . ($_GET['limite'] - 10) . '">&lt;</a></li>';
                    }
                  }
                  for ($k = 0; $k < $totalBotones; $k++) {
                    echo '<li><a href="index.php?limite=' . ($k * 10) . '">' . ($k + 1) . '</a></li>';
                  }
                  if (isset($_GET['limite'])) {
                    if ($_GET['limite'] + 10 < $totalBotones * 10) {
                      echo '<li><a href="index.php?limite=' . ($_GET['limite'] + 10) . '">&gt;</a></li>';
                    }
                  } else {
                    echo '<li><a href="index.php?limite=10">&gt;</a></li>';
                  }
                  ?>


                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- DIV HACIA LA IZQUIERDA DE LOS PRODUCTOS POR SI SE DESEA AGREGAR INFORMACION
          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <li class="mb-1"><a href="#" class="d-flex"><span></span> <span class="text-black ml-auto">(2,220)</span></a></li>
                <li class="mb-1"><a href="#" class="d-flex"><span></span> <span class="text-black ml-auto">(2,550)</span></a></li>
                <li class="mb-1"><a href="#" class="d-flex"><span></span> <span class="text-black ml-auto">(2,124)</span></a></li>
              </ul>
            </div>

          <div class="border p-4 rounded mb-4">
            <div class="mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
              <div id="slider-range" class="border-primary"></div>
              <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
            </div>

            <div class="mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
              <label for="s_sm" class="d-flex">
                <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
              </label>
              <label for="s_md" class="d-flex">
                <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
              </label>
              <label for="s_lg" class="d-flex">
                <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
              </label>
            </div>

            <div class="mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
              <a href="#" class="d-flex color-item align-items-center">
                <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red (2,429)</span>
              </a>
              <a href="#" class="d-flex color-item align-items-center">
                <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Green (2,298)</span>
              </a>
              <a href="#" class="d-flex color-item align-items-center">
                <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue (1,075)</span>
              </a>
              <a href="#" class="d-flex color-item align-items-center">
                <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Purple (1,075)</span>
              </a>
            </div>

          </div>
          -->
      </div>
    </div>

    

  </div>


  <?php include("./layouts/footer.php"); ?>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>