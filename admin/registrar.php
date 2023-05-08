<?php 
session_start();

include "../php/conexion.php";
if(!isset($_SESSION['datos_login'])){
  header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];

if($arregloUsuario['nivel'] != 'admin'){
  header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include "./layouts/header.php"; ?>
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agregar distribuidores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa fa-plus"></i> Insertar nuevo
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agregar Tiendas de conveniencia</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
              <i class="fa fa-plus"></i> Insertar nuevo 
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


  </div>

    <!-- Modal Distribuidores-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../php/insertar_usuario.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresa Distribuidor</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="correod">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrad">
            </div>
            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombred">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudadd">
            </div>
            <div class="col-md-8">
                <label for="inputState" class="form-label">Estado</label>
                <select class="custom-select" id="estadod">
                <option selected>Open this select menu</option>
                <option>Aguascalientes</option>
                <option>Baja California</option>
                <option>Baja California Sur</option>
                <option>Campeche</option>
                <option>Chiapas</option>
                <option>Chihuahua</option>
                <option>Ciudad de México</option>
                <option>Coahuila</option>
                <option>Colima</option>
                <option>Durango</option>
                <option>Estado de México</option>
                <option>Guanajuato</option>
                <option>Guerrero</option>
                <option>Hidalgo</option>
                <option>Jalisco</option>
                <option>Michoacán</option>
                <option>Morelos</option>
                <option>Nayarit</option>
                <option>Nuevo León</option>
                <option>Oaxaca</option>
                <option>Puebla</option>
                <option>Querétaro</option>
                <option>Quintana Roo</option>
                <option>San Luis Potosí</option>
                <option>Sinaloa </option>
                <option>Sonora</option>
                <option>Tabasco</option>
                <option>Tamaulipas</option>
                <option>Tlaxcala</option>
                <option>Veracruz</option>
                <option>Yucatán</option>
                <option>Zacatecas</option>
                </select>
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">CURP</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="curpd" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="col-md-8">
                <label for="inputCity" class="form-label">RFC</label>
                <input type="text" class="form-control" id="rfcd">
            </div>  
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Constancia de situacion fiscal</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="constanciad" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Fecha de inicio como cliente</label>
                <input type="date" class="form-control" id="fechad">
            </div>
            <div class="col-md-8">
                <label for="inputCity" class="form-label">Domicilio de entrega del producto</label>
                <input type="text" class="form-control" id="domiciliod">
            </div>
            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Nombre de la empresa de distribucion</label>
                <input type="text" class="form-control" id="distribuciond">
            </div>
            <div class="col-md-8">
                <label for="inputCity" class="form-label">Zona de influencia de distribución</label>
                <input type="text" class="form-control" id="zonad">
            </div>
            <div class="col-md-8">
                <label for="inputCity" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="usuario">
            </div>
        </div>
      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="submit">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Modal Tiendas-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../php/insertar_producto.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresa Tienda</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Nombre de la tienda</label>
                <input type="text" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">RFC</label>
                <input type="text" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Constancia de situacion fiscal</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="col-md-8">
                <label for="inputEmail4" class="form-label">Fecha de inicio como cliente</label>
                <input type="date" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Cedis</label>
                <input type="text" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-8">
                <label for="inputPassword4" class="form-label">Domicilio de entrega</label>
                <input type="text" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-8">
                <label for="inputCity" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="usuario">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>


<!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./dashboard/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./dashboard/plugins/moment/moment.min.js"></script>
<script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>