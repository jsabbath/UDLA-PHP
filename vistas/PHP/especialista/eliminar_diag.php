<?php 
require("../../config/datos.php");

$id = $_POST['id'];

$delete = mysql_query("DELETE FROM patologias WHERE id = '$id' LIMIT 1")
			or die('Lo sentimos, ocurrio un error al guardar.');

//include('consulta_partes.php');

 ?>