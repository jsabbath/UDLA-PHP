<?php 
include "../../config/datos.php";

	$tratamiento = $_POST['item'];
	$cual = $_POST['cual'];
	$otra = ucfirst($_POST['otra']);
	$motivo = ucfirst($_POST['motivos']);
	$hace_cuanto = $_POST['hace_cuanto'];
	$actualmente = $_POST['actual'];
	$paciente_id = $_POST['paciente_id'];

	if ($tratamiento == "otra") 
	{
		$guarda = mysql_query("INSERT INTO tratamientos_previos 
				VALUES(NULL, '$otra', '$cual', '$hace_cuanto', '$motivo', '$actualmente',  '$paciente_id')");
			if($guarda){
				$update_progress = mysql_query("UPDATE pacientes SET progreso = 7 
									WHERE id = '{$paciente_id}' LIMIT 1 ");
				header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?paciente=$paciente_id");	
			}
			else
			{
				header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?paciente=$paciente_id&msg=error");
			}
	}
	else
	{
		$guarda = mysql_query("INSERT INTO tratamientos_previos 
				VALUES(NULL, '$tratamiento', '$cual', '$hace_cuanto', '$motivo', '$actualmente',  '$paciente_id')");
			if($guarda){
				$update_progress = mysql_query("UPDATE pacientes SET progreso = 7 
						WHERE id = '{$paciente_id}' LIMIT 1 ");	
				header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?paciente=$paciente_id");
			}
			else
			{
				header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?paciente=$paciente_id&msg=error");
			}
	}
			
	

/*
	if ($guarda)
	{
		header("Location: ../../Pantallas/Pacientes/cremas.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?msg=$msg_error&paciente=$paciente_id");
	}
*/
?>