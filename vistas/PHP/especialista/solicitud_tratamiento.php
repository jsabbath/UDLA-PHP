<?php 
include "../../config/datos.php";
$tratamiento_id = $_GET['id_tratamiento'];
$paciente_id   =$_GET['paciente'];
$aprobado = $_POST['aprobar'];
$denegar = $_POST['denegar'];

if ($aprobado=='Aprobar') {


$editar = mysql_query("UPDATE cambio_tratamiento SET status = 1 WHERE tratamiento_id = '{$tratamiento_id}' AND paciente_id = '{$paciente_id}' ");

if ($editar) {

   $consulta_cambio_tratamientos=mysql_query("SELECT * FROM cambio_tratamiento WHERE tratamiento_id = '{$tratamiento_id}' AND paciente_id = '{$paciente_id}' ");
   $data = mysql_fetch_assoc($consulta_cambio_tratamientos);
   $frecuencia=$data['frecuencia'];
      $parametro=$data['parametro'];

if ($data['frecuencia']!='' AND $data['frecuencia_obser'] != '') {
$editar_2 = mysql_query("UPDATE tratamientos SET frecuencia = '{$frecuencia}'  WHERE id = '{$tratamiento_id}' AND paciente_id = '{$paciente_id}' ");
}
if ($data['parametro']!='' AND $data['parametro_obser'] != '') {
$editar_2_2 = mysql_query("UPDATE tratamientos SET parametros= '{$parametro}'  WHERE id = '{$tratamiento_id}' AND paciente_id = '{$paciente_id}' ");
}

if ($editar_2 OR $editar2_2) {
	header("Location: ../../Pantallas/Especialista/inicio.php");
	exit();
}else {$msg_error = "Ha ocurrido un problema, lo sentimos.";
	header("Location: ../../Pantallas/Especialista/solicitud_cambio_tratamiento.php?paciente=$paciente_id&id=$tratamiento_id&msg=$msg_error");
	exit();  }

}else {

	$msg_error = "Ha ocurrido un problema, lo sentimos.";
	header("Location: ../../Pantallas/Especialista/solicitud_cambio_tratamiento.php?paciente=$paciente_id&id=$tratamiento_id&msg=$msg_error");
	exit();
}
}elseif ($denegar=='Denegar') {

$editar = mysql_query("UPDATE cambio_tratamiento SET status = 2 WHERE tratamiento_id = '{$tratamiento_id}' AND paciente_id = '{$paciente_id}' ");

if ($editar) {

	header("Location: ../../Pantallas/Especialista/inicio.php");
	exit();
}
else {

	$msg_error = "Ha ocurrido un problema, lo sentimos.";
	header("Location: ../../Pantallas/Especialista/solicitud_cambio_tratamiento.php?paciente=$paciente_id&id=$tratamiento_id&msg=$msg_error");
	exit();
}
}else{

header("Location: ../../Pantallas/Especialista/solicitud_cambio_tratamiento.php?paciente=$paciente_id&id=$tratamiento_id&msg_llenar=$msg_error");
}




 ?>