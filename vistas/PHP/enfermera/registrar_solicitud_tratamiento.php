<?php

include("../../config/datos.php");


$frecuencia = $_POST['frecuencia'];
$frecuencia_obser = $_POST['frecuencia_obser'];
$parametro = $_POST['parametro'];
$parametro_obser= $_POST['parametro_obser'];
$id_tratamiento = $_GET['id_tratamiento'];
$paciente_id = $_GET['paciente'];
$usuario_id = $_GET['usuario'];


/*
echo $frecuencia;
echo $frecuencia_obser;
echo $parametro;
echo $parametro_obser;
echo $id_tratamiento;
echo $paciente_id ;
*/
$consulta= mysql_query("SELECT * FROM cambio_tratamiento WHERE tratamiento_id='{$id_tratamiento}'");
if (mysql_num_rows($consulta)>0) {
header("Location: ../../Pantallas/Enfermera/cambiar_tratamiento.php?msg_existe=no_existe&paciente=$paciente_id&id=$id_tratamiento");
	exit;
}else{

if (($frecuencia != '' AND $frecuencia_obser != '') OR ($parametro != '' AND $parametro_obser !='' )) {

	$guarda = mysql_query("INSERT INTO cambio_tratamiento VALUES(NULL, '".strtoupper($frecuencia)."', '$frecuencia_obser', '".strtoupper($parametro)."', '$parametro_obser', '0', '$paciente_id', '$id_tratamiento', '$usuario_id', NOW(), '' )");
        if ($guarda) {
       header("Location: ../../Pantallas/Enfermera/cambiar_tratamiento.php?msg_guardo=no_existe&paciente=$paciente_id&id=$id_tratamiento");
	  exit;
          }else{


header("Location: ../../Pantallas/Enfermera/cambiar_tratamiento.php?msg_error=no_existe&paciente=$paciente_id&id=$id_tratamiento");


	exit;


}  } else{

header("Location: ../../Pantallas/Enfermera/cambiar_tratamiento.php?msg_llenar=no_existe&paciente=$paciente_id&id=$id_tratamiento");
	exit;
}
}


?>