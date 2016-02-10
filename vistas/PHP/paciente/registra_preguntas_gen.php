<?php 
include "../../config/datos.php";

	if(isset($_POST['femenino']))
	{
		$ovarios = $_POST['ovarios'];
		$toma_anti = $_POST['anti'];
		$cual_anti = $_POST['cual_anti'];
		$trastornos = $_POST['trast'];
		$hormonas = $_POST['hormonas'];
		$paciente_id = $_POST['paciente_id'];
		$embarazo = $_POST['embarazo'];
		$ultima_menst = $_POST['fecha'];
		$edad_des = $_POST['edad_des'];
		$edad_menopausia = $_POST['edad_menopausia'];
		$dolor = $_POST['dolor_menstrual'];

		$guarda = mysql_query("INSERT INTO preg_mujer VALUES(NULL, '$ovarios', '$toma_anti', '$cual_anti', '$trastornos', '$hormonas', '$embarazo', '$ultima_menst', '$paciente_id', '$edad_des', '$edad_menopausia', '$dolor' )");	

		if ($guarda)
		{
			header("Location: ../../Pantallas/Pacientes/terminar.php");
		}
		else
		{
			$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
			header("Location: ../../Pantallas/Pacientes/preguntas_genero.php?msg=$msg_error&paciente=$paciente_id&gen=2");
		}
	}

	if(isset($_POST['masculino']))
	{
		$pareja = $_POST['pareja'];
		$condon = $_POST['condon'];
		$antigeno = $_POST['antigeno'];
		$fecha = $_POST['fecha'];
		$antigeno_resul = $_POST['resultado'];
		$paciente_id = $_POST['paciente_id'];

		$guarda = mysql_query("INSERT INTO preg_hombre VALUES(NULL, '$pareja', '$condon', '$antigeno', '$antigeno_resul', '$fecha', '$paciente_id')");	

		if ($guarda)
		{
			header("Location: ../../Pantallas/Pacientes/terminar.php");
		}
		else
		{
			$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
			header("Location: ../../Pantallas/Pacientes/preguntas_genero.php?msg=$msg_error&paciente=$paciente_id&gen=1");
		}
	}
	
?>