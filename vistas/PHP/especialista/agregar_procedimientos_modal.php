<?php 

include "../../config/datos.php";
$nombre   = trim($_POST['nombre']);
$precio = $_POST['precio'];
$nomenclatura = $_POST['nomenclatura'];


	$sql = mysql_query("INSERT INTO lista_tratamientos VALUES(
				NULL, '$nombre', '$nomenclatura', '$precio')");

	if ($sql){
		$exito = "Exito, el nuevo procedimiento ha sido registrado.";
		header("Location: ../../Pantallas/Especialista/procedimientos.php?exito_guardo=save");
	}
	else 
	{
		$error = "Ha ocurrido un problema, no se pudo registrar el nuevo procedimiento.";
		header("Location: ../../Pantallas/Especialista/procedimientos.php?error=$error");
	}
?>