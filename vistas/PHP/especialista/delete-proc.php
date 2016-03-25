<?php
include ("../../config/datos.php");

$id = $_POST['id'];
$delete = mysql_query("DELETE FROM tratamientos WHERE id = '{$id}' LIMIT 1 ");
?>