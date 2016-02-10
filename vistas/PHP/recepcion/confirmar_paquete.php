<?php 
include("../../config/datos.php");

$regalo = $_POST['obsequio'];
$total_pagar = $_POST['total_pagar'];
$paciente = $_POST['paciente'];
$paquete_id = $_POST['paquete'];

$update_paq = mysql_query("UPDATE paquetes SET monto_total = '{$total_pagar}', regalo = '{$regalo}', status = 2 WHERE id = '{$paquete_id}' LIMIT 1");

if ($update_paq) {
	header("Location: ../../Pantallas/Recepcion/factura.php?paciente=$paciente&paquete=$paquete_id");
	exit;
}
else{	
	header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete_id");
	exit;
}

?>