<?php
include ("../../config/datos.php");

$id = $_POST['id'];
$delete = mysql_query("DELETE FROM alertas WHERE id = '{$id}' LIMIT 1 ");
?>