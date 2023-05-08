<?php
include "./conexion.php";

if(isset($_POST['nombred']) && isset($_POST['correod']) && isset($_POST['contrad']) 
                            && isset($_POST['ciudadd']) && isset($_POST['estadod']) 
                            && isset($_POST['curpd']) && isset($_POST['rfcd']) && isset($_POST['constanciad'])
                            && isset($_POST['fechad']) && isset($_POST['domiciliod']) && isset($_POST['distribuciond'])
                            && isset($_POST['zonad']) && isset($_POST['usuario']) && isset($_POST['submit'])!=""){
                            
                            $archivo
                            $nombre_archivo
                            $name=$_FILES['curpd']['name'];
                            $size=$_FILES['curpd']['size'];
                            $type=$_FILES['curpd']['type'];
                            $temp=$_FILES['curpd']['tmp_name'];
                            $fname = date("YmdHis").'_'.$name;

                            $chk = $conn->query("SELECT * FROM  usuarios where curp = '$name' ")->rowCount();
                            

                            $carpeta="../images/";
                            $nombre = $_FILES['img']['name'];
                            $temp=explode('.',$nombre);
                            $extension= end($temp);
                            $nombreFinal = time().'.'.$extension;
                            

                            if($extension == 'jpg' || $extension == 'png'){
                                if(move_uploaded_file($_FILES['img']['tmp_name'],$carpeta.$nombreFinal)){
                                    
                                    
                                    $conexion->query("insert into usuario
                                    (email, password, nombre, ciudad, estado, curp, rfc, constancia, f_inicio, dom_env, nom_emp, zona) values
                                    (
                                        '".$_POST['correod']."' ,
                                        '".$_POST['contrad']."' ,
                                        ".$_POST['nombred'].",
                                        ".$_POST['ciudadd']." ,
                                        ".$_POST['estadod']." ,
                                        '".$_POST['curpd']."' ,
                                       '".$_POST['rfcd']."' ,
                                       '".$_POST['constanciad']."' ,
                                       ".$_POST['fechad'].",
                                       ".$_POST['domiciliod']." ,
                                       ".$_POST['distribuciond']." ,
                                       '".$_POST['zonad']."' 
                                    )
                                    ")or die($conexion->error);



                                    header("Location: ../admin/registrar.php?success"); 
                                    
                                }else{
                                    header("Location: ../admin/registrar.php?error=No se pudo subir la imagen");  
                                }
                            }else{
                                header("Location: ../admin/productos.php?error=Favor de subir imagen jpg o png");
                            }

                           }else{
                            header("Location: ../admin/productos.php?error=Favor de llenar todos los campos");
                           }


?>
<?php
$conn=new PDO('mysql:host=localhost; dbname=archivos', 'root', 'losdec211299');

if(isset($_POST['submit'])!=""){
  $name=$_FILES['file']['name'];
  $size=$_FILES['file']['size'];
  $type=$_FILES['file']['type'];
  $temp=$_FILES['file']['tmp_name'];
  // $caption1=$_POST['caption'];
  // $link=$_POST['link'];


  $fname = date("YmdHis").'_'.$name;
  $chk = $conn->query("SELECT * FROM  upload where name = '$name' ")->rowCount();
  if($chk){
    $i = 1;
    $c = 0;
    while($c == 0){
    	$i++;
    	$reversedParts = explode('.', strrev($name), 2);
    	$tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
    // var_dump($tname);exit;
    	$chk2 = $conn->query("SELECT * FROM  upload where name = '$tname' ")->rowCount();
    	if($chk2 == 0){
    		$c = 1;
    		$name = $tname;
    	}
    }
}
 $move =  move_uploaded_file($temp,"upload/".$fname);
 if($move){
 	$query=$conn->query("insert into upload(name,fname)values('$name','$fname')");
    if($query){
    header("location:cargar.php");
    }
    else{
    
    }
 }
}
?>