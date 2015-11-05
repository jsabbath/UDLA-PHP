<?php  
include "../../config/datos.php";	

// ****agrega observaciones desde el formulario en el archivo Ver_historial.php 

	$id = $_POST['paciente_id'];
	$obs = ucfirst($_POST['obs']);

	$guarda = mysql_query("INSERT INTO observacion_general 
				VALUES(NULL, '$obs', NOW(), '$id')")
				or die('Lo sentimos, ocurrio un error al guardar.');

	include("consulta_obs.php");

?>