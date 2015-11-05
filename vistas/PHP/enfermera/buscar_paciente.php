<?php 
include "../../config/datos.php";

$cedula = $_POST['cedula'];
$ced = $_POST['ci']."-".$cedula;
$verifica = mysql_query("SELECT * FROM pacientes WHERE cedula ='{$ced}' LIMIT 1 ");

$filas = mysql_num_rows($verifica);//cuenta cuantos han sido encontrados

	if ($filas == 1)
	{ 
		$paciente = mysql_fetch_assoc($verifica);
		$id = $paciente['id'];
		//paciente existente
		header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$id");
	}
	else
	{
		//paciente no encontrado
		header("Location: ../../Pantallas/Enfermera/index.php?error=no_encontrado");
 	}

?>