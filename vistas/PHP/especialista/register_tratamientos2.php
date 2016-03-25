<?php 
include "../../config/datos.php";	
// ****agrega tratamientos desde el formulario en el archivo Ver_historial.php 

	$nombre =$_POST['nombre'];
	$parte = $_POST['parte'];
	$cantidad = $_POST['cantidad'];
	$frecuencia = $_POST['frecuencia'];
	$parametros = $_POST['parametros'];
	$tipo = "cabina";
	$status = 0;
	$id = $_POST['paciente_id'];
	$paquete_id = $_POST['paquete_id'];
	$obsequio = $_POST['obsequio'];
	
	for ($i=0;$i<count($nombre);$i++) 
	{
		if(trim($nombre[$i] )!= "")
		{
			
		$guarda = mysql_query("INSERT INTO tratamientos VALUES(NULL, '$nombre[$i]', '$parte[$i]', '$cantidad[$i]', '$frecuencia[$i]', '$parametros[$i]', 
				'$tipo', '$status', '0',  '$id', '$paquete_id', NOW(), '')");
		}
	}

	if ($guarda) 
	{
		if (count($obsequio) > 0) {
			for ($i=0; $i < count($obsequio); $i++) { 
				$regalo .= $obsequio[$i]." + ";
			}
			$regalo = rtrim($regalo, "+ ");
			$up = mysql_query("UPDATE paquetes SET regalo = '{$regalo}' WHERE id = '{$paquete_id}' LIMIT 1");
		}
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$id&paquete=$paquete_id&act=procedimientos");
		exit();
	}
	else
	{
		$error = "no se ha podido registrar procedimientos, al parecer no selecciono ninguno";
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$id&paquete=$paquete_id&act=procedimientos&error=$error");
		exit();
	}

?>