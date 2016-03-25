<?php 
include "../../config/datos.php";

$id= $_GET['paciente'];
$id_cita= $_GET['cita'];


$borrar = mysql_query("UPDATE citas SET status=3 WHERE id='".$id_cita."'");

if ($borrar) {
	    header("Location: ../../Pantallas/Especialista/inicio.php");
}else{

echo" ocurrio un error".mysql_error() ;


}


 ?>