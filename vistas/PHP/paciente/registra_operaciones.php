<?php 
include "../../config/datos.php";

	//$resp = $_POST['operado'];
	$de_que = $_POST['de-que'];
	$fecha = $_POST['fecha'];
	$paciente_id = $_POST['paciente_id'];

	for ($i=0; $i<count($de_que); $i++) {

	    $guarda = mysql_query("INSERT INTO operaciones VALUES(NULL, 'si', '$de_que[$i]', '$fecha[$i]', '$paciente_id')");
	}


	if ($guarda)
	{
		$update_progress = mysql_query("UPDATE pacientes SET progreso = 5 
								WHERE id = '{$paciente_id}' LIMIT 1 ");

		header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.".mysql_error();

		header("Location: ../../Pantallas/Pacientes/operaciones.php?msg=$msg_error&paciente=$paciente_id");
	}
?>