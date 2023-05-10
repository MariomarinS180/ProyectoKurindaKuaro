<?php
$conn=new PDO('mysql:host=localhost; dbname=ku', 'root', '');
if(True){
  $curp=$_FILES['constanciat']['name'];
  $size=$_FILES['constanciat']['size'];
  $type=$_FILES['constanciat']['type'];
  $temp=$_FILES['constanciat']['tmp_name'];

  $fcurp = date("YmdHis").'_'.$curp;
  
  $chk = $conn->query("SELECT * FROM  usuarios where nCsf = '$curp' ")->rowCount();

  if($chk){
    $i = 1;
    $c = 0;
    while($c == 0){
    	$i++;
    	$reversedParts = explode('.', strrev($curp), 2);
    	$tcurp = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));       
    // var_dump($tname);exit;
    	$chk2 = $conn->query("SELECT * FROM  usuarios where nCsf = '$tcurp' ")->rowCount();

    	if($chk2 == 0){
    		$c = 1;
    		$curp = $tcurp;
    	}
    }
}
 $move =  move_uploaded_file($temp,"../csf/".$fcurp);

 if($move){
 	$query=$conn->query("insert into usuarios( nombre, correo, password, tipo, telefono, rfc, nCsf, csf, fecha_inicio, ubicaciones,domicilio, cedis, nombre_usuario)
                         values(

                          '".$_POST['nombret']."',
                          '".$_POST['correot']."',
                          '".$_POST['contrat']."',
                          '".$_POST['tienda']."',
                          '".$_POST['telefonot']."',
                          '".$_POST['rfct']."',                     
                          '$curp',
                          '$fcurp',
                          '".$_POST['fechat']."',
                          '".$_POST['ciudadt']."',
                          '".$_POST['domiciliot']."',
                          '".$_POST['cedist']."',
                          '".$_POST['usuariot']."'
                          )");
    if($query){
      header("Location: ../admin/registrar.php?success");
    }
    else{
    
    }
 }
}
?>