<?php 
include ("../../config/datos.php");

	date_default_timezone_set('America/Caracas');
	$hoy = date('Y-m-d');

	$descripcion = $_POST['descripcion'];
	$forma = $_POST['forma_egreso'];
	$nro_operacion = $_POST['operacion'];
	$monto = $_POST['monto'];


	$guarda = mysql_query("INSERT INTO gastos_diarios VALUES(
		NULL, 
		'$descripcion', 
		'$forma', 
		'$nro_operacion', 
		'$monto',
		'$hoy' )"
	);

	if ($guarda)
	{
		header("Location: ../../Pantallas/Especialista/morbilidad.php#gastos");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/morbilidad.php?msg=$msg_error#gastos");
	}
?>