<?php 
include "../../config/datos.php";

	$examenes = $_POST['item'];
	//$cita_id = $_POST['cita_id'];
	$paciente_id = $_POST['paciente_id'];

	foreach($examenes as $examen)
	{
		$guarda = mysql_query("INSERT INTO examenes_solicitados VALUES(NULL, '$examen', '$paciente_id', NOW(), '')");
	}
		

	if ($guarda)
	{
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&act=exam");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&msg=$msg_error");
	}
?>