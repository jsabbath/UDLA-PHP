<?php 
include "../../config/datos.php";

	$enfermedad = $_POST['item'];
	$hace_cuanto = $_POST['hace_cuanto']; 
	$otra = ucwords($_POST['otra']);
	$cuales = ucfirst($_POST['cuales_der']);
	$paciente_id = $_POST['paciente_id'];

	if ($enfermedad == "otras") 
	{
		$guarda = mysql_query("INSERT INTO antecedentes_personales 
					VALUES(NULL, '$otra', '', '$hace_cuanto', '$paciente_id')")
					or die('Lo sentimos, ocuarrio un error al guardar.');
		if($guarda){

			$update_progress = mysql_query("UPDATE pacientes SET progreso = 3 
								WHERE id = '{$paciente_id}' LIMIT 1 ");
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente_id");
		}
		else
		{
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente_id&msg=error");
		}
	}
	elseif ($enfermedad == "Enfermedades Dermatologicas") 
	{
		$guarda = mysql_query("INSERT INTO antecedentes_personales 
					VALUES(NULL, '$enfermedad', '$cuales', '$hace_cuanto', '$paciente_id')")
					or die('Lo sentimos, ocuarrio un error al guardar.');
		if($guarda){

			$update_progress = mysql_query("UPDATE pacientes SET progreso = 3 
								WHERE id = '{$paciente_id}' LIMIT 1 ");	

			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente_id");
		}
		else
		{
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente_id&msg=error");
		}
	}
	else
	{
		$guarda = mysql_query("INSERT INTO antecedentes_personales 
					VALUES(NULL, '$enfermedad', '', '$hace_cuanto', '$paciente_id')")
					or die('Lo sentimos, ocuarrio un error al guardar.');
		if($guarda){

			$update_progress = mysql_query("UPDATE pacientes SET progreso = 3 
								WHERE id = '{$paciente_id}' LIMIT 1 ");	
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente_id");
		}
		else
		{
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente_id&msg=error");
		}
	}

	include("consulta_ant_personal.php");
	
		
/*
	if ($guarda)
	{
		header("Location: ../../Pantallas/Pacientes/antecedentes_alergicos.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = "Disculpe, ha currido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?msg=$msg_error&paciente=$paciente_id");
	} */
?>