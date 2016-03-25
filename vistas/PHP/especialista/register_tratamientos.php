<?php 
include "../../config/datos.php";	

// ****agrega tratamientos desde el formulario en el archivo Ver_historial.php 


	$nombre =$_POST['procedimiento'];
	$parte = $_POST['parte'];
	$cantidad = $_POST['cantidad'];
	$frecuencia = $_POST['frecuencia'];
	$parametros = $_POST['parametros'];
	$tipo = $_POST['tipo'];
	$status = 0;
	$id = $_POST['paciente'];
	$paquete_id = $_POST['paquete'];

	$guarda = mysql_query("INSERT INTO tratamientos 
				VALUES(NULL, '$nombre', '$parte', '$cantidad', '$frecuencia', '$parametros', 
				'$tipo', '$status', '0',  '$id', '$paquete_id', NOW(), '')")
				or die('Lo sentimos, ocuarrio un error al guardar.');

	include("consulta_procedimientos.php");

?>