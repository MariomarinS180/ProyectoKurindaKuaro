<?php
include("conexion.php");
//$con = new ConexionBD();
/*
insert into usuarios(nombre, correo, password, tipo, telefono, rfc, nCurp, nCsf, curp, csf, fecha_inicio, ciudad, estado,domicilio, nom_emp, zona, nombre_usuario) values('1','1@1.mx','123','tienda','rfc','nCurp','ncsf','curp','csf','2018-12-12','zac','zac','domicilio','lae','zac','nom_usuario'); 

*/
$conexion = $con->getConexion();

if (True) {
    $curp = $_FILES['curpdoc']['name'];
    $size = $_FILES['curpdoc']['size'];
    $type = $_FILES['curpdoc']['type'];
    $temp = $_FILES['curpdoc']['tmp_name'];




    $chk = $conn->query("SELECT * FROM  usuarios where nCurp = '$curp' ")->rowCount();
    $chkf1 = $conn->query("SELECT * FROM  usuarios where nCsf = '$csf' ")->rowCount();

    if ($chk) {
        $i = 1;
        $c = 0;
        while ($c == 0) {
            $i++;
            $reversedParts = explode('.', strrev($curp), 2);
            $tcurp = (strrev($reversedParts[1])) . "_" . ($i) . '.' . (strrev($reversedParts[0]));

            $reversedParts = explode('.', strrev($csf), 2);
            $tcsf = (strrev($reversedParts[1])) . "_" . ($i) . '.' . (strrev($reversedParts[0]));


            // var_dump($tname);exit;
            $chk2 = $conn->query("SELECT * FROM  usuarios where nCurp = '$tcurp' ")->rowCount();

            $chk3 = $conn->query("SELECT * FROM  usuarios where nCsf = '$tcsf' ")->rowCount();



            if ($chk2 == 0 && $chk3 == 0) {
                $c = 1;
                $curp = $tcurp;
                $csf = $tcsf;
            }
        }
    }
    $move =  move_uploaded_file($temp, "../curp/" . $fcurp);
    $move1 =  move_uploaded_file($temp1, "../csf/" . $fcsf);

    if ($move && $move1) {
        $query = $conexion->query("insert into usuarios(nombre, correo, password, tipo, telefono, rfc, nCurp, nCsf, curp, csf, fecha_inicio, ciudad, estado,domicilio, nom_emp, zona, nombre_usuario) values('" . $_POST['nombred'] . "', '" . $_POST['correod'] . "', '" . $_POST['contrad'] . "', '" . $_POST['distribuidor'] . "', '" . $_POST['telefonod'] . "', '" . $_POST['rfcd'] . "', '$curp', '$csf', '$fcurp','$fcsf', '" . $_POST['fechad'] . "', '" . $_POST['ciudadd'] . "', '" . $_POST['estadod'] . "', '" . $_POST['domiciliod'] . "', '" . $_POST['distribuciond'] . "', '" . $_POST['zonad'] . "', '" . $_POST['usuariod'] . "')");
        if ($query) {
            header("Location: ../admin/registrar.php?success");
        } else {
        }
    }
}
