<?php 
include "../../config/datos.php";

	$resp1 = $_POST['medicamento'];
	$medicamentos = $_POST['medicamentos'];
	$resp2 = $_POST['alimento'];
	$alimentos = $_POST['alimentos'];
	$paciente_id = $_POST['paciente_id'];

	$guarda = mysql_query("INSERT INTO alergias VALUES(NULL, '$resp1', '$medicamentos', '$resp2', '$alimentos', '$paciente_id', NOW(), '')");	

	if ($guarda)
	{

		$update_progress = mysql_query("UPDATE pacientes SET progreso = 4 
								WHERE id = '{$paciente_id}' LIMIT 1 ");

		header("Location: ../../Pantallas/Pacientes/operaciones.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/antecedentes_alergicos.php?msg=$msg_error&paciente=$paciente_id");
	}
?>