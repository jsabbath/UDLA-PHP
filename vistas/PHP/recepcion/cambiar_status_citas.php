<?php 
include "../../config/datos.php";
$id = $_POST['id'];
$status = $_POST['status'];
	
	$sql = mysql_query("UPDATE citas SET updated_at = NOW(), status = '{$status}' 
			WHERE id = '{$id}' LIMIT 1");
 ?>