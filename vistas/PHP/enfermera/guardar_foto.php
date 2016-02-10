<?php 
include("../../config/datos.php");

$foto = $_POST['src'];
$titulo = "Fotografia de procedimientos";
$tipo = $_POST['tipo'];
$paciente = $_GET['paciente'];
$tratamiento = $_GET['id'];

$guarda = mysql_query("INSERT INTO fotos_tratamientos VALUES(NULL, '$foto', '$titulo', '$tipo','$tratamiento', '$paciente', NOW(), '') ");

if ($guarda) {
	$msg = "ok";
	header("Location: ../../Pantallas/Enfermera/foto_tratamiento.php?id=$tratamiento&paciente=$paciente&msg=$msg");
	exit;

}
else{
	$msg = mysql_error();
	echo $msg;

	//header("Location: ../../Pantallas/Enfermera/foto_tratamiento.php?id=$tratamiento&paciente=$paciente");
	//exit;
}

?>