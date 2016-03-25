<?php 
include("../../config/datos.php");

$paquete = $_POST['paquete'];
$paciente = $_POST['paciente'];

$id = $_POST['id_procedimiento'];
$cantidad = $_POST['cant'];
$monto = $_POST['monto'];
$descuento = $_POST['desc'];

$total_pagar = $_POST['total_pagar'];

//*** se calculan los montos finales
$sub_total = 0;
for ($i=0; $i < count($id) ; $i++) { 
	
	$precio = $cantidad[$i] * $monto[$i];
	$sub_total = $sub_total + $precio; 
}

//*** se calcula el descuento segun el sub_total
if ($descuento == "si") {
	if ($sub_total < 15000) {
		$total = $sub_total;
		$porcentaje = "0%";
	}
	else if ($sub_total > 15000 AND $sub_total < 40000) {
		
		$descontar = $sub_total * 0.05;
		$total = $sub_total - $descontar;
		$porcentaje = "5%";
	}
	else if ($sub_total > 40000) {
		$descontar = $sub_total * 0.10;
		$total = $sub_total - $descontar;
		$porcentaje = "10%";
	}
}
else{
	$total = $sub_total;
	$porcentaje = "0%";
}

$paq = mysql_query("SELECT id, regalo FROM paquetes WHERE id = '{$paquete}' LIMIT 1 ");
$paq_dt = mysql_fetch_assoc($paq);

//****actualizamos el estatus del paquete original
$aprobar = mysql_query("UPDATE paquetes SET status = 'Aprobado', update_at = NOW()
			WHERE id = '{$paquete}' LIMIT 1 ");

if ($aprobar) {
	 //**** se crea un nuevo paquete aprobado 
		$nuevo_paq = mysql_query("INSERT INTO paquete_aprobado VALUES(
				NULL,
	 			'$total', 
	 			'0', 
	 			'$total', 
	 			'$porcentaje', 
	 			'Por Pagar',
	 			'Ninguno',
	 			'0',
	 			'0',
	 			'',
	 			'{$paq_dt['regalo']}', 
	 			'$paquete', 
	 			'$paciente', 
	 			NOW(), 
	 			''
	 			) 
			");

	if ($nuevo_paq) {
		
		$ult_id = mysql_insert_id();
		for ($i=0; $i < count($id); $i++) { 
			//*** creamos los nuevos tratamientos que fueron aprobados
			$tratamiento = mysql_query("SELECT * FROM tratamientos WHERE id = '{$id[$i]}' LIMIT 1 ");
			$trat = mysql_fetch_assoc($tratamiento);

			if (!is_numeric($trat['frecuencia'])) {
				if ($trat['frecuencia'] == 'Unica') {
					$frec = 1;
				}
				elseif ($trat['frecuencia'] == '3 Dias') {
					$frec = 3;
				}
				elseif ($trat['frecuencia'] == '5 Dias') {
					$frec = 5;
				}
				elseif ($trat['frecuencia'] == '8 Dias') {
					$frec = 8;
				}
				elseif ($trat['frecuencia'] == '10 Dias') {
					$frec = 10;
				}
				elseif ($trat['frecuencia'] == '15 Dias') {
					$frec = 15;
				}
				elseif ($trat['frecuencia'] == 'Mensualmente') {
					$frec = 30;
				}
				else
				{
					$frec = 0;
				}
			}
			else
			{
				$frec = $trat['frecuencia'];
			}
			
			$nvo_tratamiento = mysql_query("INSERT INTO tratamientos_aprobados 
				values(NULL, 
					'{$trat['nombre']}', 
					'{$trat['parte']}',
					'{$cantidad[$i]}',
					'{$frec}',
					'{$trat['parametros']}',
					'Sin Aplicar',
					'',
					'{$monto[$i]}',
					'{$ult_id}',
					'{$id[$i]}',
					NOW(),
					''
					)
			");
		}
		if ($nvo_tratamiento) {
			header("Location: ../../Pantallas/Recepcion/paquete_aprobado.php?id=$ult_id&paciente=$paciente");
			exit();
		}
		else
		{	
			$error = mysql_error();
			header("Location: ../../Pantallas/Recepcion/presupuestos_edit.php?paquete=$paquete&paciente=$paciente&msg=$error");
			exit();
		}
	}
	else 
	{
		// no se creo el paquete aprobado
		$error = mysql_error();
		header("Location: ../../Pantallas/Recepcion/presupuestos_edit.php?paquete=$paquete&paciente=$paciente&msg=$error");
		exit();
	}
}
else
{	
	$error = mysql_error();
	header("Location: ../../Pantallas/Recepcion/presupuestos_edit.php?paquete=$paquete&paciente=$paciente&msg=$error");
	exit();
}


 ?>