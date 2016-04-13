<?php
include "../../config/datos.php";
date_default_timezone_set('America/Caracas');
$fecha_cita=$_POST['fecha'];
$motivo=$_POST['consulta'];
$nota = $_POST['nota'];
$nro_consulta = $_POST['nro_historia'];
$cedula= $_POST['ci']."-".$_POST['cedula'];
$dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
$fecha_dia = $dias[date('N', strtotime($fecha_cita))]; 
$fecha= mysql_query("SELECT * FROM citas WHERE created_at='$fecha_cita' AND status = 0");

if (mysql_num_rows($fecha) < 60 AND ($fecha_dia == 'Martes' OR $fecha_dia =='Jueves') AND ($motivo=='Nuevo' OR $motivo=='Control')) 
{
    $consulta = mysql_query("SELECT * FROM pacientes WHERE cedula='$cedula'");
    if (mysql_num_rows($consulta) > 0)
     {
        $rows = mysql_fetch_array($consulta);
        $paciente_id= $rows['id']; 
        $result = mysql_query("SELECT * FROM citas WHERE paciente_id='$paciente_id' AND fecha = '{$fecha_cita}' AND (status = 0 OR status = 1 OR status = 2 OR status = 15 OR status = 100)");
        if (mysql_num_rows($result)>0) 
        {
          $msg = "El paciente ya tiene una cita creada.";
          header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
          exit();
        }
        else
        {
            $inserta = mysql_query("INSERT INTO citas VALUES (NULL,'{$motivo}','{$fecha_cita}','{$nro_consulta}','0','$paciente_id','{$nota}', '0', '0', NOW(),'')");
            if ($inserta) 
            {
              $msn = "La cita fue creada con exito.";
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msn=$msn");
              exit();
            }
            else
            {
              $msg = "Error al guardar la cita en la base de datos. ".mysql_error();
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
              exit();
            }
        }
     }
     else 
     {
        $paciente= mysql_query("INSERT INTO pacientes (id,nombre_completo,cedula,email,fecha_nacimiento,sexo,telefono,estado_civil,direccion,ocupacion,remitido,quien,avatar,progreso,representante_id,created_at,updated_at)
        VALUES (NULL,'".ucwords($_POST['nombre'])."','$cedula','','','','{$_POST['telefono']}','','','','','','','1','', NOW(),'')");
        if ($paciente) 
        {
            $paciente_id_2 = mysql_insert_id();
            $inserta = mysql_query("INSERT INTO citas VALUES (NULL,'{$motivo}','{$fecha_cita}','{$nro_consulta}','0','$paciente_id_2','{$nota}', '0', '0', NOW(),'')");
            if ($inserta) 
            {
              $msn = "La cita fue creada con exito.";
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msn=$msn");
              exit();
            }
            else
            {
              $msg = "Error al guardar la cita en la base de datos. ".mysql_error();
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
              exit();
            }
        }
        else
        {
            $msg = "Error al guardar la cita en la base de datos.".mysql_error();
            header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
            exit();
        }
     }
}
elseif (mysql_num_rows($fecha)<120 AND ($motivo=='Tratamiento' OR $motivo=='Emergencia') AND $fecha_dia!='Domingo')
{
    $consulta = mysql_query("SELECT * FROM pacientes WHERE cedula='$cedula'");
    if (mysql_num_rows($consulta)>0)
     {
        $rows = mysql_fetch_array($consulta);
        $paciente_id=$rows['id']; 
        $result = mysql_query("SELECT * FROM citas WHERE paciente_id='$paciente_id' AND fecha = '{$fecha_cita}' AND (status = 0 OR status = 1 or status = 2 OR status = 15 OR status = 100)");
        if (mysql_num_rows($result)>0) 
        {
          $msg = "El paciente ya tiene una cita creada";
          header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
          exit();
        }
        else
        {
            $inserta = mysql_query("INSERT INTO citas VALUES (NULL,'{$motivo}','{$fecha_cita}','{$nro_consulta}','0','$paciente_id','{$nota}', '0', '0', NOW(),'')");
            if ($inserta) 
            {
              $msn = "La cita fue creada con exito";
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msn=$msn");
              exit();
            }
            else
            {
              $msg = "Error al guardar la cita en la base de datos. ".mysql_error();
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
              exit();
            }
        }
     }
     else 
     {
        $paciente= mysql_query("INSERT INTO pacientes (id,nombre_completo,cedula,email,fecha_nacimiento,sexo,telefono,estado_civil,direccion,ocupacion,remitido,quien,avatar,progreso,representante_id,created_at,updated_at)
        VALUES (NULL,'".ucwords($_POST['nombre'])."','$cedula','','','','{$_POST['telefono']}','','','','','','','1','', NOW(),'')");
        if ($paciente) 
        {
            $paciente_id_2 = mysql_insert_id();
            $inserta = mysql_query("INSERT INTO citas VALUES (NULL,'{$motivo}','{$fecha_cita}','{$nro_consulta}','0','$paciente_id_2','{$nota}', '0', '0', NOW(),'')");
            if ($inserta) 
            {
              $msn = "La cita fue creada con exito";
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msn=$msn");
              exit();
            }
            else
            {
              $msg = "Error al guardar en la cita en la base de datos. ".mysql_error();
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
              exit();
            }
        }
        else
        {
            $msg = "Error al guardar en la cita en la base de datos. ".mysql_error();
            header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
            exit();
        }
     }  
}
elseif (mysql_num_rows($fecha) < 60 AND ($fecha_dia!='Martes' AND $fecha_dia!='Jueves' AND $fecha_dia!='Domingo') AND ($motivo=='Nuevo' OR $motivo=='Control'))
{
    $consulta = mysql_query("SELECT * FROM pacientes WHERE cedula='$cedula'");
    if (mysql_num_rows($consulta)>0)
     {
        $rows = mysql_fetch_array($consulta);
        $paciente_id=$rows['id']; 
        $result = mysql_query("SELECT * FROM citas WHERE paciente_id='$paciente_id' AND fecha = '{$fecha_cita}' AND (status = 0 OR status = 1 or status = 2 OR status = 15 OR status = 100)");
        if (mysql_num_rows($result)>0) 
        {
          $msg = "El paciente ya tiene una cita creada";
          header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
          exit();
        }
        else
        {
            $inserta = mysql_query("INSERT INTO citas VALUES (NULL,'{$motivo}','{$fecha_cita}','{$nro_consulta}','0','$paciente_id_2','{$nota}', '0', '0', NOW(),'')");
            if ($inserta) 
            {
              $msn = "La cita fue creada con exito";
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msn=$msn");
              exit();
            }
            else
            {
              $msg = "Error al guardar en la cita en la base de datos. ".mysql_error();
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
              exit();
            }
        }
     }
     else 
     {
        $paciente= mysql_query("INSERT INTO pacientes (id,nombre_completo,cedula,email,fecha_nacimiento,sexo,telefono,estado_civil,direccion,ocupacion,remitido,quien,avatar,progreso,representante_id,created_at,updated_at)
        VALUES (NULL,'".ucwords($_POST['nombre'])."','$cedula','','','','{$_POST['telefono']}','','','','','','','1','', NOW(),'')");
        if ($paciente) 
        {
            $paciente_id_2 = mysql_insert_id();
           $inserta = mysql_query("INSERT INTO citas VALUES (NULL,'{$motivo}','{$fecha_cita}','{$nro_consulta}','0','$paciente_id_2','{$nota}', '0', '0', NOW(),'')");
            if ($inserta) 
            {
              $msn = "La cita fue creada con exito";
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msn=$msn");
              exit();
            }
            else
            {
              $msg = "Error al guardar en la cita en la base de datos.".mysql_error();
              header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
              exit();
            }
        }
        else
        {
            $msg = "Error al guardar en la cita en la base de datos.".mysql_error();
            header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
            exit();
        }
     }
 
}
elseif ($fecha_dia=='Domingo') 
{
    $msg = "No puede asignar citas para el dia Domingo.";
    header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
    exit();

}
else 
{
    $msg = "Ya ha completado el limite maximo de citas para este dia.".mysql_error();
    header("Location: ../../Pantallas/Recepcion/cita_rapida.php?msg=$msg");
    exit();
}
 
?>