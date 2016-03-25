<?php 
include "../../config/datos.php";
if (isset($_POST['modal'])) {

	$nombre =$_POST['nombre_proc'];
	$parte = $_POST['parte'];
	$cantidad = $_POST['cantidad'];
	$frecuencia = $_POST['frecuencia'];
	$parametros = $_POST['parametros'];
	$tipo = $_POST['tipo'];
	$status = 0;
	$paciente_id = $_POST['paciente_id'];
	$paquete_id = $_POST['paquete_id'];

	$guarda = mysql_query("INSERT INTO tratamientos VALUES(
				NULL, 
				'$nombre', 
				'$parte', 
				'$cantidad', 
				'$frecuencia', 
				'$parametros', 
				'$tipo', 
				'$status',
				'0', 
				'$paciente_id', 
				'$paquete_id', 
				NOW(), 
				'')
			");

	if ($guarda)
	{
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?paciente=$paciente_id&id=$paquete_id");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?paciente=$paciente_id&id=$paquete_id&msg=$msg_error");
	}
}

if (isset($_POST['trat_casa'])) {

	$status = 0;
	$paciente_id = $_POST['paciente_id'];
    $recipe=$_POST['recipe'];
    $explicacion=$_POST['explicacion'];

$guarda = mysql_query("INSERT INTO recipes VALUES(NULL, '{$paciente_id}', '{$recipe}', '{$explicacion}', '{$status}', NOW(),  NOW())");


	if ($guarda)
	{
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&id=$paquete_id&act=cas");

	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&id=$paquete_id&msg=$msg_error&act=cas");
	}
}

?>
