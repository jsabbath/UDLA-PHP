<?php 
include("../../config/datos.php");

$forma = $_POST['forma'];
$tipo = $_POST['tipo'];
$monto = $_POST['monto'];
$paciente = $_POST['paciente'];
$paquete = $_POST['paquete'];

	$paq = mysql_query("SELECT * FROM paquetes WHERE id = '{$paquete}' LIMIT 1");
	$datos_paq = mysql_fetch_assoc($paq);

	if($datos_paq['monto_total'] > $datos_paq['monto_abonado'])
	{
		$registrar = mysql_query("INSERT INTO pagos VALUES(NULL, '$forma', '$tipo', '$monto', NOW(), '$paciente', '$paquete') ");
		
		if($registrar)
		{
			$nvo_abono = $datos_paq['monto_abonado'] + $monto;
			$nvo_deuda = $datos_paq['monto_total'] - $nvo_abono;
			if ($datos_paq['monto_total'] > $nvo_abono) 
			{
				$edit_paquete = mysql_query("UPDATE paquetes 
								SET monto_abonado = '{$nvo_abono}', monto_deudor = '{$nvo_deuda}', update_at = NOW() 
								WHERE id = '{$paquete}' AND paciente_id = '{$paciente}' 
								LIMIT 1 ");
				if ($edit_paquete) 
				{
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete");
					exit;
				}
				else
				{	
					$error = "Lo sentimos, no se actualizaron los datos del paquete";
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete&msg=$error");
					exit;
				}
			}
			elseif($datos_paq['monto_total'] == $nvo_abono) 
			{
				$edit_paquete = mysql_query("UPDATE paquetes 
								SET monto_abonado = '{$nvo_abono}', monto_deudor = '{$nvo_deuda}', status = 3, update_at = NOW() 
								WHERE id = '{$paquete}' AND paciente_id = '{$paciente}' 
								LIMIT 1 ");
				if ($edit_paquete) 
				{
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete");
					exit;
				}
				else
				{	
					$error = "Lo sentimos, no se actualizaron los datos del paquete";
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete&msg=$error");
					exit;
				}
			}			
		}
		else
		{
			$error = "Lo sentimos, no se registro el pago.";
			header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete&msg=$error");
			exit;
		}		
	}
	else
	{
		//"el monto total no es mayor al monto abonado"
		$error = "Lo sentimos, al parecer las cuentas no coinciden, rectifique";
		header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paquete&msg=$error");
		exit;
	}


 ?>