<?php 
include "../../config/datos.php";



if (isset($_POST['patologias_detalles'])) {


$detalles = $_POST['detalles'];
$paciente_id= $_POST['paciente_id'];
$id= $_POST['id'];
$n=0;
$i= $_POST['contador'];

while ($n<$i) {
	$sql = mysql_query("UPDATE diagnosticos SET detalle='{$detalles[$n]}', status =0 WHERE id='{$id[$n]}'");

$n++;
}
if ($sql) {
	header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&act=");
	
}else{ 

		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&msg=$msg_error");
	
  }

}else 
{

$patologias = $_POST['item'];
	//$cita_id = $_POST['cita_id'];
	$paciente_id = $_POST['paciente_id'];

	foreach($patologias as $patologia)
	{
		$guarda = mysql_query("INSERT INTO diagnosticos VALUES(NULL, '$patologia', '', '$paciente_id', 1, NOW(), '')");

	}


	if ($guarda)
	{
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&status_patologia=0");
	}
	else
	{
		$msg_error = mysql_error();
		header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$paciente_id&msg=$msg_error");
	}

}


?>



