<?php 
require("../../config/datos.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$porcentaje = $_POST['porcentaje'];
$stado = $_POST['stado'];

$insertar = mysql_query("UPDATE porcentaje SET nombre = '$nombre', dividendo ='$porcentaje', status = '$stado' WHERE id = '$id' LIMIT 1");


?>