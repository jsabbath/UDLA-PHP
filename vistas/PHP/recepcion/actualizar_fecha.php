<?php
include "../../config/datos.php";

	$fecha = $_POST['fecha'];
	$id = $_POST['id'];
	
	$sql = mysql_query("UPDATE citas SET fecha = '{$fecha}', status = 0 
			WHERE id = '{$id}' LIMIT 1");
 
?>