<?php
session_start();
include "../../config/datos.php";
if (isset($_GET['id'])) {

  $id_pacente=$_GET['id'];
   }elseif (isset($_GET['paciente'])) {
  $id_pacentes=$_GET['paciente'];
  
  }else{
$id_pacente=0;
$id_pacentes=0;
}




      $re=mysql_query("SELECT * from pacientes WHERE cedula='".$_POST['ci']."-".$_POST['cedula']."' OR id='".$id_pacente."' OR id='".$id_pacentes."'");
     if ($verificar= mysql_num_rows($re)>0) { 

      while ($f=mysql_fetch_array($re)) {
   
             $_SESSION['nombre_completo']=$f['nombre_completo'];
             $_SESSION['email']=$f['email']; 
             $_SESSION['fecha_nacimiento']=$f['fecha_nacimiento'];
             $_SESSION['cedula']=$f['cedula'];
             $_SESSION['telefono']=$f['telefono'];
             $_SESSION['direccion']=$f['direccion'];
             $_SESSION['sexo']=$f['sexo'];
             $_SESSION['estado_civil']=$f['estado_civil'];
             $_SESSION['ocupacion']=$f['ocupacion'];
             $_SESSION['id']=$f['id'];

              }
              if ($_SESSION['cedula']==$_POST['ci']."-".$_POST['cedula'] or $_SESSION['id']==$_GET['paciente'] ) {
              	if (isset($_GET['cita_id'])) {
                  header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?cita_id=existe");
         
         
                }else { 

                  header("Location: ../../Pantallas/Recepcion/buscar_paciente.php");
                }
		     
              
              }elseif (isset($_GET['id'])) {
               if($_SESSION['id']==$_GET['id']){
         header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?guardado=con_exito");  

              }
             
   }else{

header("Location: ../../Pantallas/Recepcion/inicio.php?error=datos no validos");  

   }}else{ header("Location: ../../Pantallas/Recepcion/inicio.php?error=datos no validos");   }



   ?>