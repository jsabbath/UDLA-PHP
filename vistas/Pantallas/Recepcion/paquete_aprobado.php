<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
	$paquete = $_GET['id'];
	if (isset($_GET['citas'])) {
		$citas_id = $_GET['citas'];

		$ids_citas = stripcslashes($citas_id);
		$ids_citas = urldecode($ids_citas);
		$idscitas = unserialize($ids_citas);
	}
	
	$paquete_aprob = mysql_query("SELECT * FROM paquete_aprobado WHERE id = '{$paquete}' LIMIT 1 ");
	$paq = mysql_fetch_assoc($paquete_aprob);
?>


<div class="container">
	<div class="row-fluid">
	<br>
		<div class="span12">

			<div class="widget">

				<div class="widget-header">
					<i class="icon user"></i>
					<h3> Paquete de Procedimientos del Paciente:  </h3>
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
						

					<br>
					<div class="alert alert-block">
						<center><h3>Paquete Aprobado </h3></center>	  
					</div>
					<br>
					<?php if (isset($_GET['msg'])) { ?>
						<div class="alert alert-info">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Exito!</strong> Se han creado las citas sucesivas para el paciente en las siguientes fechas:<br>
						  	<?php
						  		$num = 1;	 
						  		foreach ($idscitas as $idc) {
						  			$date = mysql_query("SELECT * FROM citas WHERE id = '{$idc}' LIMIT 1 ");
						  			$dates = mysql_fetch_assoc($date);?>
						  			<span class="label"> <?php echo $num; $num++; ?>  </span>
						  			 <?php echo fecha_total($dates['fecha']); ?> <br>
						  	<?php	}
						  	 ?>
						</div>
					<?php } 
						else if (isset($_GET['error'])) { ?>
						<div class="alert alert-error">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Lo sentimos!</strong> No se pudieron crear las citas sucesivas para el paciente.
						</div>
					<?php } ?>

					<?php 
					$paq_aprob = mysql_query("SELECT * FROM paquete_aprobado WHERE id = '{$paquete}' LIMIT 1 ");
					if (mysql_num_rows($paq_aprob) > 0) { 

						$paq_ap = mysql_fetch_assoc($paq_aprob);
					?>
						
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

					<?php } ?>











					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sesiones</th>
								<th colspan="2"> Procedimiento</th>
								<th>Monto</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$procedimiento = mysql_query("SELECT * FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paq['id']}' ");
							$total = 0;
							while ($proc = mysql_fetch_assoc($procedimiento)) { ?>
								<tr>
									<td><?php echo $proc['cantidad']; ?></td>
									<td colspan="2"> <?php echo $proc['nombre']; ?></td>
									<td><?php echo number_format($proc['precio']); ?> bs.f</td>
									<td>
										<?php $total_u = $proc['cantidad'] * $proc['precio']; 
											echo number_format($total_u);
										?> bs.f
									</td>
									<?php $total = $total + $total_u; ?>
								</tr>
						<?php } ?>
								<tr>
									<td></td>
									<td colspan="2" ></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2" ><strong class="text-right">TOTAL UNITARIO:</strong></td>
									<td><strong><?php echo number_format($total); ?> Bs.f</strong> </td>
									<td></td>
								</tr>
								<?php 
								if ($paq['descuento'] == "5%" ) { 
									$descu = $total * 0.05;
									$total_pagar = $total - $descu;

									?>
									<tr>
										<td></td>
										<td colspan="2">5%</td>
										<td><strong><?php echo number_format($descu); ?> Bs.f</strong></td>
										<td></td>
										
									</tr>								
								<?php }
								else if ($paq['descuento'] == "10%" ) { 
									$descu = $total * 0.10;
									$total_pagar = $total - $descu;

									?>
									<tr>
										<td></td>
										<td colspan="2">10%</td>
										<td><strong><?php echo number_format($descu); ?> Bs.f</strong></td>
										<td></td>
										
									</tr>								
								<?php }
								else
								{
									$total_pagar = $total;
								}
								?>
								<tr>
									<td></td>
									<td colspan="2"><p class="text-right">Total:</p></td>
									<td><strong><?php echo number_format($total_pagar); ?> Bs.f</strong></td>
									<td>Contado</td>
								</tr>
								

						</tbody>
					</table>
					
					<div class="">
						<!-- <a href="#myModal" role="button" data-toggle="modal" class="btn btn-default btn-large" title="Generar Citas"><i class="icon-calendar"></i> Generar Citas Sucesivas</a> -->

						<a href="../../PHP/recepcion/presupuesto_pdf.php?paq=<?php echo $paquete; ?>&pac=<?php echo $id;?>" target="_blank" class="btn btn-default btn-large " title="Imprimir"><i class="icon-print"></i> Imprimir</a>
						<a href="paquetes.php?paquete=<?php echo $paq['paquete_id']; ?>&paciente=<?php echo $paq['paciente_id']; ?>" target="_blank" class="btn btn-default btn-large " title="Imprimir"><i class="icon-chevron-left"></i> Regresar</a>

						<br>
					</div>
					<br>
					
					<div class="alert alert-block">
						<center><h3>Registrar Pago del Paquete.</h3></center>	  
					</div>

	<!-- ///////////////metodo de pagoooo /////////////////////////////// -->
	<center>
					<form action="" method="POST" class="form-inline" >
						
						<div class="control-group">
							<label class="control-label" for="radios"><strong>Metodo de Pago:</strong></label>
							<label class="radio">
							  <input type="radio" name="metodo" id="Radios1" value="Contado" checked onchange="javascript:showMetodo()">
							  Contado
							</label>
							<label class="radio">
							  <input type="radio" name="metodo" id="Radios" value="Credito" onchange="javascript:showMetodo()">
							  Credito
							</label>
						</div>
					
					</form>
<!-- /////////////// pago de contado /////////////////////////////// -->

					<div id="contado" style="">
						<form action="../../PHP/recepcion/pagos_paquetes.php" method="POST" accept-charset="utf-8">
							<input type="hidden" name="paquete_ap" value="<?php echo $paquete; ?>">
							<input type="hidden" name="paciente" value="<?php echo $id; ?>">
							<input type="hidden" name="metodo" value="contado">
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
							    		<label class="control-label"><strong>Monto a Pagar:</strong></label>
							    		<input type="hidden" id="total" value="" >
							    		<input type="text" class="span2" name="monto" id="monto" required readonly value="<?php echo number_format($paq_ap['restante']); ?>" > <strong>Bs.f</strong>
							    		<p style="display:none;" id="msg" class="text-error">El monto ingresado es incorrecto.</p>
							    	</div>

							    	<div class="control-group">
							    		<button type="submit" name="contado" class="btn btn-large btn-success">Registrar Pago</button>
							    	</div>
							
						</form>
					</div>

<!-- /////////////// pago a credito/////////////////////////////// -->

			<div id="credito" style="display:none;">
				<form action="../../PHP/recepcion/pagos_paquetes.php" class="form-inline" method="POST" accept-charset="utf-8" onsubmit="return validacion()">
					<input type="hidden" name="paquete_ap" value="<?php echo $paquete; ?>">
					<input type="hidden" name="paciente" value="<?php echo $id; ?>">
					<input type="hidden" name="metodo" value="credito">
				
					<?php 
						$inicial = $total_pagar * 0.65;
						$cuota = ($total_pagar - $inicial) / 2;
						$cuota3 = ($total_pagar - $inicial) / 3;
					?>


						<div class="control-group">
			    		<label class="control-label"><strong>Forma de pago:</strong></label>
			    		<select name="forma_pago" id="forma2" class="form-control" onchange="javascript:showContentCredit()">
			    			<option>Efectivo</option>
			    			<option>Debito</option>
			    			<option>Tarjeta de credito</option>
			    			<option>Cheque</option>
			    			<option>Trasferencia</option>
			    		</select>
			    	</div>

			    	<div class="control-group" id="operacion2" style="display: none;">
			    		<label class="control-label"><strong>Nº Operación:</strong></label>
			    		<input type="text" class="span1" name="operacion">
			    	</div>
			    	<center>
			    	<div class="control-group">
						<label class="control-label" for="radios"><strong>Pago:</strong></label>
						<label class="radio">
						  <input type="radio" name="cuota" id="" value="Inicial" required onchange="javascript:showMetodo()">
						  Inicial
						</label>
						<label class="radio">
						  <input type="radio" name="cuota" id="" value="I" onchange="javascript:showMetodo()">
						  Cuota I
						</label>
						<label class="radio">
						  <input type="radio" name="cuota" id="" value="II" onchange="javascript:showMetodo()">
						  Cuota II
						</label>
					</div>
					</center>	
			    	<div class="control-group">
			    		<p><strong>Inicial a Pagar 65%:</strong> <?php echo number_format($inicial); ?> Bs </p>
			    		<p><strong>2 Cuotas de:</strong> <?php echo number_format($cuota);?> Bs o <br> <strong>3 Cuotas de:</strong> <?php echo number_format($cuota3); ?> Bs</p>
			    		<label class="control-label"><strong>Monto a Pagar:</strong></label>
			    		<input type="hidden" id="total" value="" >
			    		<input type="number" class="span2" name="monto" id="monto_cre" required min="0"  value="" > <strong>Bs.f</strong>
			    		<span style="display:none;" id="msg" class="help-inline">El monto ingresado es incorrecto.</span>
			    	</div>

			    	<div class="control-group">
			    		<button type="submit" name="credito" class="btn btn-large btn-success">Registrar Pago</button>
			    	</div>
					
				</form>
			</div>
			</center>
				</div> <!-- widget-content -->						
				
			</div>
		</div>
	</div>
</div>
 

<script type="text/javascript">
	function showMetodo() {
        element = document.getElementById("credito");
        element2 = document.getElementById("contado");
        check = document.getElementById("Radios");
        if (check.checked) {
            element.style.display='block';
            element2.style.display = 'none';
        }
        else {
            element.style.display='none';
            element2.style.display = 'block';
        }
    }

    function showContentCredit() {
        element = document.getElementById("operacion2");
        select = document.getElementById("forma2");
        if (select.value == "Cheque" || select.value == "Trasferencia" ) {
            element.style.display='block';
        }
        else {
        	
            element.style.display='none';
        }
    }
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
    /*function showContent2() {
        element = document.getElementById("obs");
        select = document.getElementById("tipo");
        if (select.value == "Exonerado" || select.value == "Pagado" ) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }*/

    function validacion () {
    	monto = document.getElementById("monto_cre").value;
    	msg = document.getElementById("msg");
    	if (isNaN(monto)) {
    		msg.style.display = 'block';
    		return false;
    	};
    }
</script>
