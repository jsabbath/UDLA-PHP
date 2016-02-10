<?php 
include "../../config/datos.php";

	$examen = $_POST['item'];
	$paciente_id = $_POST['paciente_id'];
	$hace_cuanto = $_POST['fecha'];
	$otra = ucfirst($_POST['otros']);
	$resultado = $_POST['resultado'];
	
	if($examen == "otros")
	{
		$guarda = mysql_query("INSERT INTO examenes 
					VALUES(NULL, '$otra', '$hace_cuanto', '$resultado', '$paciente_id')");

		if ($guarda) {
			$update_progress = mysql_query("UPDATE pacientes SET progreso = 9 
					WHERE id = '{$paciente_id}' LIMIT 1 ");

			header("Location: ../../Pantallas/Pacientes/examenes_previos.php?paciente=$paciente_id");
		}
		else
		{
			header("Location: ../../Pantallas/Pacientes/examenes_previos.php?paciente=$paciente_id&msg=error");
		}
			
	}
	else
	{
		$guarda = mysql_query("INSERT INTO examenes 
					VALUES(NULL, '$examen', '$hace_cuanto', '$resultado', '$paciente_id')");
		
		if ($guarda) {
			$update_progress = mysql_query("UPDATE pacientes SET progreso = 9 
					WHERE id = '{$paciente_id}' LIMIT 1 ");

			header("Location: ../../Pantallas/Pacientes/examenes_previos.php?paciente=$paciente_id");
		}
		else
		{
			header("Location: ../../Pantallas/Pacientes/examenes_previos.php?paciente=$paciente_id&msg=error");
		}
			
	}
	
		

	/*if ($guarda)
	{
		header("Location: ../../Pantallas/Pacientes/habitos.php?paciente=$paciente_id");
	}
	else
	{
		$msg_error = "Disculpe, ha ocurrido un problema y no se pudo guardar la información.";
		header("Location: ../../Pantallas/Pacientes/examenes_previos.php?msg=$msg_error&paciente=$paciente_id");
	}*/
?>