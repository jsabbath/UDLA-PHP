<?php
include "../../config/datos.php";



$sql =  mysql_query("UPDATE pacientes SET email='".$_POST['email']."',
nombre_completo ='".$_POST['nombre']."',
cedula='".$_POST['cedula']."',
telefono='".$_POST['telefono']."',
sexo='".$_POST['sexo']."',
ocupacion='".$_POST['ocupacion']."',
direccion='".$_POST['direccion']."',
estado_civil='".$_POST['estado_civil']."',
fecha_nacimiento='".$_POST['fecha_nacimiento']."' WHERE id='".$_POST['id']."'");


if (isset($sql)) {
	$id=$_POST['id'];
  header("Location: ../../PHP/recepcion/buscar_paciente.php?id=$id");
	    
} else {
    echo " no guardo los datos ";

  }
?>