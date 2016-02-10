<?php
include "../../config/datos.php";
	$paquete = $_GET['paquete'];
	$paciente = $_GET['paciente']; 
	
	$delete = mysql_query("DELETE FROM paquetes WHERE id = '{$paquete}' LIMIT 1 ");

	if ($delete) {
		
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente&act=procedimientos");
	}
	else
	{
		$error = "Disculpe, ocurrio un error al eliminar el paquete.".mysql_error();
		header("Location: ../../Pantallas/Especialista/detalle_paquete.php?id=$paquete&paciente=$paciente&msg=$error");
	}
?>