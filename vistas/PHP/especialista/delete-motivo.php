<?php
include ("../../config/datos.php");

$id = $_POST['id'];
$delete = mysql_query("DELETE FROM consulta_motivo WHERE id = '{$id}' LIMIT 1 ");
?>