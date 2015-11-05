<?php
include "../../config/datos.php";

$id = $_GET['paciente'];
$cita = $_GET['ids'];

if (isset($_POST['cita_id'])) {
	$sql = mysql_query("UPDATE citas SET status =' 10' WHERE id='".$_POST['cita_id']."'");
	if (isset($sql)) {
		  header("Location: ../../Pantallas/Recepcion/inicio.php");	    
	} 
	else 
	{
	    echo "no guardo los datos ";
	}
}
else
{ 
	$sql = mysql_query("UPDATE citas SET status='10' WHERE id='{$cita}'");
	if (isset($sql)) {
		 header("Location: ../../Pantallas/Recepcion/inicio.php");	    
	} 
	else 
	{
	    echo "no guardo los datos ";
	}
}
?>




