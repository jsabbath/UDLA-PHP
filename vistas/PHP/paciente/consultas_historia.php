<?php 
//consultas para mostrar historial
$id = isset($_GET['paciente'])?$_GET['paciente']: "";

//selecciona todos los usuarios
$todos_pacientes = mysql_query("SELECT * FROM pacientes");

//consulta y recuperacion de datos para tabla: pacientes
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$id}'");
$paciente = mysql_fetch_array($tabla_pacientes);

//consulta y recuperacion de datos para tabla: antecedentes_personales
$tabla_antecedente_pers = mysql_query("SELECT * FROM antecedentes_personales WHERE paciente_id = '{$id}'");

$tabla_antecedentes_familiares = mysql_query("SELECT * FROM antecedentes_familiares WHERE paciente_id = '{$id}'");

$tabla_alergias = mysql_query("SELECT * FROM alergias WHERE paciente_id = '{$id}'");
//$alergias = mysql_fetch_assoc($tabla_alergias);

$tabla_alertas = mysql_query("SELECT * FROM alertas WHERE id_paciente = '{$id}'");
$alertas = mysql_fetch_assoc($tabla_alertas);

$tabla_operaciones = mysql_query("SELECT * FROM operaciones WHERE paciente_id = '{$id}' AND operado LIKE 'si' ");

$tabla_trat_previos = mysql_query("SELECT * FROM tratamientos_previos WHERE paciente_id = '{$id}'");

$tabla_examenes = mysql_query("SELECT * FROM examenes WHERE paciente_id = '{$id}'");

$tabla_cremas = mysql_query("SELECT * FROM cremas WHERE paciente_id = '{$id}'");
$cremas = mysql_fetch_assoc($tabla_cremas);

$tabla_habitos = mysql_query("SELECT * FROM habitos WHERE paciente_id = '{$id}'");
$habitos = mysql_fetch_assoc($tabla_habitos);


$sexo = mysql_query("SELECT sexo FROM pacientes WHERE id='{$id}'");
$res = mysql_fetch_assoc($sexo);
if($res['sexo'] == 'Masculino')
{
	$tabla_preg_hombre = mysql_query("SELECT * FROM preg_hombre WHERE paciente_id = '{$id}'");
	$preg_sexo = mysql_fetch_assoc($tabla_preg_hombre); 
}
else
{
	$tabla_preg_mujer = mysql_query("SELECT * FROM preg_mujer WHERE paciente_id = '{$id}'");
	$preg_sexo = mysql_fetch_assoc($tabla_preg_mujer); 
}

//consulta si elñ paciente posee paquete
$paquetes_pac = mysql_query("SELECT * FROM paquetes WHERE  paciente_id ='{$id}' ORDER BY created_at DESC");

// ************ Consulta disgnosticos del paciente
$tabla_diagnosticos = mysql_query("SELECT * FROM diagnosticos WHERE paciente_id = '{$id}'");

// **************** listado de tratamientos
$lista_tratamientos = mysql_query("SELECT * FROM lista_tratamientos ORDER BY nombre ASC "); 

// consulta los tratamientos segun paciente y tipo de tratamiento = cabina
$tratamientos_cabina = mysql_query("SELECT * FROM tratamientos WHERE paciente_id = '{$id}' AND tipo = 'cabina' ");

// consulta los tratamientos segun paciente, cita y tipo de tratamiento = casa
$tratamientos_casa = mysql_query("SELECT * FROM recipes WHERE paciente_id = '{$id}' ");

// ******** consulta de exmanes solicitadois a un paciente segun su id y cita.
$lista_examenes = mysql_query("SELECT * FROM examenes_solicitados WHERE paciente_id = '{$id}' ");

$patologias_0 = mysql_query("SELECT * FROM diagnosticos WHERE paciente_id = '{$id}' AND status = 1 ");

?>