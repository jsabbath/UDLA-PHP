<?php 
$tratamiento_id = isset($_GET['id'])?$_GET['id']: "";
//consultas para el modulo de enferemera

//devuelve los diagnosticos del paciente
$tabla_diagnosticos = mysql_query("SELECT * FROM diagnosticos WHERE paciente_id = '{$id}'");

//devolver lista de tratameintos segun paciente

$lista_tratamientos = mysql_query("SELECT * FROM tratamientos WHERE 
					paciente_id = '{$id}' AND 
					tipo = 'cabina' AND 
					status = 0 AND
					status_pago = 1
					 ");

$tratamientos_casa = mysql_query("SELECT * FROM tratamientos WHERE paciente_id = '{$id}' AND tipo = 'casa' ");

//devolver los tratamientos que ya fueron culminadops para un paciente
$tratamiento_culminado = mysql_query("SELECT * FROM tratamientos WHERE paciente_id = '{$id}' AND tipo = 'cabina' AND status = 2 ");

//devolver los tratamientos que estan en proceso por el paciente
$tratamiento_marcha = mysql_query("SELECT * FROM tratamientos WHERE 
						paciente_id = '{$id}' AND 
						tipo = 'cabina' AND 
						status = 1 AND
						status_pago = 1
						");

//devuelve los datos de un tratamiento en especifico para mostrar
$tratamiento = mysql_query("SELECT * FROM tratamientos WHERE paciente_id = '{$id}' AND tipo = 'cabina' AND id = '{$tratamiento_id}' ");

//devuelve los resultados de una evaluacion segun el tratamiento y paciente
$evaluacion = mysql_query("SELECT * FROM control_tratamientos WHERE tratamiento_id = '{$tratamiento_id}' AND paciente_id = '{$id}'");

// consulta de observacions del tratamiento

$observaciones = mysql_query("SELECT * FROM observaciones_tratamiento WHERE tratamiento_id = '{$tratamiento_id}' AND paciente_id = '{$id}'");



// ******** consulta de exmanes solicitadois a un paciente segun su id y cita.
$lista_examenes = mysql_query("SELECT * FROM examenes_solicitados WHERE paciente_id = '{$id}' ");



?>


