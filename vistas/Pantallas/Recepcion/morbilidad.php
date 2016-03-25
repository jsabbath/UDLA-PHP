<?php 
$header=2;
$activo=7;
require('../../header.php');
include('../../PHP/recepcion/conecciones.php');
include('../../PHP/funciones.php');
date_default_timezone_set('America/Caracas');
$hoy = date('Y-m-d');
$pag = mysql_query("SELECT * FROM pagos WHERE fecha = '{$hoy}'"); //

?>

<div class="container">
	<div class="row">
		
		<center> <br> <h2>Morbilidad: <?php echo fecha_total($hoy); ?> </h2> <br> </center>
		
		<div class="span2">
			<div class="widget">
				<div class="widget-header">
					<center><strong>Total Facturado </strong></center>
				</div>
				<div class="widget-content">
					<?php 
						$sum_todo = mysql_query("SELECT sum(monto_total) AS total FROM pagos WHERE 
									tipo != 'Exonerado' AND
									fecha = '{$hoy}'
									");
						$total_1 = mysql_fetch_assoc($sum_todo); 
						$paq_todo = mysql_query("SELECT sum(monto) AS total FROM pagos_paquetes WHERE 
									tipo_pago != 'Exonerado' AND
									created_at = '{$hoy}'
									");
						$paq_1 = mysql_fetch_assoc($paq_todo);
						$total_facturado = $total_1['total'] + $paq_1['total'];
					?>
					<center><p class="font16"> <strong><?php echo number_format($total_facturado); ?> Bs.</strong></p></center>
				</div>
			</div>
		</div>

		<div class="span2">
			<div class="widget">
				<div class="widget-header">
					<center><strong>Debito / cheque / Trans</strong></center>
				</div>
				<div class="widget-content">
					<?php 
						$sum_2 = mysql_query("SELECT sum(monto_total) AS total FROM pagos WHERE 
								forma != 'Efectivo' AND
								tipo != 'Exonerado' AND
								fecha = '{$hoy}'
								");
						$total_2 = mysql_fetch_assoc($sum_2); 
						$paq_formas = mysql_query("SELECT sum(monto) AS total FROM pagos_paquetes WHERE 
								forma != 'Efectivo' AND
								tipo_pago != 'Exonerado' AND
								created_at = '{$hoy}'
								");
						$paq_2 = mysql_fetch_assoc($paq_formas);
						$pago_deb = $total_2['total'] + $paq_2['total'];
					?>
					<center><p class="font16"> <strong><?php echo number_format($pago_deb); ?> Bs.</strong></p></center>
				</div>
			</div>
		</div>

		<div class="span2">
			<div class="widget">
				<div class="widget-header">
					<center><strong>Total Efectivo</strong></center>
				</div>
				<div class="widget-content">
					<?php 
						$sum_3 = mysql_query("SELECT sum(monto_total) AS total FROM pagos WHERE 
								forma = 'Efectivo' AND
								tipo != 'Exonerado' AND
								fecha = '{$hoy}'
								");
						$total_3 = mysql_fetch_assoc($sum_3); 
						$paq_efect = mysql_query("SELECT sum(monto) AS total FROM pagos_paquetes WHERE 
								forma = 'Efectivo' AND
								tipo_pago != 'Exonerado' AND
								created_at = '{$hoy}'
								");
						$paq_ft = mysql_fetch_assoc($paq_efect);
						$total_efectivo = $total_3['total'] + $paq_ft['total'];
					?>
					<center><p class="font16"> <strong><?php echo number_format($total_efectivo); ?> Bs.</strong></p></center>
				</div>
			</div>
		</div>

		<div class="span2">
			<div class="widget">
				<div class="widget-header">
					<center><strong>Gasto Efectivo Hoy </strong></center>
				</div>
				<div class="widget-content">
					<?php 
						$sum_4 = mysql_query("SELECT sum(monto) AS total FROM gastos_diarios WHERE 
									tipo_egreso = 'Efectivo' AND
									fecha = '{$hoy}'
									");
						$total_4 = mysql_fetch_assoc($sum_4); 
					?>
					<center><p class="font16"> <strong><?php echo number_format($total_4['total']); ?> Bs.</strong></p></center>
				</div>
			</div>
		</div>

		<div class="span2">
			<div class="widget">
				<div class="widget-header">
					<center><strong>Gasto del Dia </strong></center>
				</div>
				<div class="widget-content">
					<?php 
						$sum_5 = mysql_query("SELECT sum(monto) AS total FROM gastos_diarios WHERE 
									fecha = '{$hoy}'
									");
						$total_5 = mysql_fetch_assoc($sum_5); 
					?>
					<center><p class="font16"> <strong><?php echo number_format($total_5['total']); ?> Bs.</strong></p></center>
				</div>
			</div>
		</div>

		<div class="span2">
			<div class="widget">
				<div class="widget-header">
					<center><strong>Utilidad o deficit</strong></center>
				</div>
				<div class="widget-content">
					<?php 
						$utilidad = $total_facturado - $total_5['total'];
					?>
					<center><p class="font16"> <strong><?php echo number_format($utilidad); ?> Bs.</strong></p></center>
				</div>
			</div>
		</div>
<!-- /////////////////////////////////////////////////////////////////////// -->
		<div class="span12">
		<div class="widget">
			<div class="widget-header">
				<i class="icon-usd"></i> <strong> Ingresos del dia por pago de citas: </strong>
			</div>
			<div class="widget-content">
				<table class="table table-hover font-table">
					<thead>
						<tr>
							<th>Nº</th>
							<th>Nombre Paciente</th>
							<th>NºH</th>
							<th>Servicio</th>

							<th>Monto Total</th>
							<th>Forma de Pago</th>
							<th>Cod. Op</th>
							<th>Tipo de Pago</th>
							<th>Observación</th>
							<th>Descuento</th>
						</tr>
					</thead>
					<tbody>
					<?php $nro = 1; ?>
					<?php while($pago = mysql_fetch_assoc($pag)){ ?>
						<tr class="font-table">
							<td><?php echo $nro; ?></td>
							<?php  //buscamos el nombre del paciente
								$pac = mysql_query("SELECT nombre_completo FROM pacientes WHERE id = '{$pago['paciente_id']}' LIMIT 1 ");
								$paciente = mysql_fetch_assoc($pac); 
							?>
							<td> <?php echo $paciente['nombre_completo']; ?> </td>
				
							<td> <!-- nro d historia --> </td>
							

							<?php 
							if($pago['tipo_de_servicio'] == "Cita")
							{
								$date_cita = mysql_query("SELECT tipo FROM citas WHERE id = '{$pago['servicio_id']}' LIMIT 1 ");
								$dat_cita = mysql_fetch_assoc($date_cita);
							?>
								<td>Cita de <?php echo $dat_cita['tipo']; ?></td>
							<?php
							}
							elseif($pago['tipo_de_servicio'] == "Procedimiento")
							{
								$proc = mysql_query("SELECT nombre, cantidad FROM tratamientos WHERE id = '{$pago['servicio_id']}' LIMIT 1 ");
								$proced = mysql_fetch_assoc($proc);
							?>
							<td><?php echo $proced['nombre']; ?></td>
							<?php }
							?>
							
	
							<td><?php echo number_format($pago['monto_total']);?> Bs.</td>
							<td><?php echo $pago['forma']; ?></td>
							<td><?php echo $pago['cod_operacion']; ?></td>
							<td><?php echo $pago['tipo']; ?></td>
							<td><?php echo $pago['observacion'] ?></td>
							<td><?php echo $pago['descuento']; ?> %</td>							
						</tr>
					<?php $nro++;	} ?>	
					</tbody>

				</table>
			</div>
		</div>	

		</div>
<!-- ////////////////////////////////////////////////////////////////////////////// -->
		
	<div class="span12">
		<div class="widget">
			<div class="widget-header">
				<i class="icon-usd"></i> Ingresos del dia por pago de paquetes de tratamientos.
			</div>
			<div class="widget-content">
				<table class="table table-hover font-table">
					<thead>
						<tr>
							<th>Nº</th>
							<th>Paciente</th>
							<th>Monto Pagado</th>
							<th>Forma de Pago</th>
							<th>Cod.</th>
							<th>Tipo de Pago</th>
							<th>Cuota</th>
							<th>Estatus</th>
							<th>Restante</th>
							<th>Citas Creadas</th>
							<th>Proximo Pago</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$pago_paq = mysql_query("SELECT * FROM pagos_paquetes WHERE created_at = '{$hoy}' ");
						$nro = 1;
						while ($pay = mysql_fetch_assoc($pago_paq)) { 
							$paciente = mysql_query("SELECT nombre_completo FROM pacientes WHERE id = '{$pay['paciente_id']}' LIMIT 1");
							$paci = mysql_fetch_assoc($paciente);

							$paquet = mysql_query("SELECT * FROM paquete_aprobado WHERE id =  '{$pay['paquete_ap_id']}' LIMIT 1 ");
							$paqt = mysql_fetch_assoc($paquet);
						?>
							<tr>
								<td><?php echo $nro; $nro++; ?></td>
								<td> <?php echo $paci['nombre_completo']; ?></td>
								<td><strong><?php echo number_format($pay['monto']); ?> Bs.</strong></td>
								<td><?php echo $pay['forma']; ?></td>
								<td><?php echo $pay['cod_forma']; ?></td>
								<td><?php echo $pay['tipo_pago']; ?></td>
								<td><?php echo $pay['observacion']; ?></td>
								<td> <?php if ($paqt['status'] == "Pagado") { ?>
									<span class="label label-success">Pago Terminado</span> </td>
								<?php } 
								else if($paqt['status'] == "Por Pagar") { ?>
								 	<span class="label">Pago sin Terminar</span> 
								 <?php } ?>
								</td>
								<td><strong><?php echo number_format($paqt['restante']); ?> Bs.</strong></td>
								<td><?php echo $paqt['cita_created']; ?></td>
								<td><?php echo $paqt['proximo_pago']; ?></td>
							</tr>
					<?php };
					?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>




<!-- /////////////////////////////////////////////////////////////////////////////// -->
		<div class="span12" id="gastos">
			<div class="widget">
				<div class="widget-header">
					<h3>Gastos del Dia</h3>
				</div>
				<div class="widget-content">
				<div class="row-fluid">
					<form action="../../PHP/recepcion/register_pago_diario.php" method="POST" class="">
						<div class="span4">
							<div class="control-group">
								<label class="control-label"> Descripcion: </label>
								<input type="text" name="descripcion" class="form-control span4" reqired>
							</div>
						</div>
						<div class="span3">
							<div class="control-group">
								<label class="control-label"> Forma de Egreso: </label>
								<select name="forma_egreso" id="forma" class="form-control span2" onchange="javascript:showContent()">
											<option>Efectivo</option>
											<option>Debito</option>
											<option>Cheque</option>
											<option>Trasferencia</option>
										</select>
							</div>
							<div class="control-group" id="operacion" style="display: none;">
									<label class="control-label"><strong>Nº Operación:</strong></label>
									<input type="text" class="span1" name="operacion">
							</div>
						</div>
						<div class="span2">
							<div class="control-group">
								<label class="control-label"> Monto: </label>
								<input type="text" name="monto" class="form-control span2" required>
							</div>
						</div>
						<div class="span2">
							<div class="control-group">
							<br>
								<button class="btn btn-success" type="submit">Registrar</button>
							</div>
						</div>

					</form>
					<div class="span10">
						<?php if (isset($_GET['msg'])) {
						    $msg= $_GET['msg']; ?>
						    <div class="alert alert-danger">
						        <button type="button" class="close" data-dismiss="alert">&times;</button>
						        <strong><?php echo $msg; ?> </strong>
						    </div>
						<?php } ?>
					</div>
					
				</div>
				
				<div class="row-fluid">
					
					<div class="span12">
					<hr>
						<table class="table">
							<thead>
								<tr>
									<th>Nº</th>
									<th>Descripcion</th>
									<th>Forma</th>
									<th>Nº Operacion</th>
									<th>Monto</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$gastos = mysql_query("SELECT * FROM gastos_diarios WHERE fecha = '{$hoy}' ");
									$nro = 1;
									$total = 0;
									while($diario = mysql_fetch_assoc($gastos))
									{ ?>
										<tr>
											<td><?php echo $nro; $nro++; ?></td>
											<td><?php echo $diario['descripcion']; ?></td>
											<td><?php echo $diario['tipo_egreso']; ?></td>
											<td><?php  
													if($diario['nro_operacion'] == 0)
														{ echo "N/A";} 
													else
														{ echo $diario['nro_operacion']; }
												?>
											</td>
											<td><?php echo $diario['monto']; ?> Bs.</td>
										</tr>
										<?php $total = $total + $diario['monto'];  ?>
									<?php }
								?>
										<tr>
											<td colspan="4"></td>
											<td><strong>Total: <?php echo $total; ?> BS</strong></td>
										</tr>
							</tbody>

						</table>

					</div>
				</div>
				</div>
			</div>
		</div>	

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
</script>