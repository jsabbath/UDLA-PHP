<?php 
include("../../config/datos.php");
$paquete = $_POST['paquete'];
$paciente = $_POST['paciente'];
$id = $_POST['procedimientos'];
//$subtotal = $_POST['subtotal'];

$forma = $_POST['forma_pago'];
$tipo = $_POST['tipo_pago'];
$nro = $_POST['operacion'];
$desc = $_POST['descuento'];
$observacion = $_POST['observacion'];
$servicio = "Procedimiento";

$total = $_POST['totaltext'];

$exitosos = array();
  
for ($i=0; $i < count($id); $i++) { 

	$separar = explode("-", $id[$i]);
	$id_pr = $separar[0];
	$monto = $separar[1];
	
	//consulto cada procedimiento registrado a traves de su id
	$proc = mysql_query("SELECT * FROM tratamientos WHERE id = '{$id_pr}' LIMIT 1 ");
	$procs = mysql_fetch_assoc($proc);

	//calculo el descuento para cada procedimiento
	$subtotal = $procs['cantidad'] * $monto;
	$descuento = ($subtotal * $desc) / 100;
	$total_final = $subtotal - $descuento;


	$pago = mysql_query("INSERT INTO pagos VALUES(
						NULL, 
						'$forma', 
						'$nro', 
						'$tipo', 
						'$desc',
						'$observacion', 
						'$total_final', 
						NOW(),
						'$servicio', 
						'$paciente', 
						'$id_pr'
						)
					");
	
	//si se registra el pago efectivamente actualizo el estado de pago de dicho procedimiento
	if ($pago) 
	{ 
		//echo "se realizo el pago del procedimiento con id: ". $id[$i]." monto : ".$subtotal[$i]."</br>";
		$update_proc = mysql_query("UPDATE tratamientos SET status_pago = 1, updated_at = NOW() WHERE id = '{$id_pr}' LIMIT 1 ");
		if ($update_proc) 
		{
			//voy agregando cada id de procedimientos actualizados al array $exitosos
			array_push($exitosos, $id_pr);
		}
	}
	else
	{
		header("Location: ../../Pantallas/Recepcion/paquetes.php?paquete=$paquete&paciente=$paciente&msg=not");
	}
}

header("Location: ../../Pantallas/Recepcion/paquetes.php?paquete=$paquete&paciente=$paciente&ok=$exitosos");
exit();


?>