<?php 
include "../../config/datos.php";
$porciento = $_POST['porcentaje'];
$lista_tra = mysql_query("SELECT * FROM lista_tratamientos ");
$updates = 0;

while ($lista = mysql_fetch_assoc($lista_tra)) {
	
	$aumento  = ($lista['precio'] * $porciento) / 100;
	$total = $aumento + $lista['precio'];
	//$total = $porciento;

	$actualizar = mysql_query("UPDATE lista_tratamientos SET precio = '{$total}' WHERE id = '{$lista['id']}' LIMIT 1 ");
	
	if ($actualizar) {
		
		$updates++;
	}
}

if ($actualizar) {	
	header("Location: ../../Pantallas/Especialista/configuraciones.php?msgp=ok&exit=$updates#cabioprecios");
	exit();
}
else
{
	header("Location: ../../Pantallas/Especialista/configuraciones.php?error=ok#cabioprecios");
	exit();
}




?>