<?php 
include "../../config/datos.php";
$paq_id = $_GET['paq'];

$sql = mysql_query("SELECT * FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paq_id}' ");

$arr = array();
while ($resul = mysql_fetch_assoc($sql)) {
	$arr[] =  $resul;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($arr);
?>