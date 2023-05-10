<?php
session_start();
unset($_SESSION['datos_login']);
unset($_SESSION['carrito']);
include "./conexion.php";
if(isset($_POST['email']) && isset($_POST['pass'])){
    $resultado = $conexion->query("select * from usuarios where 
    correo='".$_POST['email']."' and 
    password='".$_POST['pass']."' limit 1")or die($conexion->error);

    if(mysqli_num_rows($resultado)>0){
        $datos_usuario= mysqli_fetch_row($resultado);
        $nombre= $datos_usuario[1];
        $id_usuario= $datos_usuario[0];
        $email= $datos_usuario[2];
        $nivel = $datos_usuario[4];
        $_SESSION['datos_login']= array(
            'nombre'=>$nombre,
            'id'=>$id_usuario,
            'correo'=>$email,
            'tipo'=>$nivel
        );

        header("Location: ../admin");

        if($nivel === "distribuidor" || $nivel === "tienda" ){
            header("Location: ../index.php");
        }else {
            header("Location: ../admin");
        }

    }else{
        header("Location: ../login.php?error=Credenciales incorresctas");
    }

}else{
    header("../login.php");
}
?>