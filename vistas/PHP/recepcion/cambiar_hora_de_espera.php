<?php 
include("../../config/datos.php");

$cita = $_POST['cita_id'];
$paciente = $_POST['paciente_id'];
$hora = $_POST['hora'];

$fecha =  date('Y-m-d')." ".$hora;
 

$sql = mysql_query("UPDATE citas SET updated_at='{$fecha}' WHERE id='".$_POST['cita_id']."'");


if (isset($sql)) {

  header("Location: ../../Pantallas/Recepcion/inicio.php");
  
} else {
    echo "No actualizo la Fecha: " ;
   
}






?>