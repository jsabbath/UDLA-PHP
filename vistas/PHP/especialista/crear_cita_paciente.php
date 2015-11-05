 
<?php
include "../../config/datos.php";

    $cedula= $_POST['ci']."-".$_POST['cedula'];

    $consulta = mysql_query("SELECT * FROM pacientes WHERE cedula='$cedula'");
    if (mysql_num_rows($consulta)>0) {
       while($rows = mysql_fetch_array($consulta))
        { 
            $paciente_id=$rows['id'];
    
    }

    $result = mysql_query("SELECT * FROM citas WHERE paciente_id='$paciente_id'");


$i=0;
$n=0;
if (mysql_num_rows($result)>0) {
 while($row = mysql_fetch_array($result))
{

    if ($row['status']==0 OR $row['status']==1 OR $row['status']==2 OR $row['status']==3 ) {
    
       $i++;

    }elseif ($row['status']==10 OR $row['status']==15){ 
   
       $n++;

}
}




if($i==0 AND $n>0){

     // Con esta sentencia SQL insertaremos los datos en la base de datos
        mysql_query("INSERT INTO citas (id,tipo,fecha,status,paciente_id,remitido,created_at,updated_at)
        VALUES (NULL,'{$_POST['consulta']}','{$_POST['fecha']}','0','$paciente_id','{$_POST['nota']}', NOW(),'')");

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error();

        if(!empty($my_error)) {

            echo "Ha habido un error al insertar los valores. $my_error";

        } 


header("Location: ../../Pantallas/Especialista/Crear_cita.php?guardado=guardo con exito");
      


}else{
       
   


header("Location: ../../Pantallas/Especialista/crear_cita.php?error_listo=no guardo los datos");


}   
}else{
 mysql_query("INSERT INTO citas (id,tipo,fecha,status,paciente_id,remitido,created_at,updated_at)
        VALUES (NULL,'{$_POST['consulta']}','{$_POST['fecha']}','0','$paciente_id','{$_POST['nota']}', NOW(),'')");

        // Ahora comprobaremos que todo ha ido correctamente
        $my_error = mysql_error();

        if(!empty($my_error)) {

            echo "Ha habido un error al insertar los valores. $my_error";

        } 


header("Location: ../../Pantallas/Especialista/crear_cita.php?guardado=guardo con exito");
      

    
}

}else {
header("Location: ../../Pantallas/Especialista/crear_cita.php?error_paciente=no guardo los datos");

}


?>