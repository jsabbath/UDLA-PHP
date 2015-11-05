<?php
include "../../config/datos.php";



if (isset($_POST['diferir'])) {
$fecha=$_POST['fecha'];
$id=$_POST['cita_id'];
$sql = mysql_query("UPDATE citas SET fecha='{$fecha}', status = 0 WHERE id='{$id}'");


if ($sql) {
	

  header("Location: ../../Pantallas/Recepcion/inicio.php");
  
} else {
    echo "No actualizo la Fecha: " ;
   
}

	
}else {
$fecha=$_POST['fecha'];
$id=$_POST['cita_id'];
$sql = mysql_query("UPDATE citas SET fecha='{$fecha}', status = 0 WHERE id='{$id}'");


if (isset($sql)) {

  header("Location: ../../Pantallas/Recepcion/inicio.php");
  
} else {
    echo "No actualizo la Fecha: " ;
   
}



}







?>