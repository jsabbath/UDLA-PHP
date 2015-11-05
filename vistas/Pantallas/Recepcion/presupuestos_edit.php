<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
?>
<script type="text/javascript">
$(document).ready(function() {
   $(document).on("click",".eliminar",function(){
       
       var eliminar = confirm("Esta seguro que desea Quitar el procedimiento del presupuesto.?");
     	if ( eliminar ) {
     		var parent = $(this).parent();
       		$(parent).remove();
       	}
    });
 });
function calcular(descuento, total, totaltext){		
		desc = (total * descuento) / 100;
		totaltext.value = total - desc; 
	}
</script>
<div class="main-inner">
		<div class="container">
		<br>
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
					<hr>
<!-- /////////////////////////////////////Detalles del paquete////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

	<h3>Datos del paquete:</h3>
	<?php 
	$paquete_id = $_GET['paquete'];
	$detalle_paq = mysql_query("SELECT * FROM paquetes WHERE  id ='{$paquete_id}'");
	$filas_paq = mysql_num_rows($detalle_paq);
	if($filas_paq > 0)
		$paqt = mysql_fetch_assoc($detalle_paq);
	{?>
		<div class="span12">
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

	<center>

		<span class="label label-success font16">
			Edite el presupuesto a solicitud del paciente:
		</span>
	</center>
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
					<th colspan="">Procedimiento</th>
					<th>Lugar</th>
					<th>Sesiones</th>
					<th>Monto</th>
					<th>Total</th>
					<th>Accion</th>
				</tr>
		<form method="POST" action="../../PHP/recepcion/aprobar_presupuesto.php">

		<?php
		$total_unitario = 0;
		$sesiones = 0;
		$proc = 0;
		$nro = 1;
		while($lista_trat = mysql_fetch_assoc($detalle_trat))
		{ ?>
		
				<?php 
					$procedimiento = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre= '{$lista_trat['nombre']}' ");
					$monto = mysql_fetch_assoc($procedimiento);
				?>
				<tr>
					<input type="hidden" name="paquete" value="<?php echo $paquete_id; ?>">
					<input type="hidden" name="paciente" value="<?php echo $paciente['id']; ?>">
					<input type="hidden" name="id_procedimiento[]" value="<?php echo $lista_trat['id']; ?>">

					<td><?php echo $nro; ?></td>
					
					<td><?php echo $lista_trat['nombre']; ?></td>
					<td><?php echo $lista_trat['parte']; ?> </td>
					<td> 
						<input type="number" name="cant[]" class="span1" value="<?php echo $lista_trat['cantidad']; ?>" >
					</td>
					<td>
						<?php echo $monto['precio']; ?> Bs.
						<input type="hidden" name="monto[]" value="<?php echo $monto['precio']; ?>">
					</td>
					<td><?php  
					$total = $monto['precio'] * $lista_trat['cantidad'];
					echo $total;
					?>Bs.
					</td>
					<td class="eliminar"><button class="btn"><i class=" icon-remove"></i>  Quitar</button></td>

				</tr>
				<?php 
				$total_unitario = $total_unitario + $total; 
				$proc++;
				$sesiones = $sesiones + $lista_trat['cantidad'];
				$nro++;
				?>
			<?php } ?>
			<tr>
				<td colspan="4"> </td>
				<td><strong>TOTAL:</strong></td>
				<td><strong> <?php echo $total_unitario; ?> Bs.f</strong> </td>
				<td></td>
			</tr>

			<tr>
				<td colspan="2"></td>
				<td></td>  
				<td>
				<b>Descuento:</b>
				<div class="controls">
					<label class="radio inline">
						<input type="radio" name="desc" value="si" > Si
					</label>
					<label class="radio inline">
						<input type="radio" name="desc" value="no" checked> No
					</label>
					
				</div>
				</td>
				<?php if($total_unitario < 15000 ){
						echo "<td>0%</td>";
						echo "<td></td> ";
						$total_pagar = $total_unitario;
						?><input type="hidden" name="porcentaje" value="0%"><?php
					}
					else if(($total_unitario > 15000) AND ($total_unitario < 40000)){
						echo "<td>5%</td>";
						$descuento = $total_unitario * 0.05;
						echo "<td><b>".$descuento."</b> Bs.</td> ";
						$total_pagar = $total_unitario - $descuento;
						?><input type="hidden" name="porcentaje" value="5%"><?php
					} 

					elseif($total_unitario > 40000 ){
						echo "<td>10%</td>";
						$descuento = $total_unitario * 0.10;
						echo "<td><b>".$descuento."</b> Bs.</td>";
						$total_pagar = $total_unitario - $descuento;
						?><input type="hidden" name="porcentaje" value="10%"><?php
					} ?>
					<td></td>		
			</tr>

			<tr>
				<td colspan="4"></td>
				<td colspan=""><b>TOTAL A PAGAR DE CONTADO</b></td>  
				<td><b><?php echo $total_pagar; ?> Bs.f</b> </td>
				<input type="hidden" name="total_pagar" value="<?php echo $total_pagar; ?>">
				<td></td>	
			</tr>

			
			<tr>
				<td colspan="2"></td>
				<td colspan="2">
					<a href="paquetes.php?paquete=<?php echo $paquete_id;?>&paciente=<?php echo $id; ?>" class="btn btn-success btn-large"><i class=" icon-chevron-right"></i> Cancelar</a>
				</td>
				<td colspan="">
					<button type="submit" class="btn btn-success btn-large"><i class=" icon-chevron-right"></i> APROBAR</button>
				</td>
				<td></td>
				<td></td>
				</form>
			</tr>		
		</table>
		</div>


		<?php } //if principal ?>


				</div> <!-- FIN WIDGET CONTENT -->
			</div> <!-- FIN WIDGET -->
		</div>
	</div>
</div>