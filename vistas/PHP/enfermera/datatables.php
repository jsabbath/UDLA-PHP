<?php
	define("cServidor", "localhost");
	define("cUsuario", "root");
	define("cPass","");
	define("cBd","udla_local");

	$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);
	$consulta = "SELECT id, nombre_completo, cedula, telefono FROM pacientes";
	$registro = mysqli_query($conexion, $consulta);

	//guardamos en un array multidimensional todos los datos de la consulta
	$i=0;
	$tabla = "";
	
	while($row = mysqli_fetch_array($registro))
	{
		$tabla.='{"id":"<a class=\'btn btn-default\' href=\'tratamientos_paciente.php?paciente='.$row['id'].'\'>Ver Paciente</a>","nombre_completo":"'.$row['nombre_completo'].'","cedula":"'.$row['cedula'].'","telefono":"'.$row['telefono'].'"},';		
		$i++;
	}
	$tabla = substr($tabla,0, strlen($tabla) - 1);

	echo '{"data":['.$tabla.']}';	
?>