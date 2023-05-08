<?php
session_start();

include "./conexion.php";
if(isset($_POST['email']) && isset($_POST['pass'])){
    $resultado = $conexion->query("select * from usuario where 
    email='".$_POST['email']."' and 
    password='".sha1($_POST['pass'])."' limit 1")or die($conexion->error);

    if(mysqli_num_rows($resultado)>0){
        $datos_usuario= mysqli_fetch_row($resultado);
        $nombre= $datos_usuario[1];
        $id_usuario= $datos_usuario[0];
        $email= $datos_usuario[3];
        $im_per= $datos_usuario[5];
        $nivel = $datos_usuario[6];
        $_SESSION['datos_login']= array(
            'nombre'=>$nombre,
            'id_usuario'=>$id_usuario,
            'email'=>$email,
            'imagen'=>$im_per,
            'nivel'=>$nivel
        );

        header("Location: ../admin");

        if($nivel === "cliente"){
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