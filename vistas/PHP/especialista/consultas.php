<?php 
//consultas para mostrar historial
$id                = isset($_GET['cita'])?$_GET['cita']: "";
$parametro         =0;
$cita_proseso      = mysql_query("SELECT * FROM citas");
if($cita_proseso){
while($dato        =mysql_fetch_assoc($cita_proseso)){ 
$paciente_id       =$dato['paciente_id'];
$todos_pacientes   = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
while($pacientes   = mysql_fetch_array($todos_pacientes)){ 

if ($dato['fecha'] == date('Y-m-d') AND $dato['status']==15 AND $dato['remitido']=='Especialista'){             
$nombre_paciente   = $pacientes['nombre_completo']; 
$cedula_paciente   = $pacientes['cedula']; 
$correo_paciente   = $pacientes['email']; 
$fecha_paciente    = $pacientes['fecha_nacimiento']; 
$sexo_paciente     = $pacientes['sexo']; 
$crated_paciente   = $pacientes['created_at']; 
$id_paciente       = $pacientes['id'];
$cita              =$dato['id']; 
$parametro         =22; 
                    
}}}}
 ?>

 <?php 

$cita_espera = mysql_query("SELECT * FROM citas");


   


  ?>

