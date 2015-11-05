<?php 
include ("../../config/datos.php");

$paciente_id = $_GET['paciente'];
if ($_GET['on']=="create") 
{
	$nombre = $_GET['nombre'];
	$paquete_nuevo = mysql_query("INSERT INTO paquetes VALUES(NULL, '$nombre', 0, 0, 0, '0', '0', '$paciente_id', NOW(), '' )");

	if ($paquete_nuevo) 
	{
		$id_paquete = mysql_insert_id();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&paquete=$id_paquete&act=procedimientos");
		exit();
	}
	else
	{
		$error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&msg=$error");
		exit();
	}
}

if ($_GET['on']=="update") 
{
	$paquete_id = $_GET['paquete'];
	$update_paquete = mysql_query("UPDATE paquetes SET status = 1 WHERE id = '{$paquete_id}' AND paciente_id = '{$paciente_id}' ");

	if ($update_paquete) {
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&act=procedimientos");
		exit();
	}
	else
	{
		$error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&paquete=$paquete_id&msg=$error");
		exit();
	}
}

?>