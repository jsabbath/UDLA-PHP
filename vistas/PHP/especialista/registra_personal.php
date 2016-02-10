<?php 
require("../../config/datos.php");

$nombre = ucwords($_POST['nombre']);
$porcentaje = $_POST['porcentaje'];
$stado = $_POST['stado'];

$insertar = mysql_query("INSERT INTO porcentaje VALUE(NULL, '$nombre', '$porcentaje', '$stado')");


?>