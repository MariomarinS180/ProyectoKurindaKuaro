<?php
//Incluimos la Conexion para acceder a la base de datos
include '../conexion.php';
//Guardamos la query en una variable para poder modificarla
$resultado = $conexion ->query("select * from productos_venta");
//Creamos el Array donde se guarda la informacion de la query
$datos = array();
//Recorremos cada una de las filas
while ($fila = mysqli_fetch_array($resultado)) {
//guardamos en el arreglo 
    $datos[] = $fila;
}
//Convertimos el arreglo en un objeto JSON, 
$json = json_encode($datos);

// Guardamos el objeto JSON en un archivo
file_put_contents('datos.json', $json);
//echo $json; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>