<?php 
include "../../config/datos.php";

	$enfermedades = $_POST['item'];
	$otra = $_POST['otra'];
	$derma = $_POST['cuales_der'];
	$parentesco = $_POST['parentesco'];
	$hace_cuanto = $_POST['hace_cuanto'];
	$paciente_id = $_POST['paciente_id'];

	if ($enfermedades == "otras") {
		$guarda = mysql_query("INSERT INTO antecedentes_familiares 
					VALUES(NULL, '$otra', '', '$parentesco', '$hace_cuanto', '$paciente_id')");

			if($guarda){
				$update_progress = mysql_query("UPDATE pacientes SET progreso = 6 
									WHERE id = '{$paciente_id}' LIMIT 1 ");
				header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id");	
			}
			else
			{
				header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id&msg=error");
			}
		}
	else if ($enfermedades == "Enfermedades Dermatologicas") {
		$guarda = mysql_query("INSERT INTO antecedentes_familiares 
					VALUES(NULL, '$enfermedades', '$derma', '$parentesco', '$hace_cuanto', '$paciente_id')");

			if($guarda){
				$update_progress = mysql_query("UPDATE pacientes SET progreso = 6 
									WHERE id = '{$paciente_id}' LIMIT 1 ");
				header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id");	
			}
			else
			{
				header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id&msg=error");
			}
		}
	else{
		$guarda = mysql_query("INSERT INTO antecedentes_familiares 
					VALUES(NULL, '$enfermedades', '', '$parentesco', '$hace_cuanto', '$paciente_id')");

			if($guarda){
				$update_progress = mysql_query("UPDATE pacientes SET progreso = 6 
									WHERE id = '{$paciente_id}' LIMIT 1 ");
				header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id");	
			}
			else
			{
				header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$paciente_id&msg=error");
			}
	}	
		


/*
	if ($guarda)
	{
		header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/antec-familiar.php?msg=$msg_error&paciente=$paciente_id");
	}
*/
	
?>