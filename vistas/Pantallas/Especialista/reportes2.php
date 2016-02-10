<?php 
$header=1;
$activo=7;
require('../../header.php');
include('../../PHP/recepcion/conecciones.php'); 
date_default_timezone_set('America/Caracas');
if (isset($_POST['fecha'])) {
	$fecha = $_POST['fecha'];
}
else
{
	$fecha = date('Y-m-d');
}
$costo_cita = 6500;
$cita_emergencia = 10000;
?>

<div class="container">
	<div class="row">
		<div class="span12">
		    <center>
		      <form action="" method="POST" class="form-inline" accept-charset="utf-8">       
		        <div class="control-group">
		        <br>
		            <p>Seleccione otra fecha para visualizar el reporte.</p>
		            <input type="date" name="fecha" required>
		            <button type="submit" class="btn btn-default">Buscar</button>
		        </div>
		      </form>
		        <h2>Reporte General: <?php echo strftime('%d %b de %G', strtotime($fecha)); ?> </h2>
		         <br> 
		    </center>
		</div>

		<div class="span12">
			<div class="widget">
				<div class="widget-header">
					<i class="icon-file"></i> <h3>Reporte General  <?php echo strftime('%d %b de %G', strtotime($fecha)); ?></h3>
				</div>

				<div class="widget-content">
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////PACIENTE NUEVO//////////////////////////////////////////-->
					<div class="alert alert-block">
						<center><h3>Pacientes por Nuevo Caso</h3></center>	  
					</div>
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>N°</th>
				                <th>Nombre Paciente</th>
				                <th>Nro de Móvil</th>
				                <th>Tipo de Cita</th>
				                <th width="20%">Remitido</th>
				                <th width="15%">Status pago</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$n1 = 1;
							$consulta1 = "SELECT citas.*, pacientes.nombre_completo,
								pacientes.telefono
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$fecha}' AND status = 3 AND tipo = 'Nuevo' ";
							$nuevo = mysql_query($consulta1);
							while ($nuevos = mysql_fetch_assoc($nuevo)) {
						?>
							<tr>
								<td><?php echo $n1; $n1++; ?></td>
								<td><?php echo $nuevos['nombre_completo']; ?> </td>
								<td><?php echo $nuevos['telefono']; ?> </td>
								<td><?php echo $nuevos['tipo']; ?> </td>
								<td><?php echo $nuevos['remitido']; ?> </td>
								<td>
									<?php 
									if ($nuevos['status_pago'] == 0) { ?>
										<span class="label label-warning labels"><i class="icon-remove"></i> Sin Pagar</span>
									<?php }
									else if($nuevos['status_pago'] == 1){ ?>
											<span class="label label-success labels"><i class="icon-ok"></i> Pagado</span>
									<?php } ?> 
								</td>
							</tr>
						<?php } ?>					
							<tr>
								<td colspan="4"></td>
								<td class="resultados"> <strong>Total Generado:</strong> </td>
								<td class="resultados"> <strong>
									<?php $total_nuevos = ($n1 - 1) * $costo_cita; 
										echo number_format($total_nuevos);
									?> BS </strong>
								</td>
							</tr>
						</tbody>
					</table>
<!--//////////////////////////////////////////////////////////////////////////-->
<!--////////////////////////PACIENTES CONTROL////////////////////////////////////////////-->
					<div class="alert alert-block">
						<center><h3>Pacientes por Control</h3></center>	  
					</div>
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>N°</th>
				                <th>Nombre Paciente</th>
				                <th>Nro de Móvil</th>
				                <th>Tipo de Cita</th>
				                <th width="20%">Remitido</th>
				                <th width="15%">Status pago</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$n2 = 1;
							$consulta2 = "SELECT citas.*, pacientes.nombre_completo,
								pacientes.telefono
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$fecha}' AND status = 3 AND tipo = 'Control' ";
							$control = mysql_query($consulta2);
							while ($controles = mysql_fetch_assoc($control)) {
						?>
							<tr>
								<td><?php echo $n2; $n2++; ?></td>
								<td><?php echo $controles['nombre_completo']; ?> </td>
								<td><?php echo $controles['telefono']; ?> </td>
								<td><?php echo $controles['tipo']; ?> </td>
								<td><?php echo $controles['remitido']; ?> </td>
								<td>
									<?php 
									if ($controles['status_pago'] == 0) { ?>
										<span class="label label-warning labels"><i class="icon-remove"></i> Sin Pagar</span>
									<?php }
									else if($controles['status_pago'] == 1){ ?>
											<span class="label label-success labels"><i class="icon-ok"></i> Pagado</span>
									<?php } ?> 
								</td>
							</tr>
						<?php } ?>					
							<tr>
								<td colspan="4"></td>
								<td class="resultados"> <strong>Total Generado:</strong> </td>
								<td class="resultados"> <strong>
									<?php $total_control = ($n2 - 1) * $costo_cita; 
										echo number_format($total_control);
									?> BS </strong>
								</td>
							</tr>
						</tbody>
					</table>
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////PACIENTE POR CIRUJIA ///////////////////////////////////-->
					<div class="alert alert-block">
						<center><h3>Pacientes por Cirujia</h3></center>	  
					</div>
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>N°</th>
				                <th>Nombre Paciente</th>
				                <th>Nro de Móvil</th>
				                <th>Tipo de Cita</th>
				                <th width="20%">Remitido</th>
				                <th width="15%">Status pago</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$n3 = 1;
							$consulta3 = "SELECT citas.*, pacientes.nombre_completo,
								pacientes.telefono
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$fecha}' AND status = 3 AND tipo = 'Cirujia' ";
							$cirujia = mysql_query($consulta3);
							while ($cirujias = mysql_fetch_assoc($cirujia)) {
						?>
							<tr>
								<td><?php echo $n3; $n3++; ?></td>
								<td><?php echo $cirujias['nombre_completo']; ?> </td>
								<td><?php echo $cirujias['telefono']; ?> </td>
								<td><?php echo $cirujias['tipo']; ?> </td>
								<td><?php echo $cirujias['remitido']; ?> </td>
								<td>
									<?php 
									if ($cirujias['status_pago'] == 0) { ?>
										<span class="label label-warning labels"><i class="icon-remove"></i> Sin Pagar</span>
									<?php }
									else if($cirujias['status_pago'] == 1){ ?>
											<span class="label label-success labels"><i class="icon-ok"></i> Pagado</span>
									<?php } ?> 
								</td>
							</tr>
						<?php } ?>					
							<tr>
								<td colspan="4"></td>
								<td class="resultados"> <strong>Total Generado:</strong> </td>
								<td class="resultados"> <strong>
									<?php $total_cirujia = ($n3 - 1) * $costo_cita; 
										echo number_format($total_cirujia);
									?> BS </strong>
								</td>
							</tr>
						</tbody>
					</table>
<!--//////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////PACIENTE POR EMERGENCIA//////////////////////////////-->
						<div class="alert alert-block">
							<center><h3>Pacientes por Emergencia</h3></center>	  
						</div>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>N°</th>
					                <th>Nombre Paciente</th>
					                <th>Nro de Móvil</th>
					                <th>Tipo de Cita</th>
					                <th width="20%">Remitido</th>
					                <th width="15%">Status pago</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$n4 = 1;
								$consulta4 = "SELECT citas.*, pacientes.nombre_completo,
									pacientes.telefono
									FROM citas
									INNER JOIN pacientes ON citas.paciente_id = pacientes.id
									WHERE fecha = '{$fecha}' AND (status = 3 OR status = 2) AND tipo = 'Emergencia' ";
								$emergencia = mysql_query($consulta4);
								while ($emergencias = mysql_fetch_assoc($emergencia)) {
							?>
								<tr>
									<td><?php echo $n4; $n4++; ?></td>
									<td><?php echo $emergencias['nombre_completo']; ?> </td>
									<td><?php echo $emergencias['telefono']; ?> </td>
									<td><?php echo $emergencias['tipo']; ?> </td>
									<td><?php echo $emergencias['remitido']; ?> </td>
									<td>
										<?php 
										if ($emergencias['status_pago'] == 0) { ?>
											<span class="label label-warning labels"><i class="icon-remove"></i> Sin Pagar</span>
										<?php }
										else if($emergencias['status_pago'] == 1){ ?>
												<span class="label label-success labels"><i class="icon-ok"></i> Pagado</span>
										<?php } ?> 
									</td>
								</tr>
							<?php } ?>					
								<tr>
									<td colspan="4"></td>
									<td class="resultados"> <strong>Total Generado:</strong> </td>
									<td class="resultados"> <strong>
										<?php $total_emergencia = ($n4 - 1) * $cita_emergencia; 
											echo number_format($total_emergencia);
										?> BS </strong>
									</td>
								</tr>
							</tbody>
						</table>
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
			<div class="alert alert-block">
				<center><h3>Pacientes por Tratamientos de Cabina</h3></center>	  
			</div>
			<table class="table table-hover table-condensed" >
			  <thead>
			    <tr>
			      <th>N°</th>
			      <th>Paciente</th>
			      <th>Procedimientos</th>
			      <th>Aplicado Por</th>
			      <th width="20%">Fecha de Aplicacion</th>
			      <th width="15%">Precio</th> 
			    </tr>
			  </thead>			  
			  <tbody>
			    <?php 
			      $nro = 1;
			      $bonos = 0;
			      $ganacias = 0;
			      $consulta = "SELECT reportes.*, 
			                  pacientes.id, pacientes.nombre_completo, 
			                  tratamientos.nombre as tratamiento, tratamientos.id, 
			                  porcentaje.*, lista_tratamientos.nombre as trat_lista, lista_tratamientos.precio
			                  FROM reportes
			                  INNER JOIN pacientes ON pacientes.id = reportes.paciente_id
			                  INNER JOIN tratamientos ON tratamientos.id = reportes.tratamiento_id
			                  INNER JOIN porcentaje ON porcentaje.id = reportes.usuario_id
			                  INNER JOIN lista_tratamientos ON tratamientos.nombre = lista_tratamientos.nombre
			                  WHERE reportes.ctreated_at = '{$fecha}'";
			      $reportes = mysql_query($consulta);
			      while ($datos = mysql_fetch_assoc($reportes)) {
			    ?>
			        <tr>
			          <td><?php echo $nro; $nro++; ?></td>
			          <td><?php echo $datos['nombre_completo']; ?> </td>
			          <td><?php echo $datos['tratamiento']; ?> </td>                  
			          <td><?php echo $datos['nombre']; ?> </td>
			          <td><?php echo strftime('%d %b de %G', strtotime($datos['ctreated_at'])); ?> </td>
			          <td><?php echo number_format($datos['precio']); ?>.BS </td>
			        </tr>
			        <?php
			          $ganacias = $ganacias + $datos['precio'];
			        ?>
			    <?php } ?>  
			  </tbody>
			  <tfooter> 
			    <tr>
			        <td colspan="4"></td>
			        <td class="resultados">
			        	Total Generado:
			        </td>
			        <td class="resultados">
			          <strong><?php echo number_format($ganacias); ?> Bs</strong>
			        </td>
			    </tr>
			  </tfooter>
			</table>
<!--//////////////////////////////////////////////////////////////////////////-->
			<div class="total">
				<center>
					Total Neto: 
					<?php $neto = $total_nuevos + $total_control + $total_emergencia + $total_cirujia + $ganacias; 
						echo number_format($neto);
					?> Bs
				</center>
			</div>
				</div> <!-- widget-content -->
			</div> <!-- widget -->
		</div> <!-- span12 -->
	</div> <!-- row -->
</div>