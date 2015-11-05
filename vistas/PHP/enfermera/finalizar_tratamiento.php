<?php 
include "../../config/datos.php";
$id = $_POST['tratamiento'];
$paciente = $_POST['paciente'];
$sesion_id = $_POST['sesion_id'];
$usuario_id = $_POST['nombre'];
$cita = $_GET['cita'];

  
	$reporte = mysql_query("INSERT INTO reportes VALUES(NULL, '$paciente', '$id', '$usuario_id','$cita', NOW()) ");

if ($reporte) {
	$cita_numero = mysql_query("UPDATE citas SET status = 3 WHERE id = '{$cita}' AND paciente_id = '{$paciente}' LIMIT 1 ");
 
  $sesion = mysql_query("SELECT * FROM sesiones_procedimientos WHERE id = '{$sesion_id}' AND tratamiento_id = '{$id}' LIMIT 1 ");
$data_sesion = mysql_fetch_assoc($sesion);

$tratamientos = mysql_query("SELECT * FROM tratamientos WHERE id = '{$id}' AND paciente_id = '{$paciente}' LIMIT 1 ");
$data_tratamiento = mysql_fetch_assoc($tratamientos);

/*echo "cantidad tratamiento: " .$data_tratamiento['cantidad'];

echo "nro de sesion: " . $data_sesion['nro'];*/
if ($data_tratamiento['cantidad'] == $data_sesion['nro'] ) 
{
	$editar = mysql_query("UPDATE tratamientos SET status = 2, updated_at = NOW() WHERE id = '{$id}' AND paciente_id = '{$paciente}' LIMIT 1 ");

	if ($editar) {
		
		header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&cita=&cita&act=procedimientos");
		exit();
	}
	else {

		$msg_error = "Ha ocurrido un problema, lo sentimos.";
		header("Location: ../../Pantallas/Enfermera/finalizar_tratamiento.php?paciente=$paciente&msg=$msg_error&cita=$cita");
		exit();
	}
}
elseif ($data_tratamiento['cantidad'] > $data_sesion['nro']) 
{
	header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&cita=$cita&act=procedimientos");
	exit();
}
else
{
	header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&cita=$cita&act=procedimientos");
	exit();
}
}else {  
/*header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&cita=$cita&act=procedimientos&error=error");
	exit();
*/
	echo "string";
}



 ?>