<?php 
include "../../config/datos.php";
	
	$nombre = ucwords($_POST['nombre']);
	$cedula = $_POST['cedula'];
	$email = $_POST['email'];
	$parentesco = ucfirst($_POST['parentesco']);
	$ocupacion = ucfirst($_POST['ocupacion']);
	$telefono = $_POST['telefono'];
	$direccion = ucfirst($_POST['direccion']);

	$paciente = $_POST['paciente_id'];

	$guarda = mysql_query("INSERT INTO representantes VALUES(NULL, '$nombre', '$cedula', '$email', '$parentesco', '$ocupacion', '$telefono', '$direccion')");	

	if ($guarda)
	{	
		$id_r = mysql_insert_id();
		$update = mysql_query("UPDATE pacientes SET representante_id = '{$id_r}' WHERE id = '{$paciente}' LIMIT 1");
		if($update)
		{
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$paciente");
		}
		else
		{
			$msg = "Lo sentimos, no se puedo relacionar al paciente con su representante.";
			header("Location: ../../Pantallas/Pacientes/representante.php?paciente=$id&msg=$msg");
		}
			
	}
	else
	{
		$msg = "Lo sentimos, no se puedo realizar el registro.".mysql_error();
		header("Location: ../../Pantallas/Pacientes/representante.php?paciente=$id&msg=$msg");
	}

?>