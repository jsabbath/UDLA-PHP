<?php 
include ("../../config/datos.php");

	$alerta = $_POST['alerta'];
	
	$paciente_id = $_GET['paciente'];

		$guarda = mysql_query("INSERT INTO alertas VALUES(NULL, '$paciente_id', '$alerta', NOW())");

	if ($guarda)
	{
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&msg=$msg_error");
	}
?>