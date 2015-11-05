<?php
	$header=2;
	$activo=6;
	include "../../config/datos.php"; 
	require('../../header.php');
	include("../../PHP/funciones.php");
	$cita_id = $_GET['cita'];
	date_default_timezone_set('America/Caracas');
	$hoy = date('Y-m-d');
	$citas = mysql_query("SELECT * FROM citas WHERE id = '{$cita_id}' ");
	$cita = mysql_fetch_assoc($citas);			
?>

<div class="main">
	<div class="container">
		<div class="row">
			<div class="span12">			
				<div class="widget">
					<div class="widget-header">
						<i class="icon-credit-card"></i>
						<h3>Pago de Citas</h3>
					</div>
					<div class="widget-content">
			<!-- ////////////////////DATOS DE LA CITA////////////////// -->
						<center><h3>Datos de la Cita:</h3></center>
						<table class="table">
							<thead> 
								<tr>
									<th>Paciente</th>
									<th>Telefono</th>
									<th>Nº Historia</th>
									<th>Fecha Cita</th>
									<th>Motivo</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<?php
									$pac = mysql_query("SELECT nombre_completo, telefono FROM pacientes WHERE id = '{$cita['paciente_id']}' ");
									$paciente = mysql_fetch_assoc($pac);
								?>
									<td><?php echo $paciente['nombre_completo']; ?></td>
									<td><?php echo $paciente['telefono']; ?></td>
									<td><?php echo $cita['nro_historia']; ?></td>
									<td><?php echo $cita['fecha']; ?></td>
									<td><?php echo $cita['tipo']; ?></td>
									<td>
										<?php if ( $cita['status']==0) { ?>
											<div class="confirmar segunda font-table">Por Confirmar</div>
										<?php } 
											elseif ($cita['status'] == 2){?>
											<div class="parpadea text font-table">En Espera</div>	
										<?php } 
											elseif ($cita['status']==1) { ?>
											<div class="confirmada segunda font-table">Confirmada</div>	
										<?php } ?>
									</td>
								</tr>
							</tbody>
						</table>

				<!-- ////////////////////MENSAJES DEL REGISTRO////////////////// -->
						<?php if(isset($_GET['msg'])){ 
								if($_GET['msg'] == "ok"){ ?>
								<div class="alert alert-success">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <strong>Exito.</strong> El pago de la cita ha sido registrado con exito.
								</div>
						<?php } 
						else{ ?>
								<div class="alert alert-danger">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <strong>Lo sentimos!</strong> Ha ocurrido un error y no se registro el pago de la cita.
								</div>
						<?php
							}
						 } ?>
				<!-- ////////////////////ESTADO DE PAGO DE LA CITA////////////////// -->

						<?php if($cita['status_pago'] == 1){ ?>

							<center>
								<i class="icon-ok icon-4x"></i>
								<h3>Cita Pagada</h3>
							</center>
						<?php 
						}
						else{
						?>
						<form action="../../PHP/recepcion/pagar_citas.php" method="POST">
						<hr>
							<center><h3>Datos del Pago:</h3></center>
							<br>
							<input type="hidden" name="cita_id" value="<?php echo $cita['id']; ?>">
							<input type="hidden" name="paciente_id" value="<?php echo $cita['paciente_id']; ?>">
							<div class="row-fluid">
								<div class="span3">
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
									<div id="operacion" style="display: none;">
										<label class="control-label"><strong>Nº Operación:</strong></label>
										<input type="text" class="span1" name="operacion">
									</div>
								</div>
								<div class="span3">
									<div class="control-group">
										<label class="control-label"><strong>Tipo de pago:</strong></label>
										<select name="tipo_pago" id="tipo" class="form-control" onchange="javascript:showContent2()">
											<option>Contado</option>				
											<option>Exonerado</option>
										</select>
									</div>
									<div id="obs" style="display: none;" >
										<label class="control-label"><strong>Observación:</strong></label>
										<textarea type="text" class="span" name="observacion"> </textarea>
										<span class="help-block font-normal">Indique la razón por la que este pago es exonerado.</span>
									</div>
								</div>
								<div class="span3">
									<div class="contro-group">
										<label class="control-label"><strong>Monto a Pagar:</strong></label>
											<input type="number" class="span2" name="monto" placeholder="000.00" required>
									</div>
								</div>
								<div class="span3">
									<div class="contro-group">
										<br>
										<button class="btn btn-large btn-success ">Registrar Pago</button>
									</div>									
								</div>

							</div>
						</form>
						<?php	} ?>
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
</script>