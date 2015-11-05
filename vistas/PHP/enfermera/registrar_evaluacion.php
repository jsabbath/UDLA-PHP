<?php 
include("../../config/datos.php");

$trat_casa = $_POST['cumple'];
$trat_casa_xq = $_POST['cumple_xq'];
$mejoria = $_POST['mejoria'];
$mejoria_xq = $_POST['mejoria_xq'];
$complicacion = $_POST['complicacion'];
$complicacion_xq = $_POST['complicacion_xq'];
$id_trat = $_POST['id'];
$paciente_id = $_POST['paciente'];
$sesion_id = $_POST['sesion_id'];
$cita=$_GET['cita'];

$guarda = mysql_query("INSERT INTO control_tratamientos VALUES(NULL, '$trat_casa', '$trat_casa_xq','$mejoria', '$mejoria_xq', '$complicacion', '$complicacion_xq', '$id_trat', '$paciente_id', '$sesion_id', NOW(), '' )");

if ($guarda) {
	
	header("Location: ../../Pantallas/Enfermera/aplicando.php?id=$id_trat&paciente=$paciente_id&sesion=$sesion_id&cita=$cita");
	exit;
}
else {

	$msg_error = "Ha ocurrido un problema, lo sentimos.";
	header("Location: ../../Pantallas/Enfermera/evaluacion.php?msg=$msg_error&d=$id_trat&paciente=$paciente_id&sesion=$sesion_id&cita=$cita");
	exit;
}


?>