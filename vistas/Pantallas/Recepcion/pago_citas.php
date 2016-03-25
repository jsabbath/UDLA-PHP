<?php
	$header=2;
	$activo=6;
	include "../../config/datos.php"; 
	require('../../header.php');
	include("../../PHP/funciones.php");
	date_default_timezone_set('America/Caracas');
	$hoy = date('Y-m-d');
	$citas = mysql_query("SELECT * FROM citas WHERE 
						fecha = '{$hoy}' AND
						status != 3 AND
						Status != 10
						");			
?>


<div class="main">
	<div class="container">
		<div class="row">
			
			<div class="span12">
				<div class="widget">
					<div class="widget-header">
						<i class="icon-calendar"></i> <h3>Citas: <?php echo fecha_total($hoy); ?></h3>
					</div>
					<div class="widget-content">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>nro</th>
									<th>Paciente</th>
									<th>Nro de Móvil</th>
									<th>Motivo</th>
									<th>Nº Historia</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$nro = 1;
							while($cita = mysql_fetch_assoc($citas)) 
							{
							?>
								<tr>
									<td><?php echo $nro; ?></td>
									<?php 
										$pac = mysql_query("SELECT nombre_completo, telefono FROM pacientes WHERE id = '{$cita['paciente_id']}' ");
										$paciente = mysql_fetch_assoc($pac);
									?>
									<td><?php echo $paciente['nombre_completo']; ?></td>
									<td><?php echo $paciente['telefono']; ?></td>
									<td><?php echo $cita['tipo']; ?></td>
									<td><?php echo $cita['nro_historia']; ?></td>
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
									<td>
										<?php 
											if($cita['tipo'] != "Tratamiento"){ ?>
											<a href="pagar.php?cita=<?php echo $cita['id']; ?>" class="btn btn-primary font-table">Registrar Pago</a>
										<?php } ?>
									</td>

								</tr>
							<?php $nro++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>