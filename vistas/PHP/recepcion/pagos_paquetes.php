<?php 
include("../../config/datos.php");

$paquete = $_POST['paquete_ap'];
$paciente = $_POST['paciente'];
$metodo = $_POST['metodo'];

if (isset($_POST['contado'])) {
	$forma_pago = $_POST['forma_pago'];
	$operacion = $_POST['operacion'];
	$monto = $_POST['monto'];
	$obs = "Unica";

	$reg_pago = mysql_query("INSERT INTO pagos_paquetes VALUES(
				NULL,
				'$monto',
				'$forma_pago',
				'$operacion',
				'Contado',
				'$obs',
				'$paquete',
				'$paciente',
				NOW()
		) ");

	if ($reg_pago) {
		// *****se calcula la cantidad de citas que tendra este paquete
		$citas = mysql_query("SELECT cantidad FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paquete}' GROUP BY cantidad ORDER BY cantidad DESC LIMIT 1");
		$nro_citas = mysql_fetch_assoc($citas);

		// actualizamos el paquete aprobado 
		$update_paq = mysql_query("UPDATE paquete_aprobado SET
					abonado = '{$monto}',
					restante = '00.00',
					status = 'Pagado',
					status_pagos = 'Completo',
					citas = '{$nro_citas['cantidad']}',
					updated_at = NOW() 
					WHERE id = '{$paquete}' LIMIT 1
			");
		// si se realiza la actualizacion correctamente
		if (mysql_affected_rows($update_paq) != -1) {
			
			header("Location: ../../Pantallas/Recepcion/pago_paquete_realizado.php?paquete=$paquete&paciente=$paciente&msg=ok");
			exit();
		}
		else
		{
			//no se realizo la actualizacion del paquete
			$error = mysql_error();
			header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?paciente=$paciente&id=$paquete&error=$error");
			exit();
		}
	}
	else
	{
		//no se realizo pago
		$error = mysql_error();
		header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?paciente=$paciente&id=$paquete&error=$error");
		exit();
	}
}
elseif (isset($_POST['credito'])) {
	
	$forma_pago = $_POST['forma_pago'];
	$operacion = $_POST['operacion'];
	$monto = $_POST['monto'];
	$obs = $_POST['cuota'];

	$paq = mysql_query("SELECT * FROM paquete_aprobado WHERE id = '{$paquete}' LIMIT 1");
	$datos_paq = mysql_fetch_assoc($paq);
	$paq_id = $datos_paq['paquete_id'];

	if($datos_paq['total'] > $datos_paq['abonado'])
	{
		$registrar = mysql_query("INSERT INTO pagos_paquetes VALUES(
				NULL,
				'$monto',
				'$forma_pago',
				'$operacion',
				'Cuotas',
				'$obs',
				'$paquete',
				'$paciente',
				NOW() ) ");
		
		$citas = mysql_query("SELECT cantidad FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paquete}' GROUP BY cantidad ORDER BY cantidad DESC LIMIT 1");
		$nro_citas = mysql_fetch_assoc($citas);
		if($registrar)
		{
			$nvo_abono = $datos_paq['abonado'] + $monto;
			$nvo_deuda = $datos_paq['total'] - $nvo_abono;
			if ($datos_paq['total'] > $nvo_abono) 
			{
				$edit_paquete = mysql_query("UPDATE paquete_aprobado SET
					abonado = '{$nvo_abono}',
					restante = '$nvo_deuda',
					status = 'Sin Terminar',
					status_pagos = '$obs',
					citas = '{$nro_citas['cantidad']}',
					updated_at = NOW() 
					WHERE id = '{$paquete}' LIMIT 1 ");
				
				if ($edit_paquete) 
				{
					header("Location: ../../Pantallas/Recepcion/pago_paquete_realizado.php?paquete=$paquete&paciente=$paciente&msg=ok");
					exit;
				}
				else
				{	
					$error = "Lo sentimos, no se actualizaron los datos del paquete".mysql_error();
					header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?paciente=$paciente&id=$paquete&error=$error");
					exit;
				}
			}
			elseif($datos_paq['total'] == $nvo_abono) 
			{
				$edit_paquete = mysql_query("UPDATE paquete_aprobado 
								SET abonado = '{$nvo_abono}', restante = '{$nvo_deuda}', status = 'Pagado', status_pagos = '$obs', updated_at = NOW() 
								WHERE id = '{$paquete}' AND paciente_id = '{$paciente}' 
								LIMIT 1 ");
				if ($edit_paquete) 
				{
					header("Location: ../../Pantallas/Recepcion/pago_paquete_realizado.php?paquete=$paquete&paciente=$paciente&msg=ok");
					exit;
				}
				else
				{	
					$error = "Lo sentimos, no se actualizaron los datos del paquete".mysql_error();
					header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?paciente=$paciente&id=$paquete&error=$error");
					exit;
				}
			}			
		}
		else
		{
			$error = "Lo sentimos, no se registro el pago.".mysql_error();
			header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?paciente=$paciente&id=$paquete&error=$error");
			exit;
		}		
	}
	else
	{
		//"el monto total no es mayor al monto abonado"
		$error = "Lo sentimos, al parecer las cuentas no coinciden, rectifique";
		header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?paciente=$paciente&id=$paquete&error=$error");
		exit;
	}
}

 ?>