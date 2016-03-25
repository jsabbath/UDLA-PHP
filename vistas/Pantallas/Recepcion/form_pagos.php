<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
	$paquete = $_POST['paquete'];
	$paciente = $_POST['paciente'];
	$id = $_POST['id_procts'];
	$precio = $_POST['monto'];
	$cant = $_POST['cant'];
?>
<script type="text/javascript">	
	function calcular(descuento, total, totaltext){		
		desc = (total * descuento) / 100;
		totaltext.value = total - desc; 
	}
</script>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="widget">
				<div class="widget-header">
					<strong>Pago de Procedimientos:</strong>
				</div>
				<div class="widget-content">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Nº</th>
									<th>Procedimiento</th>								
									<th>Cant. Sesiones</th>
									<th>Monto</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							<form method="POST" action="../../PHP/recepcion/registrar_pago.php">
								<input type="hidden" name="paquete" value="<?php echo $paquete; ?>">
								<input type="hidden" name="paciente" value="<?php echo $paciente; ?>">
							<?php
								$nro = 1;
								$total = 0; 
								for ($i=0; $i <count($id); $i++) {

									$separar = explode("-", $id[$i]);
									$id_p = $separar[0];
									$monto_p = $separar[1];
									$proced = mysql_query("SELECT * FROM tratamientos WHERE id = '{$id_p}' LIMIT 1 ");
									$datos = mysql_fetch_assoc($proced);
								?>
								<input type="hidden" name="procedimientos[]" value="<?php echo $id[$i].'-'.$monto_p; ?>">
								<tr>
									<td><?php echo $nro; ?></td>
									<td> <?php echo $datos['nombre']; ?> </td>
									<td> 
										<strong><?php echo $cant[$i]; ?></strong>
									</td>
									<td><?php echo $monto_p; ?> Bs.f</td>
									<td><?php $subtotal = $cant[$i] * $monto_p; echo $subtotal; ?> Bs.f</td>
									<input type="hidden" name="subtotal[]" value="<?php echo $subtotal; ?>">
									<?php $total = $total + $subtotal; ?>
								</tr>

							<?php $nro++;	}
							?>
							<tr>
								
								<td colspan="2">
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
								</td>
								<td colspan="">
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
								</td>
								<td>
									<div class="control-group">
										<label class="control-label"><strong>Descuento:</strong></label>
										<input type="hidden" id="total" value="<?php echo $total;?>" >
										<input type="text" id="descuento" class="span1" name="descuento" value="0" onChange="calcular(this.value,total.value,totaltext);"> <strong>%</strong>
									</div>
								</td>
								<td>
									<label class="control-label"><strong>Total a Pagar:</strong></label>
									<input type="text" id="totaltext" class="" name="totaltext" readonly value="<?php echo $total; ?>" >
								</td>
							</tr>
							
							<tr>
								<td colspan="4"></td>
								<td> 
									<button class="btn btn-success btn-large" type="submit">Registrar Pago</button>
								</td>
							</tr>
							</form>
							</tbody>
						</table>
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