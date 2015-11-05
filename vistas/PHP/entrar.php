<?php
session_start();
include "../config/datos.php";
$re=mysql_query("SELECT * FROM usuarios WHERE usuario='".$_POST['Usuario']."' AND 
 					clave='".$_POST['Password']."'")	or die(mysql_error());
	while ($f=mysql_fetch_array($re)) {
		$arreglo[]=array(
			'id'=>$f['id'],
			'nombre'=>$f['nombre'],
			'apellido'=>$f['apellido'],
			'cedula'=>$f['cedula'],
			'telefono'=>$f['telefono'],
			'cargo'=>$f['cargo'],
			'id_nivel'=>$f['id_nivel']);
		$_SESSION['id_usuario']=$f['id'];
		 $_SESSION['id_nivel']=$f['id_nivel']; 
      $_SESSION['nombre']=$f['nombre']; 
       $_SESSION['apellido']=$f['apellido'];
          
		 
		
	}
	 if(isset($arreglo)){
        if ($_SESSION['id_nivel']==0){
          $_SESSION['usuario']=$arreglo;
		   header("Location: ../Pantallas/Especialista/inicio.php");
		
	
          }
          elseif ($_SESSION['id_nivel']==1) {
           $_SESSION['usuario']=$arreglo;
		   header("Location: ../Pantallas/Enfermera/index.php");
          }
            elseif ($_SESSION['id_nivel']==2) {
           $_SESSION['usuario']=$arreglo;
		   header("Location: ../Pantallas/Enfermera/index.php");
          }
            elseif ($_SESSION['id_nivel']==3) {
          $_SESSION['usuario']=$arreglo;
		  header("Location: ../Pantallas/Recepcion/inicio.php");
          }
            elseif ($_SESSION['id_nivel']==4) {
           $_SESSION['usuario']=$arreglo;
		   header("Location: ../Pantallas/Super_admin/inicio.php");
          }

		
	}else{
		header("Location: ../panel_de_control.php?error=invalid");
	}
	


?>