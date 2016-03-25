<?php
include "../../config/datos.php";
$cita=$_GET['id'];
$paciente=$_GET['paciente'];

if ($_GET['status']==0) {

    $sql = mysql_query("UPDATE citas SET status='1' WHERE id='".$_GET['id']."'");
    if ($sql) {
      header("Location: ../../Pantallas/Recepcion/inicio.php");
      exit();
    }
    else 
    {
      
    }
}
elseif($_GET['status']==1)
{
    $sqls = mysql_query("UPDATE citas SET status = '2' updated_at=NOW() WHERE id='".$_GET['id']."'");
    if ($sqls) {
      header("Location: ../../Pantallas/Recepcion/inicio.php");
      exit();
    } 
    else {
      echo "no guardo los datos ";
    }
}
elseif($_GET['status']==2)
{         
    $sqlst = mysql_query("UPDATE citas SET status='15' WHERE id='".$_GET['id']."'");
    
    if ($sqlst){       
        header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&cita=$cita");
    }
    else 
    {
        echo "los datos no guardaron ";   
    }
}  
?>