<?php
	$header=2;
	$activo=6;
	include "../../config/datos.php"; 
	require('../../header.php');
	include("../../PHP/funciones.php");
	date_default_timezone_set('America/Caracas');
	$hoy = date('2016-01-22');
	$citas = mysql_query("SELECT citas.*, pacientes.id As id_pac,pacientes.nombre_completo, pacientes.telefono 
		FROM citas
		INNER JOIN pacientes ON citas.paciente_id = pacientes.id
		WHERE fecha = '{$hoy}' 
		AND status_pago = 0 
		AND tipo != 'Tratamiento'
		AND status != 3 
		AND status != 10
        ORDER BY updated_at ASC");		
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
									<td><?php echo $nro; $nro++; ?></td>
									<td><?php echo $cita['nombre_completo']; ?></td>
									<td><?php echo $cita['telefono']; ?></td>
									<td><?php echo $cita['tipo']; ?></td>
									<td><?php echo $cita['fecha']; ?></td>
									<td>
										<?php if ( $cita['status']==0) { ?>
											<div class="confirmar segunda font-normal">Por Confirmar</div>
										<?php } 
											elseif ($cita['status'] == 2){?>
											<div class=" text font-normal">En Espera</div>	
										<?php } 
											elseif ($cita['status']==1) { ?>
											<div class="confirmada segunda font-normal">Confirmada</div>	
										<?php } elseif ($cita['status']==100) { ?>
											<div class="confirmada segunda font-normal">Ausente</div>	
										<?php } ?>
									</td>
									<td>
										<?php 
											if($cita['tipo'] != "Tratamiento"){ ?>
											<a href="pagar.php?cita=<?php echo $cita['id']; ?>" class="btn btn-primary font-table">Registrar Pago</a>
										<?php } ?>
									</td>

								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>