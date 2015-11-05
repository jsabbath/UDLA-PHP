<?php 
include "../../config/datos.php";
$id = $_POST['id'];
$nombre   = trim($_POST['nombre']);
$precio = $_POST['precio'];
$nomenclatura = $_POST['nomenclatura'];


	$sql = mysql_query("UPDATE lista_tratamientos SET 
			nombre = '{$nombre}', 
			nomenclatura = '{$nomenclatura}', 
			precio = '{$precio}' 
			WHERE id = '{$id}' ");

	if (mysql_affected_rows($sql) != '-1'){
		header("Location: ../../Pantallas/Especialista/procedimientos.php?exito=exito");
	}
	else 
	{
		$error = "Ha ocurrido un problema, no se pudo editar el procedimiento. ".mysql_error();
		header("Location: ../../Pantallas/Especialista/procedimientos.php?error=$error");
	}
?>