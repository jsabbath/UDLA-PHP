<?php 
include "../../config/datos.php";

$paquete = $_GET['paquete'];
$paciente = $_GET['paciente'];

$update = mysql_query("UPDATE paquetes SET status = 7 WHERE id = '{$paquete}' LIMIT 1 ");
if ($update) {
	header("Location: ../../Pantallas/Recepcion/paquetes.php?paquete=$paquete&paciente=$paciente");
	exit();
}
else
{
	header("location: .././Pantallas/Recepcion/inicio.php");
	exit();
}

?>