<?php  
require("../../config/datos.php");	

// ****agrega partes del cuerpo enviadas desde el formulario en el archivo configuraciones.php

	$parte = ucfirst($_POST['parte']);

	$guarda = mysql_query("INSERT INTO ajustes_partescuerpo 
				VALUES(NULL, '$parte')")
				or die('Lo sentimos, ocurrio un error al guardar.');

	include("consulta_partes.php");

?>