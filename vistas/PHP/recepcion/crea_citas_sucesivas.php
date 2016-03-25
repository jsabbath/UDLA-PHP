<?php 
include ("../../config/datos.php");
date_default_timezone_set('America/Caracas');
$fecha_inicial = $_POST['fecha_inicio'];
$dia = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');

$paciente = $_POST['paciente'];
$paquete = $_POST['paquete'];

$cantidad = $_POST['cantidad'];
$frecuencia = $_POST['frecuencia'];

$citas_new = array();

$primera_cita = mysql_query("INSERT INTO citas VALUES(NULL,
	'Tratamiento',
	'$fecha_inicial',
	'',
	'0',
	'$paciente',
	'Cabina',
	'0',
	'$paquete',
	NOW(),
	''
	) ");

if ($primera_cita) {
	$id_uno = mysql_insert_id();
	//array_push($citas_new, $id_uno);
	$nro_cita = 1;
	$dias = 0;
	for ($i=1; $i < $cantidad; $i++) { 
		
		$dias = $dias + $frecuencia;
		//$fecha = date ('Y-m-d', $fecha_inicial );
		$nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ( $fecha_inicial ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		$fecha_dia = $dia[date('N', strtotime($nuevafecha))];

		if ($fecha_dia == "Domingo") {

			$nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
			$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		}

		
		$citas = mysql_query("INSERT INTO citas VALUES(NULL,
			'Tratamiento',
			'$nuevafecha',
			'',
			'0',
			'$paciente',
			'Cabina',
			'0',
			'$paquete',
			NOW(),
			''
			) ");
		
		if ($citas) {
			//$id_n = mysql_insert_id();
			//array_push($citas_new, $id_n);
			$nro_cita++;
		}
		else
		{
			break;
		}
	}

	$pq_citas = mysql_query("SELECT cita_created FROM paquete_aprobado WHERE id = '$paquete' LIMIT 1 ");
	$pq_nro = mysql_fetch_assoc($pq_citas);

	$cant_citas =  $pq_nro['cita_created'] + $nro_cita;

	$update_paq = mysql_query("UPDATE paquete_aprobado SET 
				cita_created = '$cant_citas',
				proximo_pago = '$nuevafecha'
				WHERE id = '$paquete' LIMIT 1 ");
	//$ids = serialize($citas_new);
	//$ids = urlencode($ids);
	$msg = "Se Crearon las citas con exito";
	header("Location: ../../Pantallas/Recepcion/pago_paquete_realizado.php?paquete=$paquete&paciente=$paciente&msg=exit&citas-ok=ok");
}
else
{	
	$error = mysql_error();
	header("Location: ../../Pantallas/Recepcion/pago_paquete_realizado.php?paquete=$paquete&paciente=$paciente&error=$error");
	exit();
}



?>