<?php
    $servidor="localhost";
    $nombd="ku";
    $us="root";
    $con="1234";
    $conexion = new mysqli($servidor, $us, $con, $nombd);
    if($conexion -> connect_error ){
        die("No se pudo acceder");
    }
?>