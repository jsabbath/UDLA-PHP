<?php 
include("../../config/datos.php");
if (isset($_POST['ausente'])) {
$cita = $_POST['cita_id'];
$sql = mysql_query("UPDATE citas SET status='2' WHERE id='{$cita}' LIMIT 1");


if ($sql) {

  header("Location: ../../Pantallas/Recepcion/inicio.php");
  
} else {
    echo "No actualizo la Fecha: " ;
   
}


}else {     
$cita = $_POST['cita_id'];
$sql = mysql_query("UPDATE citas SET status='100' WHERE id='{$cita}' LIMIT 1");


if ($sql) {

  header("Location: ../../Pantallas/Recepcion/inicio.php");
  
} else {
    echo "No actualizo la Fecha: " ;
   
}


}









?>