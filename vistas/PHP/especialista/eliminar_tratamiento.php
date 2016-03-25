<?php 
include "../../config/datos.php";

$tratamiento_id = $_POST['tratamiento_id'];
$paciente_id = $_POST['paciente_id'];
$paquete_id = $_POST['paquete_id'];

if (isset($_POST['eliminar'])) {
	
	$eliminar = mysql_query("DELETE FROM tratamientos WHERE id='{$tratamiento_id}' ");

	if ($eliminar) {
		
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?paciente=$paciente_id&id=$paquete_id");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?paciente=$paciente_id&id=$paquete_id&msg=$msg_error");
	}		
}

if (isset($_POST['editar'])) {

	$nombre = $_POST['nombre'];
	$cantidad = $_POST['cantidad'];
	$parte = $_POST['parte'];
	$frecuencia = $_POST['frecuencia'];
	$parametros = $_POST['parametros'];
	
	$editar = mysql_query("UPDATE tratamientos SET nombre = '{$nombre}', parte = '{$parte}', cantidad = '{$cantidad}', frecuencia = '{$frecuencia}', parametros = '{$parametros}' WHERE  id='{$tratamiento_id}' LIMIT 1 ");

	if ($editar) {
		
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?paciente=$paciente_id&id=$paquete_id");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?paciente=$paciente_id&id=$paquete_id&msg=$msg_error");
	}		
}



 ?>
