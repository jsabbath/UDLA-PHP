<?php 
include "../../config/datos.php";
include("../funciones.php");

	
	$nombre = ucwords($_POST['nombre_completo']);
	$apellido = ucwords($_POST['apellidos']);
	$nombre_completo = $nombre ." ".$apellido;
	$cedula = $_POST['cedula'];
	$email = $_POST['email'];
	$nacimiento = $_POST['fecha_nacimiento'];
	$sexo = $_POST['sexo'];
	$civil = ucfirst($_POST['estado_civil']);
	$ocupacion = ucfirst($_POST['ocupacion']);
	$telefono = $_POST['telefono'];
	$estado = $_POST['estado'];
	$ciudad = ucfirst($_POST['ciudad']);
	$direccion = ucfirst($_POST['direccion']);
	$remitido = $_POST['remitido'];
	$quien = isset ($_POST["quien"])?$_POST["quien"]: "";
	$avatar = "avatar.jgp";
	$progreso = 2;

	$guarda = mysql_query("INSERT INTO pacientes VALUES(NULL, '$nombre_completo', '$cedula', '$email', '$nacimiento','$sexo','$telefono','$civil', '$estado', '$ciudad', '$direccion','$ocupacion','$remitido','$quien', '$avatar', '$progreso', '', NOW(), '')");	

	if ($guarda)
	{
		$edad = calculaedad($nacimiento);
		if($edad >= 18)
		{
			$id = mysql_insert_id();
			header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$id");	
		}
		else
		{
			$id = mysql_insert_id();
			header("Location: ../../Pantallas/Pacientes/representante.php?paciente=$id");
		}
		
	}
	elseif(isset($_POST['paciente_id']))
	{
		$sql =  mysql_query("UPDATE pacientes SET 
				email='$email',
				fecha_nacimiento='$nacimiento',
				sexo='$sexo',
				telefono='$telefono',
				estado_civil='$civil',
				estado='$estado',
				ciudad='$ciudad',
				direccion='$direccion',
				ocupacion='$ocupacion',
				remitido='$remitido',
				quien='$quien',
				avatar='$avatar',
				progreso='$progreso'
				WHERE id='".$_POST['paciente_id']."'");

		if ($sql) 
		{
			$edad = calculaedad($nacimiento);
			if($edad >= 18)
			{
				$id = $_POST['paciente_id'];
				header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$id");
			}
			else
			{
				$id = $_POST['paciente_id'];
				header("Location: ../../Pantallas/Pacientes/representante.php?paciente=$id");
			}
			
		}
		else
		{	$msg = "edit ". mysql_error();
		 	$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
			header("Location: ../../Pantallas/Pacientes/datos_paciente.php?msg=$msg_error&paciente=$paciente_id&ced=$cedula");
		}

	}
	else
	{
		$msg = "insert ".mysql_error();
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/datos_paciente.php?msg=$msg_error&paciente=$paciente_id&ced=$cedula");
	}
?>