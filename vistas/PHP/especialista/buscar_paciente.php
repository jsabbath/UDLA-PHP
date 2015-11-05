<?php
include "../../config/datos.php";
$cedula=$_POST['ci']."-".$_POST['cedula'];



      $re=mysql_query("SELECT * from pacientes WHERE cedula='$cedula'");
     if ($verificar= mysql_num_rows($re)>0) { 

      while ($f=mysql_fetch_array($re)) {
   
            
             $id=$f['id'];
             $cedula_paciente=$f['cedula'];

              }
              if ($cedula_paciente==$cedula) {
              	
		     header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$id");
              
             
             
   }else{

header("Location: ../../Pantallas/Especialista/inicio.php?error=datos no validos");  

   }}else{ header("Location: ../../Pantallas/Especialista/inicio.php?error=datos no validos");   }?>