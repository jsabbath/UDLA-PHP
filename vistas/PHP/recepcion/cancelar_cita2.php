<?php
include("../../config/datos.php");

$cita = $_GET['cita'];

	$citas = mysql_query("SELECT id FROM citas WHERE id = '{$cita}' LIMIT 1");
	if (mysql_num_rows($citas) == 1) {
		$sql = mysql_query("UPDATE citas SET status = 10, updated_at = NOW() WHERE id ='{$cita}' LIMIT 1");
		if ($sql) {
			header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?act=citas&msg_cita=La cita ha sido cancelada con exito.");
			exit();
		}
		else
		{
			header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?act=citas&error_cita=Ha ocurrido un error al tratar de cancelar la cita.");
			exit();
		}
	}
	else {
		header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?act=citas&error_cita=Ha ocurrdo un error, no se encontro el registro de la cita.");
		exit();
	}

?>