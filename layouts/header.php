<header class="site-navbar" role="banner">
  <div class="site-navbar-top">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
          <form action="./busqueda.php" class="site-block-top-search" method="GET">
            <span class="icon icon-search2"></span>
            <input type="text" class="form-control border-0" placeholder="Buscar" name="texto">
          </form>
        </div>

        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
          <img src="logokurinda.png" alt="Logo" width="50" height="50">
          <div class="site-logo">
            <a href="index.php" class="js-logo-clone"> Kurindacuaro en Línea ;) </a>

          </div>
        </div>
        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
          <div class="site-top-icons">
            <ul>
              <li><a href="#"><span class="icon icon-person"></span></a></li>
              <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
              <li>
                <a href="cart.php" class="site-cart">
                  <span class="icon icon-shopping_cart"></span>
                  <span class="count">
                    <?php
                    if (isset($_SESSION['carrito'])) {
                      echo count($_SESSION['carrito']);
                    } else {
                      echo 0;
                    }


                    ?>
                  </span>
                </a>
              </li>
              <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
      <h2>Bienvenido: Aquí puedes hacer tus Compras</h2>
    </div>
  </nav>
</header>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <h4>
          <center>
            <a href="index.php">IR AL INICIO</a>
          </center>
        </h4>
      </div>
    </div>
  </div>
</div>