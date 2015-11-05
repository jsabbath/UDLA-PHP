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
						<i class="icon-calendar"></i> <h3> Procedimientos Sin Paquete:</h3>
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
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>