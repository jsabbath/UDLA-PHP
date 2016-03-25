<?php 
include ("../../config/datos.php");

	$patologia = $_POST['patologia_2'];

	$paciente_id = $_POST['paciente_id'];

		$guarda = mysql_query("INSERT INTO patologias VALUES(NULL, '$patologia')");

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

