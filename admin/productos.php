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
$resultado = $conexion->query("select productos.*, categorias.nombre as cat from productos 
inner join categorias on productos.id_categoria = categorias.id order by id DESC")or die($conexion->error);

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

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="./dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa fa-plus"></i> Insertar Producto
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        if(isset($_GET['error'])){
        ?>
        
        <div class="alert alert-danger" role="alert">
        <?php echo $_GET['error']; ?>
        </div>

        <?php } ?>

        <?php
        if(isset($_GET['success'])){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Agregado Correctamente</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
     

        <table class="table">
          <thead>
              <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Inventario</th>
              <th>Tipo Caja</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              
            <?php 
              while ($f = mysqli_fetch_array($resultado)) {
              ?> 
              <tr>        
              <td><?php echo $f['id'];?></td>
              <td>
              <img src="../images/<?php echo $f['imagen']; ?>" width="20px"  height="20px" alt="">  
              <?php echo $f['nombre'];?></td>
              <td><?php echo $f['descripcion'];?></td>
              <td><?php echo $f['inventario'];?></td>
              <td><?php echo $f['cat'];?> </td>
              <td>
              <button class="btn btn-primary btn-small btnEditar" 
                data-id="<?php echo $f['id']; ?>"
                data-nombre="<?php echo $f['nombre']; ?>"
                data-descripcion="<?php echo $f['descripcion']; ?>"
                data-precio="<?php echo $f['precio']; ?>"
                data-inventario="<?php echo $f['inventario']; ?>"
                data-categoria="<?php echo $f['id_categoria']; ?>"
                data-talla="<?php echo $f['talla']; ?>"
                data-color="<?php echo $f['color']; ?>"

                data-bs-toggle="modal" data-bs-target="#modalEditar">
                  <i class="fa fa-edit"></i>
              </button>
                <button class="btn btn-danger btn-small btnEliminar" 
                data-id="<?php echo $f['id']; ?>"
                data-bs-toggle="modal" data-bs-target="#modalEliminar">
                  <i class="fa fa-trash"></i>
              </button>
            </td>
            </tr>
            <?php } ?>
 
          </tbody>

        </table>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../php/insertar_producto.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresa Producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" placeholder="descripcion" id="descripcion" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="img">Imagen</label>
            <input type="file" name="img" placeholder="img" id="img" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" min="0" name="precio" placeholder="precio" id="precio" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="inventario">Inventario</label>
            <input type="number" name="inventario" placeholder="inventario" id="inventario" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="categoria">CATEGORIA</label>
            <select name="categoria" id="categoria" class="form-control" requiere>
              <?php
              $res = $conexion->query("select * from categorias")or die($conexion->error);
              while ($f = mysqli_fetch_array($res)) {
                echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
              }
              ?>
            </select>
            </div>

          <div class="form-group">
            <label for="talla">Talla</label>
            <input type="talla" name="talla" placeholder="talla" id="talla" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" placeholder="color" id="inventario" class="form-control" requiere>
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

<!-- Modaleliminar -->
  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../php/insertar_producto.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEliminarLabel">Eliminar Producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        ¿Desea eliminar el producto?
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger eliminar" data-bs-dismiss="modal">Aceptar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
   <!-- Modal -->
   <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../php/editar_producto.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditarLabel">Editar Producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="idEdit" name="id"><br>
            <label for="nombreEdit">Nombre</label>
            <input type="text" name="nombre" placeholder="nombre" id="nombreEdit" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="descripcionEdit">Descripción</label>
            <input type="text" name="descripcion" placeholder="descripcion" id="descripcionEdit" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="img">Imagen</label>
            <input type="file" name="img" placeholder="img" id="img" class="form-control" >
          </div>
          <div class="form-group">
            <label for="precioEdit">Precio</label>
            <input type="number" min="0" name="precio" placeholder="precio" id="precioEdit" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="inventarioEdit">Inventario</label>
            <input type="number" name="inventario" placeholder="inventario" id="inventarioEdit" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="categoriaEdit">CATEGORIA</label>
            <select name="categoria" id="categoriaEdit" class="form-control" requiere>
              <?php
              $res = $conexion->query("select * from categorias")or die($conexion->error);
              while ($f = mysqli_fetch_array($res)) {
                echo '<option value="'.$f['id'].'">'.$f['nombre'].'</option>';
              }
              ?>
            </select>
            </div>

          <div class="form-group">
            <label for="tallaEdit">Talla</label>
            <input type="text" name="talla" placeholder="talla" id="tallaEdit" class="form-control" requiere>
          </div>
          <div class="form-group">
            <label for="colorEdit">Color</label>
            <input type="text" name="color" placeholder="color" id="colorEdit" class="form-control" requiere>
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
  <?php include("./layouts/footer.php");?>
</div>
<!-- ./wrapper -->

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
<script>
  $(document).ready(function(){
    var idEliminar= -1;
    var idEditar = -1;
    var fila;
    $(".btnEliminar").click(function(){
      idEliminar = $(this).data('id');
      fila=$(this).parent('td').parent('tr');
    });
    $(".eliminar").click(function(){
      $.ajax({
        url: '../php/eliminarproducto.php',
        method: 'POST',
        data:{
          id: idEliminar
        }
      }).done(function(res){
        
        $(fila).fadeOut(1000);
      });
    });
    $(".btnEditar").click(function(){
      idEditar=$(this).data('id');
      var nombre=$(this).data('nombre');
      var descripcion=$(this).data('descripcion');
      var precio=$(this).data('precio');
      var inventario=$(this).data('inventario');
      var categoria=$(this).data('categoria');
      var talla=$(this).data('talla');
      var color=$(this).data('color');
      
      $("#nombreEdit").val(nombre);
      $("#descripcionEdit").val(descripcion);
      $("#precioEdit").val(precio);
      $("#inventarioEdit").val(inventario);
      $("#categoriaEdit").val(categoria);
      $("#tallaEdit").val(talla);
      $("#colorEdit").val(color);
      $("#idEdit").val(idEditar);
      
    });
  });
</script>
</body>
</html>
