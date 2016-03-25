<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
?>
<script type="text/javascript">	
	function calcular(descuento, total, totaltext){		
		desc = (total * descuento) / 100;
		totaltext.value = total - desc; 
	}
</script>

<div class="">
<br>
	<div class="main-inner">
		<div class="container">
			<div class="widget">

				<div class="widget-header">
					<i class="icon-user"></i>
					<h3> Paquete de tratamientos del Paciente:  </h3>
				</div>

				<div class="widget-content">
					<div class="row-fluid">
						<div class="span1">
							<img src="../../../img/avatar.jpg" class="img-responsive img-circle" width="80px">				
						</div>
						<div class="span4 primera">
							<h4>Nombre y Apellido: <?php echo $paciente['nombre_completo']; ?> </h4>
							<h4>Cedula: <?php echo $paciente['cedula']; ?> </h4>
							<h4>Telefono: <?php echo $paciente['telefono']; ?> </h4>
							<small><strong>Correo:</strong> <?php echo $paciente['email']; ?> </small>
									
						</div>
						
						<div class="span3 sengunda">
							<h4>Edad: <?php echo calculaedad($paciente['fecha_nacimiento']); ?>  </h4>
							<h4>Sexo: <?php echo $paciente['sexo']; ?></h4>
							<h4>Ocupación: <?php echo $paciente['ocupacion']; ?> </h4>
							<h4> Paciente desde: <?php echo "Hace ". calcular_fechas($paciente['created_at'])." dias"; ?> </h4>
						</div>
						<div class="span4 tercera">
							<h4>Nos conocio a traves de: <?php echo $paciente['remitido']; ?> </h4>
			                <h4>Dirección: <?php echo $paciente['direccion']; ?> </h4>
			            </div>
					</div>
					<hr>
<!-- /////////////////////////////////////Detalles del paquete////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<div class="alert alert-block">
		<center><h3>Datos del paquete original:</h3></center>	  
	</div>
	
	<?php 
	$paquete_id = $_GET['paquete'];
	$detalle_paq = mysql_query("SELECT * FROM paquetes WHERE  id ='{$paquete_id}'");
	$filas_paq = mysql_num_rows($detalle_paq);
	if($filas_paq > 0)
		$paqt = mysql_fetch_assoc($detalle_paq);
	{?>
		<div class="span12">
			<h4> <li>  Paquete de: <?php echo $paqt['nombre']; ?> </li>	</h4>
			<h4> <li>  Paquete Creado el: <?php echo fecha_total($paqt['created_at']); ?> </li>	</h4>		
			<br>
		</div>
	<?php } ?>
	<?php if (isset($_GET['msg'])) {
	    $msg= $_GET['msg']; ?>
	    <div class="alert alert-danger">
	        <button type="button" class="close" data-dismiss="alert">&times;</button>
	        <strong><?php echo $msg; ?> </strong>
	    </div>
	<?php } ?>

<!-- /////////////////////////////////////lista de procedimientos////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

	<br>

	<?php 
	$detalle_trat = mysql_query("SELECT * FROM tratamientos WHERE 
								paciente_id ='{$id}' AND  
								paquete_id ='{$paquete_id}' AND
								status_pago = '0' 
							");
	$filas_trat = mysql_num_rows($detalle_trat);
	if($filas_trat > 0)
	{?>
			<div class="table-responsive">
				<table class="table">
				<tr>
					<th>Nº</th>
					<th colspan="">Procedimientos</th>
					<th>Lugar</th>
					<th>Sesiones</th>
					<th>Monto Sesion</th>
					<th>Total</th>
				</tr>
			<form method="POST" action="form_pagos.php">

		<?php
		$total_unitario = 0;
		$sesiones = 0;
		$proc = 0;
		$nro = 1;
		while($lista_trat = mysql_fetch_assoc($detalle_trat))
		{ ?>
		
				<?php 
					$procedimiento = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre = '{$lista_trat['nombre']}' ");
					$monto = mysql_fetch_assoc($procedimiento);
				?>
				<tr>
					<input type="hidden" name="paquete" value="<?php echo $paquete_id; ?>">
					<input type="hidden" name="paciente" value="<?php echo $paciente['id']; ?>">
					<td><?php echo $nro; ?></td>
					
					<td><?php echo $lista_trat['nombre']; ?></td>
					<td><?php echo $lista_trat['parte']; ?> </td>
					<td> <strong><?php echo $lista_trat['cantidad']; ?></strong> 
					</td>
					<td>
						<?php echo number_format($monto['precio']); ?> Bs.
						<input type="hidden" name="monto[]" value="<?php echo $monto['precio']; ?>">
					</td>
					<td><?php  
					$total = $monto['precio'] * $lista_trat['cantidad'];
					echo number_format($total);
					?> Bs.</td>
				</tr>
				<?php 
				$total_unitario = $total_unitario + $total; 
				$proc++;
				$sesiones = $sesiones + $lista_trat['cantidad'];
				$nro++;
				?>
			<?php } ?>
			

			<tr>
				<td colspan="3"></td>
				<td colspan="1"><b></b></td> 
				<td><b>Total</b></td> 
				<td><b><?php echo number_format($total_unitario); ?></b> Bs.</td>	
			</tr>

			<?php if ($paqt['regalo'] != "") { ?>
				<tr>
					<td><strong>Regalo:</strong></td>
					<td><?php echo $paqt['regalo']; ?></td>
					<td colspan="4"></td>
				</tr>
			<?php } ?>

			</table>
		</div>
				
	</form>
					
	
		<?php } //if principal ?>

		<?php 
		$paq_aprob = mysql_query("SELECT * FROM paquete_aprobado WHERE paquete_id = '{$paquete_id}' LIMIT 1 ");
		if (mysql_num_rows($paq_aprob) > 0) { 

			$paq_ap = mysql_fetch_assoc($paq_aprob);
		?>
			
			<div class="alert alert-block">
				<center><h3>Datos paquete aprobado por el paciente: </h3></center>	  
			</div>
			<div class="table-responsive">
				<table class="table">
				<thead>
					<tr>
						<th>Estado</th>
						<th>Total</th>
						<th>Abonado</th>
						<th>Restante</th>
						<th>Descuento</th>
						<th>Citas</th>
						<th>Citas Creadas</th>
						<th>Proximo Pago</th>
						<th>Creado</th>
						<th>Ultimo Pago</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> <span class="label label-success"><?php echo $paq_ap['status']; ?></span>  </td>
						<td><strong><?php echo number_format($paq_ap['total']); ?> Bs.f </strong> </td>
						<td> <?php echo number_format($paq_ap['abonado']); ?> Bs.f</td>
						<td> <?php echo number_format($paq_ap['restante']); ?> Bs.f</td>
						<td> <?php echo $paq_ap['descuento']; ?> </td>
						<td><center><span class="badge "><?php echo $paq_ap['citas']; ?></span></center>  </td>
						<td><center><span class="badge badge-success"><?php echo $paq_ap['cita_created']; ?></span></center>  </td>
						<td><i class="icon-calendar"></i> <?php echo $paq_ap['proximo_pago']; ?> </td>
						<td><i class="icon-calendar"></i> <?php echo $paq_ap['created_at']; ?> </td>
						<td><i class="icon-calendar"></i> <?php echo $paq_ap['updated_at']; ?> </td>
					</tr>
				</tbody>
			</table>
			</div>

			<h4>Procedimientos del paquete:</h4>
			<?php 
				$proc_aprob = mysql_query("SELECT * FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paq_ap['id']}' ");
			?>

				<table class="table">
					<thead>
						<tr>
							<th>N</th>
							<th>Nombre</th>
							<th>Lugar</th>
							<th>Sessiones</th>
							<th>Frecuencia</th>
							<th>Parametros</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$nro = 1;
						while ($proc_ap = mysql_fetch_assoc($proc_aprob)) { ?>
						<tr>
							<td><?php echo $nro; $nro++; ?></td>
							<td> <?php echo $proc_ap['nombre']; ?> </td>
							<td> <?php echo $proc_ap['parte']; ?> </td>
							<td> <?php echo $proc_ap['cantidad']; ?> </td>
							<td> <?php echo $proc_ap['frecuencia']; ?> </td>
							<td> <?php echo $proc_ap['parametros']; ?> </td>
						</tr>
							
					<?php } ?>
					</tbody>
				</table>
				<a href="../../PHP/recepcion/presupuesto_pdf.php?paq=<?php echo $paq_ap['id']; ?>&pac=<?php echo $id;?>" target="_blank" class="btn btn-default btn-large " title="Imprimir"><i class="icon-print"></i> Imprimir</a>

				<?php if ($paq_ap['status'] == "Pagado") { ?>
					<center>
						<span class="label label-success font-16">Paquete pagado.</span> 
					</center>
				<?php }
				else{ ?>
					<a href="paquete_aprobado.php?id=<?php echo $paq_ap['id']; ?>&paciente=<?php echo $id; ?>" title="" class="btn btn-default btn-large"><i class="icon-credit-card"></i> AGREGAR PAGO</a>
					<br>
				<?php	} ?>
				<br>
				<div class="alert alert-block">
				  <h4>Citas Creadas para este paquete:</h4>
				</div>
					<ul>
						<?php 
							$num = 1;
							$citas_pq = mysql_query("SELECT * FROM citas WHERE paquete_ap_id = '{$paq_ap['id']}' ");
							if (mysql_num_rows($citas_pq) > 0) {
								
								while ($cita_pqt =  mysql_fetch_assoc($citas_pq)) { ?>
									
										<li> Cita <?php echo $num; $num++; ?> : <?php echo fecha_total($cita_pqt['fecha']); ?> </li>
									
							<?php	}
							}
						?>
					</ul>
				

		<?php }
		else
		{ ?>
			<a href="presupuestos_edit.php?paquete=<?php echo $paquete_id;?>&paciente=<?php echo $id; ?>" class="btn btn-success btn-large"><i class=" icon-chevron-right"></i> Editar Presupuesto</a>
			<a href="../../PHP/recepcion/presupuesto_original.php?paq=<?php echo $paquete_id;?>&pac=<?php echo $id;?>" target="_blank" class="btn btn-success btn-large"><i class=" icon-chevron-right"></i> IMPRIMIR</a>
		<?php } ?>

				</div> <!-- FIN WIDGET CONTENT -->
			</div> <!-- FIN WIDGET -->
		</div>
	</div>
</div>






<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><i class="icon-credit-card"></i> Pago de Paquetes:</h3>
  </div>
  <div class="modal-body">
    <p><strong>Configure su pago:</strong></p>
    <form action="../../PHP/recepcion/registrar_pagos_paquete.php" method="POST" onsubmit="return validacion()" class="form-horizontal">
    	<input type="hidden" name="paciente" value="<?php echo $id; ?>">
    	<input type="hidden" name="paquete" value="<?php echo $paq_ap['id']; ?>">

    	<div class="control-group">
    	<label class="control-label"><strong>Forma de pago:</strong></label>
    		<select name="forma_pago" id="forma" class="form-control" onchange="javascript:showContent()">
    			<option>Efectivo</option>
    			<option>Debito</option>
    			<option>Tarjeta de credito</option>
    			<option>Cheque</option>
    			<option>Trasferencia</option>
    		</select>
    	</div>

    	<div class="control-group" id="operacion" style="display: none;">
    		<label class="control-label"><strong>Nº Operación:</strong></label>
    		<input type="text" class="span1" name="operacion">
    	</div>

    	<div class="control-group">
    		<label class="control-label"><strong>Tipo de pago:</strong></label>
    		<select name="tipo_pago" id="tipo" class="form-control" onchange="javascript:showContent2()">
    			<option>Contado</option>
    			<option>Credito</option>
    			<option>Exonerado</option>
    			<option>Pagado</option>
    		</select>
    	</div>
    	<div id="obs" style="display: none;">
    		<label class="control-label"><strong>Observación:</strong></label>
    		<textarea type="text" class="span" name="observacion"> </textarea>
    		<span class="help-block font-normal">Indique la razón por la que este pago es exonerado.</span>
    	</div>
    	
    	<div class="control-group">
    		<label class="control-label"><strong>Monto a Pagar:</strong></label>
    		<input type="hidden" id="total" value="" >
    		<input type="text" class="span1" name="monto" id="monto" required placeholder="00.00" > <strong>Bs.f</strong>
    		<p style="display:none;" id="msg" class="text-error">El monto ingresado es incorrecto.</p>
    	</div>
    
  
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
  </div>
</div>


<script type="text/javascript">
	function showContent() {
        element = document.getElementById("operacion");
        select = document.getElementById("forma");
        if (select.value == "Cheque" || select.value == "Trasferencia" ) {
            element.style.display='block';
        }
        else {
        	
            element.style.display='none';
        }
    }
    function showContent2() {
        element = document.getElementById("obs");
        select = document.getElementById("tipo");
        if (select.value == "Exonerado" || select.value == "Pagado" ) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }

    function validacion () {
    	monto = document.getElementById("monto").value;
    	msg = document.getElementById("msg");
    	if (isNaN(monto)) {
    		msg.style.display = 'block';
    		return false;
    	};
    }
</script>