<?php 
	include('../../config/datos.php');
	$pat = ucfirst($_POST['patologia']);

	$insertar = mysql_query("INSERT INTO patologias VALUES(NULL, '{$pat}' )") 
				or die("Ha ocurrido un error al guardar");


 ?>