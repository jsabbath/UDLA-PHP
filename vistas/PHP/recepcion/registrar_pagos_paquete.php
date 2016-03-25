<?php 
include("../../config/datos.php");

$forma = $_POST['forma_pago'];
$cod_forma = $_POST['operacion'];
$tipo = $_POST['tipo_pago'];
$obs = $_POST['observacion'];
$monto = $_POST['monto'];
$paciente = $_POST['paciente'];
$paquete = $_POST['paquete'];

	$paq = mysql_query("SELECT * FROM paquete_aprobado WHERE id = '{$paquete}' LIMIT 1");
	$datos_paq = mysql_fetch_assoc($paq);
	$paq_id = $datos_paq['paquete_id'];

	if($datos_paq['total'] > $datos_paq['abonado'])
	{
		$registrar = mysql_query("INSERT INTO pagos_paquetes VALUES(
			NULL, '$monto', '$forma', '$cod_forma', '$tipo', '$obs','$paquete', '$paciente', NOW() ) ");
		
		if($registrar)
		{
			$nvo_abono = $datos_paq['abonado'] + $monto;
			$nvo_deuda = $datos_paq['total'] - $nvo_abono;
			if ($datos_paq['total'] > $nvo_abono) 
			{
				$edit_paquete = mysql_query("UPDATE paquete_aprobado 
								SET abonado = '{$nvo_abono}', restante = '{$nvo_deuda}', updated_at = NOW() 
								WHERE id = '{$paquete}' AND paciente_id = '{$paciente}' 
								LIMIT 1 ");
				if ($edit_paquete) 
				{
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paq_id");
					exit;
				}
				else
				{	
					$error = "Lo sentimos, no se actualizaron los datos del paquete".mysql_error();
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paq_id&msg=$error");
					exit;
				}
			}
			elseif($datos_paq['total'] == $nvo_abono) 
			{
				$edit_paquete = mysql_query("UPDATE paquete_aprobado 
								SET abonado = '{$nvo_abono}', restante = '{$nvo_deuda}', status = 'Pagado', updated_at = NOW() 
								WHERE id = '{$paquete}' AND paciente_id = '{$paciente}' 
								LIMIT 1 ");
				if ($edit_paquete) 
				{
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paq_id");
					exit;
				}
				else
				{	
					$error = "Lo sentimos, no se actualizaron los datos del paquete".mysql_error();
					header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paq_id&msg=$error");
					exit;
				}
			}			
		}
		else
		{
			$error = "Lo sentimos, no se registro el pago.".mysql_error();
			header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paq_id&msg=$error");
			exit;
		}		
	}
	else
	{
		//"el monto total no es mayor al monto abonado"
		$error = "Lo sentimos, al parecer las cuentas no coinciden, rectifique";
		header("Location: ../../Pantallas/Recepcion/paquetes.php?paciente=$paciente&paquete=$paq_id&msg=$error");
		exit;
	}


 ?>