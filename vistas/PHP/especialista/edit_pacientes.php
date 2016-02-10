<?php 
include ("../../config/datos.php");
$id = $_POST['paciente_id'];
$nombre = ucwords($_POST['nombre']);
$cedula = $_POST['cedula'];
$email = $_POST['email'];
$nacimiento = $_POST['nacimiento'];
$estado_civil = $_POST['estado_civil'];
$sexo = $_POST['sexo'];
$ocupacion = $_POST['ocupacion'];
$telefono = $_POST['telefono'];
$estado = $_POST['estado'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];

$editar = mysql_query("UPDATE pacientes SET
			nombre_completo = '{$nombre}',
			cedula = '{$cedula}',
			email = '{$email}',
			fecha_nacimiento = '{$nacimiento}',
			sexo = '{$sexo}',
			telefono = '{$telefono}',
			estado_civil = '{$estado_civil}',
			estado = '{$estado}',
			ciudad = '{$ciudad}',
			direccion = '{$direccion}',
			ocupacion = '{$ocupacion}'
			WHERE id = '{$id}' LIMIT 1
			");

if ($editar) {
	
	header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$id");
}
else
{
	$msg = "Disculpe no se pudo actualizar.".mysql_error();
	header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$id&msg=$msg");
}


?>