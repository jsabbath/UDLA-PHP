<?php 
include "../../config/datos.php";
include("../funciones.php");

	$fuma = $_POST['fuma'];
	$frec_fuma = $_POST['frec_fuma'];
	$licor = $_POST['licor'];
	$frec_licor = $_POST['frec_licor'];
	$deportes = $_POST['deportes'];
	$frec_deporte = $_POST['frec_deporte'];
	$gym = $_POST['gym'];
	$frec_gym = $_POST['frec_gym'];
	$trabajo = $_POST['trabajo'];
	
	$paciente_id = $_POST['paciente_id'];
	
	$guarda = mysql_query("INSERT INTO habitos VALUES(NULL, '$fuma', '$frec_fuma', '$deportes', '$frec_deporte', '$gym', '$frec_gym', '$licor', '$frec_licor', '$trabajo', '$paciente_id')");	

	if ($guarda)
	{
		$update_progress = mysql_query("UPDATE pacientes SET progreso = 10 
					WHERE id = '{$paciente_id}' LIMIT 1 ");
		$sexo = mysql_query("SELECT * FROM pacientes WHERE id='{$paciente_id}'");
		$res = mysql_fetch_assoc($sexo);
		$edad = calculaedad($res['fecha_nacimiento']);
		if($res['sexo'] == 'Masculino')
		{
			header("Location: ../../Pantallas/Pacientes/preguntas_genero.php?gen=1&paciente=$paciente_id");
		}
		elseif($res['sexo'] == 'Femenino')
		{
			header("Location: ../../Pantallas/Pacientes/preguntas_genero.php?gen=2&paciente=$paciente_id");
		}
		else
		{
			header("Location: ../../Pantallas/Pacientes/terminar.php");
		}
		
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/habitos.php?msg=$msg_error&paciente=$paciente_id");
	}
?>