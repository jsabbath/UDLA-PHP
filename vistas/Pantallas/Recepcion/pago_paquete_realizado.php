<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
	date_default_timezone_set('America/Caracas');
	$hoy = date('Y-m-d');
	$paq = $_GET['paquete'];
?>


<div class="container">
	<div class="row">
	<br>
		<div class="span12">
			<div class="widget">
				<div class="widget-header">
					<i class="icon-user"></i> <h3>Paquete Aprobado</h3>
				</div><!--  widget-header -->
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
<!-- ////////////////////////Detalles del paquete/////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////// -->

		

		<?php 
		$paq_aprob = mysql_query("SELECT * FROM paquete_aprobado WHERE id = '{$paq}' LIMIT 1 ");
		if (mysql_num_rows($paq_aprob) > 0) { 

			$paq_ap = mysql_fetch_assoc($paq_aprob);
		?>
			<div class="alert alert-block">
				<center><h3>Datos del paquete aprobado por paciente.</h3></center>	  
			</div>
			<div class="table-responsive">
				<table class="table">
				<thead>
					<tr>
						<th>Creado</th>
						<th>Estado</th>
						<th>Total</th>
						<th>Abonado</th>
						<th>Restante</th>
						<th>Cuotas</th>
						<th>Citas</th>
						<th>Creadas</th>
						<th>Prox. Pago</th>						
						<th>Ultimo Pago</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> <?php echo $paq_ap['created_at']; ?> </td>
						<td> <span class="label label-success"><?php echo $paq_ap['status']; ?> </span> </td>
						<td> <strong><?php echo $paq_ap['total']; ?> Bs.f </strong> </td>
						<td> <?php echo $paq_ap['abonado']; ?> Bs.f</td>
						<td> <?php echo $paq_ap['restante']; ?> Bs.f</td>
						<td> <?php echo $paq_ap['status_pagos']; ?> </td>
						<td> <span class="badge badge-success"><?php echo $paq_ap['citas']; ?> </span> </td>
						<td> <span class="badge badge-success"><?php echo $paq_ap['cita_created']; ?> </span> </td>
						<td> <?php echo $paq_ap['proximo_pago']; ?> </td>
						<td> <?php echo $paq_ap['updated_at']; ?> </td>
					</tr>
				</tbody>
			</table>
			<?php } ?>


			<?php if (isset($_GET['citas-ok'])) { ?>
					<center>
						<i class="icon-ok icon-4x"></i>
						<h3>Citas Creadas con Exito.</h3>
					</center>

			<div class="alert alert-block">
			  <h4>Citas Creadas:</h4>
				<ul>
			<?php 
				$num = 1;
				$citas_pq = mysql_query("SELECT * FROM citas WHERE paquete_ap_id = '{$paq}' AND created_at = '$hoy' ");
				if (mysql_num_rows($citas_pq) > 0) {
					
					while ($cita_pqt =  mysql_fetch_assoc($citas_pq)) { ?>
						
							<li> Cita <?php echo $num; $num++; ?> : <?php echo fecha_total($cita_pqt['fecha']); ?> </li>					
				<?php	}
				}
			?>
				</ul>
			</div>
			<center>
				<a href="paquetes.php?paquete=<?php echo $paq_ap['paquete_id']; ?>&paciente=<?php echo $id; ?>" class="btn btn-link" title="">Regresar al Inicio</a>
			</center>


			<?php }
			else { ?>

				<?php if (isset($_GET['msg'])) { ?>
					<center>
						<i class="icon-ok icon-4x"></i>
						<h3>Pago Realizado con Exito.</h3>
					</center>
				<?php } ?>
				<?php if (isset($_GET['error'])) { ?>
					<center>
						<i class="icon-remove icon-4x"></i>
						<h3>.</h3>
					</center>
				<?php } ?>			
				<hr>
				<center>
				<div class="alert alert-block">
						<center><h3>Creacion de citas para el paquete</h3></center>	  
				</div>

				<p><strong>Configure las citas a crear:</strong></p>
				<form action="../../PHP/recepcion/crea_citas_sucesivas.php" method="POST" class="">
					<input type="hidden" name="paciente" value="<?php echo $id; ?>">
					<input type="hidden" name="paquete" value="<?php echo $paq; ?>">

					<div class="control-group">
					    <label class="control-label">A partir de la fecha:</label>
					    <div class="controls">
					     <input type="date" required name="fecha_inicio" min="<?php echo date('Y-m-d'); ?>">
					    </div>
					</div>

					<?php 
					// **** calculamos la cantidad de citas que se deben de crear sucesivamente **
					if ($paq_ap['status_pagos'] == 'Completo') {
						$cant_citas = $paq_ap['citas'] - $paq_ap['cita_created'];
					} 
					else if ($paq_ap['status_pagos'] == 'Inicial') {
						$porcentaje = $paq_ap['citas'] * 0.60;
						$cant_citas = round($porcentaje, 0, PHP_ROUND_HALF_DOWN);
					}
					else if ($paq_ap['status_pagos'] == 'I') {
						$cant_citas = ($paq_ap['citas'] - $paq_ap['cita_created']) / 2 ;
						$cant_citas = round($cant_citas, 0, PHP_ROUND_HALF_UP);
					}
					else if ($paq_ap['status_pagos'] == 'II') {
						$cant_citas = $paq_ap['citas'] - $paq_ap['cita_created'];
					}
					else
					{
						$cant_citas = 0;
					}
					?>
					<br>
					<strong>Se crearan <?php echo $cant_citas; ?> citas.</strong>
					<input type="hidden" name="cantidad" value="<?php echo $cant_citas; ?>">
					
					<div class="control-group">
						<?php 
							$frecuencia = mysql_query("SELECT frecuencia FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paq}' GROUP BY frecuencia DESC LIMIT 1");
					 
					     		$frec = mysql_fetch_assoc($frecuencia); 
					    ?>
					    
					    <strong>En una Frecuencia de <?php echo $frec['frecuencia']; ?></strong>
					    <input type="hidden" name="frecuencia" value="<?php echo $frec['frecuencia']; ?>">
					</div>

					<button type="submit" class="btn btn-primary">Registrar</button>
    			</form>
    		</center>


		<?php } ?>


				</div> <!-- widget-content -->
			</div> <!-- widget -->
			
		</div> <!-- div span12 -->
	</div> <!-- div row -->
</div> <!-- div container -->