<?php 
//consultas para mostrar historial
$id = isset($_GET['cita'])?$_GET['cita']: "";

//selecciona todas las citas
$todas_las_citas = mysql_query("SELECT * FROM citas");

$todas_las_citas_3 = mysql_query("SELECT * FROM citas");
//Cita por paciente


//consulta y recuperacion de datos para tabla: antecedentes_personales





 ?>