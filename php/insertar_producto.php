<?php
include "./conexion.php";

if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) 
                           && isset($_POST['inventario']) && isset($_POST['categoria']) 
                           && isset($_POST['talla']) && isset($_POST['color'])){

                            $carpeta="../images/";
                            $nombre = $_FILES['img']['name'];//tomar
                            $temp=explode('.',$nombre);
                            $extension= end($temp);
                            $nombreFinal = time().'.'.$extension;
                            if($extension == 'jpg' || $extension == 'png'){
                                if(move_uploaded_file($_FILES['img']['tmp_name'],$carpeta.$nombreFinal)){
                                    $conexion->query("insert into productos
                                    (nombre,descripcion,precio,imagen,inventario,id_categoria,empaque,color) values
                                    (
                                       '".$_POST['nombre']."' ,
                                       '".$_POST['descripcion']."' ,
                                       ".$_POST['precio'].",
                                       '$nombreFinal' ,
                                       ".$_POST['inventario']." ,
                                       ".$_POST['categoria']." ,
                                       '".$_POST['talla']."' ,
                                       '".$_POST['color']."' 
                                    )
                                    ")or die($conexion->error);
                                    header("Location: ../admin/productos.php?success"); 
                                    
                                }else{
                                    header("Location: ../admin/productos.php?error=No se pudo subir la imagen");  
                                }
                            }else{
                                header("Location: ../admin/productos.php?error=Favor de subir imagen jpg o png");
                            }

                           }else{
                            header("Location: ../admin/productos.php?error=Favor de llenar todos los campos");
                           }


?>