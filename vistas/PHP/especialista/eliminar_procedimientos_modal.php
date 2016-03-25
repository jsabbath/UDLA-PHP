<?php 
include "../../config/datos.php";
$id = $_POST['id'];

 	$sql = mysql_query("DELETE FROM lista_tratamientos WHERE id='{$id}' LIMIT 1");

	if ($sql){
		header("Location: ../../Pantallas/Especialista/configuraciones.php?elimino=exito");
	}
	else 
	{
		$error = "Ha ocurrido un problema, no se pudo eliminar el procedimiento.";
		header("Location: ../../Pantallas/Especialista/configuraciones.php?error=$error");
	}

 ?>