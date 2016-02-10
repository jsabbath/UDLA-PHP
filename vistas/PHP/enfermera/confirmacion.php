<?php

        include "../../config/datos.php";

        if ($_GET['status']==0) {

            $sql = mysql_query( "UPDATE citas SET status='1' WHERE id='".$_GET['id']."'");


            if (isset($sql)) {
            header("Location: ../../Pantallas/Recepcion/inicio.php");

            } else {
            echo "NO GUARDO LOS DATOS "; 

            }
        }elseif($_GET['status']==1){

            $sqls = mysql_query("UPDATE citas SET status='2' updated_at=NOW() WHERE id='".$_GET['id']."'");


            if (isset($sqls)) {
            header("Location: ../../Pantallas/Recepcion/inicio.php");

            } else {
            echo "no guardo los datos ";

            }

        }

        elseif($_GET['status']==2){
              $cita_confirmacion = mysql_query("SELECT * FROM citas");
              if($cita_confirmacion){
              
              while($dato    =mysql_fetch_assoc($cita_confirmacion)){ 

            
              }
              
              $sqlst = mysql_query("UPDATE citas SET status='15' WHERE id='".$_GET['id']."'");

              $paciente=$_GET['paciente'];
              if (isset($sqlst)) {
                $cita=$_GET['id'];
              header("Location: ../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=$paciente&cita=$cita");

              }else {

              echo "los datos no guardaron ";
            
              }
              }else {  
              header("Location: ../../Pantallas/Enfermera/index.php?guardo=No_guardo_los_datos");


              }  

       }  ?>