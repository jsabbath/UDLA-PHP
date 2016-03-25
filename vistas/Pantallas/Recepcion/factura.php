<?php
	include "../../config/datos.php"; 
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sistema de Citas Medicas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="../../../css/font-awesome.css" rel="stylesheet">
<link href="../../../css/style.css" rel="stylesheet">
<link href="../../../css/pages/dashboard.css" rel="stylesheet">
   <link href="../../../css/pages/reports.css" rel="stylesheet">
<script src="../../../js/jquery-1.7.2.min.js"></script> 
<script src="../../../js/excanvas.min.js"></script> 
<script src="../../../js/chart.min.js" type="text/javascript"></script> 
<script src="../../../js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/full-calendar/fullcalendar.min.js"></script>
 
<script src="../../../js/base.js"></script> 


</head>
<body>

<div class="main">
	<div class="main-inner">
		<div class="container">
			
					<div class="row">
					
						<div class="span4 primera">
							<h4>Nombre y Apellido: <?php echo $paciente['nombre_completo']; ?> </h4>
							<h4>Cedula: <?php echo $paciente['cedula']; ?> </h4>
							<h4>Telefono: <?php echo $paciente['telefono']; ?> </h4>
							 <h4>Dirección: <?php echo $paciente['direccion']; ?> </h4>						
						</div>
						
					
						
					</div>
					<hr>
<!-- /////////////////////////////////////Detalles del paquete////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<?php $paquete_id = $_GET['paquete']; ?>
	
	<?php 
	$detalle_trat = mysql_query("SELECT * FROM tratamientos WHERE paciente_id ='{$id}' AND  paquete_id ='{$paquete_id}'");
	$filas_trat = mysql_num_rows($detalle_trat);
	if($filas_trat >0)
	{?>
			<div class="table-responsive">
				<table class="table table-bordered">
				<form class="form-horizontal" id="tratamientoform" onsubmit="return false;">
				<tr>
					<th>Procedimiento</th>
					<th>Lugar</th>
					<th>Sesiones</th>
					<th>Monto</th>
					<th>Total</th>
					<th></th>
				</tr>
		<?php
		$total_unitario = 0;
		$sesiones = 0;
		$proc = 0;
		while($lista_trat = mysql_fetch_assoc($detalle_trat))
		{ ?>
				<?php 
					$procedimiento = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre= '{$lista_trat['nombre']}' ");
					$monto = mysql_fetch_assoc($procedimiento);
				?>
				<tr> 
					<td><?php echo $lista_trat['nombre']; ?></td>
					<td><?php echo $lista_trat['parte']; ?> </td>
					<td><?php echo $lista_trat['cantidad']; ?> </td>
					<td><?php echo $monto['precio']; ?> Bs.</td>
					<td><?php  
					$total = $monto['precio'] * $lista_trat['cantidad'];
					echo $total;
					?> Bs.</td>
					<td></td>
				</tr>
				<?php 
				$total_unitario = $total_unitario + $total; 
				$proc++;
				$sesiones = $sesiones + $lista_trat['cantidad'];
				?>
	<?php } ?>
			<tr>
				<td ></td> <td></td> <td align="center"><strong>Total Precio Unitario:</strong></td> 
				<td><b><?php echo $total_unitario; ?></b> Bs.</td> <td> </td> <td></td>	
			</tr>

			<tr>
				<td></td> <td></td> <td align="center"></td> 
				<td><b>Total</b></td> <td><b><?php echo $total_unitario; ?></b> Bs.</td>
				<td><b>PRECIO DE CONTADO</b></td> 	
			</tr>
			<tr>
				<td></td> <td></td> <td><b>Descuento:</b></td>
				<?php if($total_unitario < 10000 ){
						echo "<td>0%</td>";
						echo "<td></td> <td></td>";
						$total_pagar = $total_unitario;
					}
					else if(($total_unitario > 10000) AND ($total_unitario < 15000)){
						echo "<td>7%</td>";
						$descuento = $total_unitario * 0.07;
						echo "<td><b>".$descuento."</b> Bs.</td> <td></td>";
						$total_pagar = $total_unitario - $descuento;
					} 

					elseif($total_unitario > 15000 ){
						echo "<td>10%</td>";
						$descuento = $total_unitario * 0.10;
						echo "<td><b>".$descuento."</b> Bs.</td> <td></td>";
						$total_pagar = $total_unitario - $descuento;
					} ?>		
			</tr>
			<tr>
				<td></td> <td></td> <td></td>
				<td><b>Total a pagar:</b></td>
				<td><b><?php echo $total_pagar; ?></b> Bs.</td>
				<td><b><?php echo $total_pagar; ?></b> Bs.</td>
			</tr>		
		</form>
		</table>
		</div>


		<?php
		//comprobando si son sesiones unicas
		$cantidad_sesiones = $sesiones / $proc;
		if($cantidad_sesiones > 1 )
		{ 
			$inicial = $total_pagar * 0.65;
			$cuotas = ($total_pagar - $inicial) / 3;
		?>
			<div class="span4">

					<?php 
						$detalle_paq = mysql_query("SELECT * FROM paquetes WHERE  id ='{$paquete_id}'");
						$paquete = mysql_fetch_assoc($detalle_paq);
					?>
						<h3>FORMA DE PAGO A CREDITO</h3>
									
						<div>Inicial: <b><?php echo $inicial; ?></b> Bs.</div>
									
						<div>3 cuotas: <b><?php echo $cuotas; ?></b> Bs. </div>
															
						<div>Obsequio: <b><?php echo $paquete['regalo']; ?></b> </div></div>
						
					
			
			</div>
		<?php }
		else { ?>
			<div class="table-responsive span4">
				<table class="table table-bordered" width="60%">
					<tr>
						<th></th>
						<th>FORMA DE PAGO</th>
					</tr>
					<tr>
						<td>Inicial</td>
						<td></td>
					</tr>
					<tr>
						<td>3 cuotas</td>
						<td></td>
					</tr>
					<tr>
						<td>Obsequio</td>
						<td></td>
					</tr>
				</table>
			</div>
		<?php } ?>
		
		

		<?php } //if principal ?>

				
		</div>
	</div>
</div>
</body>

