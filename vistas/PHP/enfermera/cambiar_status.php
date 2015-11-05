<?php 
include "../../config/datos.php";
$id = $_GET['id'];
$paciente = $_GET['paciente'];
$cita= $_GET['cita'];


$cita_numero = mysql_query("UPDATE citas SET status = 3 WHERE id = '{$cita}' AND paciente_id = '{$paciente}' LIMIT 1 ");
    

$consulta = mysql_query("SELECT * FROM tratamientos WHERE id = '{$id}' ");
$tratamiento = mysql_fetch_assoc($consulta);

if ($tratamiento['status'] == 0) 
{
	$editar = mysql_query("UPDATE tratamientos SET status = 1 WHERE id = '{$id}' AND paciente_id = '{$paciente}' LIMIT 1 ");
   
	if ($editar) 
	{

	
		$sesion = mysql_query("INSERT INTO sesiones_procedimientos VALUES(NULL, 1, NOW(), '$id') ");
		if ($sesion)
		{	
			$sesion_id = mysql_insert_id();

			header("Location: ../../Pantallas/Enfermera/evaluacion.php?id=$id&paciente=$paciente&sesion=$sesion_id&cita=$cita");
			exit();
		}
		else 
		{
			$msg_error = "Ha ocurrido un problema, lo sentimos.";
			header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&msg=$msg_error&cita=$cita&act=procedimientos");
			exit();
		}
	}
	else 
	{
		$msg_error = "Ha ocurrido un problema, lo sentimos.";
		header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&msg=$msg_error&cita=$cita&act=procedimientos");
		exit();
	}
}
elseif ($tratamiento['status'] == 1) 
{
	$cita_numero = mysql_query("UPDATE citas SET status = 15 WHERE id = '{$cita}' AND paciente_id = '{$paciente}' LIMIT 1 ");
	$sql_sesiones = mysql_query("SELECT * FROM sesiones_procedimientos WHERE tratamiento_id = '{$id}' ");
	$nro_sesiones = mysql_num_rows($sql_sesiones);
	if ($tratamiento['cantidad'] > $nro_sesiones) 
	{
		$nro_sesion = $nro_sesiones + 1;
		$sesion = mysql_query("INSERT INTO sesiones_procedimientos VALUES(NULL, '$nro_sesion', NOW(), '$id') ");
		if ($sesion)
		{	
			
    
			$sesion_id = mysql_insert_id();
			
			header("Location: ../../Pantallas/Enfermera/evaluacion.php?id=$id&paciente=$paciente&sesion=$sesion_id&cita=$cita");
			exit();
		}
		else 
		{
			$msg_error = "Ha ocurrido un problema, lo sentimos.";
			header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&msg=$msg_error&cita=$cita&act=procedimientos");
			exit();
		}
	}
	elseif ($tratamiento['cantidad'] == $nro_sesiones) 
	{
		$msg_error = "Disculpe, este procedimiento ya cumplio con la cantidad de sesiones establecidas.";
		header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&msg=$msg_error&cita=$cita&act=procedimientos");
		exit();
	}
	else
	{
		$msg_error = "Ha ocurrido un problema, lo sentimos.";
		header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&msg=$msg_error&cita=$cita&act=procedimientos");
		exit();
	}
}
else
{
	$msg_error = "Disculpe, este procedimiento ya cumplio con la cantidad de sesiones establecidas.";
	header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&msg=$msg_error&cita=$cita&act=procedimientos");
	exit();
}

 ?>