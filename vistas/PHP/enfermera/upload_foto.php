<?php 
include("../../config/datos.php");

$titulo = "Fotografia de procedimientos";
$tipo = $_POST['tipo'];
$paciente = $_POST['paciente'];
$tratamiento = $_POST['tratamiento_id'];
$sesion_id = $_POST['sesion_id'];


if(copy($_FILES['foto']['tmp_name'],$_FILES['foto']['name']))
{
	$nom = $_FILES['foto']['name'];
	$ruta_destino = "../../../img/procedimientos/";
	move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino.$nom);

	$guarda_nombre = mysql_query("INSERT INTO fotos_tratamientos VALUES(NULL, '$nom', '$titulo', '$tipo', '$tratamiento', '$paciente','$sesion_id', NOW(), '' ) ");

	if ($guarda_nombre) {
		$msg = "ok";
		header("Location: ../../Pantallas/Enfermera/aplicando.php?id=$tratamiento&paciente=$paciente&msg=$msg&sesion=$sesion_id");
		exit;

	}
	else{
		$msg = "no";
		header("Location: ../../Pantallas/Enfermera/aplicando.php?id=$tratamiento&paciente=$paciente&msg=$msg&sesion=$sesion_id");
		exit;
	}
}
	 
?>

