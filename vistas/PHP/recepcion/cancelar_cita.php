<?php
include "../../config/datos.php";

$cita = $_POST['id'];

	$sql = mysql_query("UPDATE citas SET status = 10, updated_at = NOW() WHERE id ='{$cita}' LIMIT 1");

?>




