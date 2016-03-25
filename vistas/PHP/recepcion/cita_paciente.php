 
<?php
include ("../../config/datos.php");
    $consulta     = $_POST['consulta'];
    $paciente_id  = $_POST['id'];
    $fecha        = $_POST['fecha'];
    $nro_historia = $_POST['nro_historia'];
    $remitido     = $_POST['remitido'];

    $result = mysql_query("SELECT * FROM citas WHERE 
              paciente_id = '{$paciente_id}' AND 
              fecha= '{$fecha}' AND 
              (status = 0 OR status = 1 OR status = 2 OR status = 100)
              ");

    if (mysql_num_rows($result)>0) 
    {
      header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?error=Ya tiene cita para este dia.");
    }
    else
    {
      $insertar = mysql_query("INSERT INTO citas VALUES(
                NULL, 
                '{$consulta }',
                '{$fecha}', 
                '{$nro_historia}', 
                '0',
                '{$paciente_id}',
                '{$remitido}',
                '0',
                '0', 
                NOW(),
                '')
            ");

        if ($insertar) 
        {
           header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?guardado=La cita ha sido creada con exito");
        }
        else
        {
          header("Location: ../../Pantallas/Recepcion/buscar_paciente.php?error=Ha ocurrido un error al crear la cita.");
        }

    }



?>