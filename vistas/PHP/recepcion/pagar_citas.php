<?php 
include("../../config/datos.php");
$paciente = $_POST['paciente_id'];
$cita_id = $_POST['cita_id'];
$forma = $_POST['forma_pago'];
$tipo = $_POST['tipo_pago'];
$nro = $_POST['operacion'];
$observacion = $_POST['observacion'];
$monto = $_POST['monto'];
$servicio = "Cita";

$pago = mysql_query("INSERT INTO pagos VALUES(
		NULL,
		'$forma',
		'$nro',
		'$tipo',
		'',
		'$observacion',
		'$monto',
		NOW(),
		'$servicio',
		'$paciente',
		'$cita_id'
		) ");

if ($pago) {

	$update = mysql_query("UPDATE citas SET status_pago = 1 WHERE id = '{$cita_id}' LIMIT 1");

	if($update){
		header("Location: ../../Pantallas/Recepcion/pagar.php?cita=$cita_id&msg=ok");
		exit();	
	}
	else
	{
		header("Location: ../../Pantallas/Recepcion/pagar.php?cita=$cita_id&msg=not");
		exit();
	}
}
else
{
	header("Location: ../../Pantallas/Recepcion/pagar.php?cita=$cita_id&msg=not");
	exit();
}

?>