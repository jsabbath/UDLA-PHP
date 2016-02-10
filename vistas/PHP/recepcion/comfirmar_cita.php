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

            $sqls = mysql_query("UPDATE citas SET status='2', updated_at=NOW() WHERE id='".$_GET['id']."'");


            if (isset($sqls)) {
            header("Location: ../../Pantallas/Recepcion/inicio.php");

            } else {
            echo "no guardo los datos ";

            }

        }

        elseif($_GET['status']==2){
              $cita_confirmacion = mysql_query("SELECT * FROM citas");
              if($cita_confirmacion){
              $i=0;
              $n=0;
              while($dato    =mysql_fetch_assoc($cita_confirmacion)){ 

              if ($dato['status']==15 AND $dato['remitido']=='Especialista' ) {
              $i++;

              }else{ 
              $n++;
              }}
              if ($i==0 AND $n>0) {
              $sqlst = mysql_query("UPDATE citas SET status='3' WHERE id='".$_GET['id']."'");


              if (isset($sqlst)) {
              $id_paciente=$_GET['paciente'];
              header("Location: ../../Pantallas/Especialista/ver_historial.php?paciente=$id_paciente");

              }else {

              echo "los datos no guardaron ";
            
              }
              }else {  
              header("Location: ../../Pantallas/Especialista/inicio.php?guardo=No_guardo_los_datos");


              }  }else{ echo 'error de coneccion';} 

       }  ?>
                 
                 
                 

