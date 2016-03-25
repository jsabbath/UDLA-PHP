<?php 
include("../../config/datos.php");

$observacion = $_POST['observacion'];
$tratamiento = $_POST['tratamiento'];
$paciente = $_POST['paciente'];
$sesion_id = $_POST['sesion_id'];
$usuario = $_POST['usuario'];
$cita = $_GET['cita'];
$guarda = mysql_query("INSERT INTO observaciones_tratamiento VALUES(NULL, '$observacion', '$tratamiento', '$paciente', '$sesion_id', '$usuario', NOW(), '') ");

if ($guarda) {
	
	header("Location: ../../Pantallas/Enfermera/finalizar_tratamiento.php?id=$tratamiento&paciente=$paciente&sesion=$sesion_id&cita=$cita");
	exit;

}
else{
	$msg_error = mysql_error();
	header("Location: ../../Pantallas/Enfermera/observacion_tratamiento.php?id=$tratamiento&paciente=$paciente&sesion=$sesion_id&cita=$cita");
	exit;
}

?>