<?php 
require("../../config/datos.php");

$id = $_POST['id'];

$delete = mysql_query("DELETE FROM porcentaje WHERE id = '$id' LIMIT 1");


?>