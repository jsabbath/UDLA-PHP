<?php 
include("../../config/datos.php");

$foto = $_POST['src'];
$titulo = "segunda foto";
$tipo = "post";
$paciente = $_GET['paciente'];
$tratamiento = $_GET['id'];

$guarda = mysql_query("INSERT INTO fotos_tratamientos VALUES(NULL, '$foto', '$titulo', '$tipo','$tratamiento', '$paciente', NOW(), '') ");

if ($guarda) {
	
	header("Location: ../../Pantallas/Enfermera/observacion_tratamiento.php?id=$tratamiento&paciente=$paciente");
	exit;

}
else{
	$msg_error = mysql_error();
	header("Location: ../../Pantallas/Enfermera/foto_tratamiento_post.php?id=$tratamiento&paciente=$paciente");
	exit;
}

?>