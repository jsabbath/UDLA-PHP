<?php 
include "../../config/datos.php";

	$protector = $_POST['protector']." - ".$_POST['cual_protector'];
	$crema_noche = $_POST['crema_noche']." - ".$_POST['cual_noche'];
	$crema_dia = $_POST['crema_dia']." - ".$_POST['cual_dia'];
	$crema_cuerpo = $_POST['crema_cuerpo']." - ".$_POST['cual_cuerpo'];
	$shampo = $_POST['shampo'];
	$javon_cara = $_POST['javon_cara'];
	$javon_diario = $_POST['javon'];
	$paciente_id = $_POST['paciente_id'];

	$guarda = mysql_query("INSERT INTO cremas VALUES(NULL,'$protector', '$crema_noche', '$crema_dia', '$crema_cuerpo', '$shampo','$javon_cara', '$javon_diario', '$paciente_id')");	

	if ($guarda)
	{
		header("Location: ../../Pantallas/Pacientes/examenes_previos.php?paciente=$paciente_id");
		$update_progress = mysql_query("UPDATE pacientes SET progreso = 8 
							WHERE id = '{$paciente_id}' LIMIT 1 ");	
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/cremas.php?msg=$msg_error&paciente=$paciente_id");
	}
?>