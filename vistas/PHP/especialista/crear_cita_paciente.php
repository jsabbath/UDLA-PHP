<?php
include "../../config/datos.php";
date_default_timezone_set('America/Caracas');

$cedula= $_POST['ci']."-".$_POST['cedula'];

$consulta     = $_POST['consulta'];
$fecha        = $_POST['fecha'];
//$nro_historia = $_POST['nro_historia'];
$remitido     = $_POST['remitido'];

$result = mysql_query("SELECT citas.* FROM citas
            INNER JOIN pacientes ON citas.paciente_id = pacientes.id 
            WHERE pacientes.cedula = '{$cedula}' 
            AND citas.fecha= '{$fecha}' 
            AND citas.tipo = '{$consulta}' 
            AND (status = 0 OR status = 1 OR status = 2 OR status = 100)
            ");

if (mysql_num_rows($result) > 0) 
{
    $msg = "El paciente ya posee una cita de tipo ". $consulta ." para el dia seleccionado.";
    header("Location: ../../Pantallas/Especialista/crear_cita.php?error=$msg");
}
else
{
    $paciente = mysql_query("SELECT id FROM pacientes WHERE cedula = '{$cedula}' LIMIT 1");
    if (mysql_num_rows($paciente) == 1) {
        $pac = mysql_fetch_assoc($paciente);
        $insertar = mysql_query("INSERT INTO citas VALUES(
                NULL, 
                '{$consulta}',
                '{$fecha}', 
                '', 
                '0',
                '{$pac['id']}',
                '{$remitido}',
                '0',
                '0', 
                NOW(),
                '')
            ");

        if ($insertar) 
        {
            header("Location: ../../Pantallas/Especialista/crear_cita.php?success=La cita ha sido creada con exito");
        }
        else
        {
            $error = mysql_error();
            header("Location: ../../Pantallas/Especialista/crear_cita.php?error=$error");
        }
    }
    else
    {
        $error = "Disculpe, no existe paciente con la cedula ingresada";
        header("Location: ../../Pantallas/Especialista/crear_cita.php?error=$error");
    }
    

}
?>
