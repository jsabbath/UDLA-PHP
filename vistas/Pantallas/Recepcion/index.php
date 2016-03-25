<?php 
$header=2;
$activo=1; 
date_default_timezone_set('America/Caracas');
$hoy = date('2016-03-09');
require('../../header.php');
include "../../config/datos.php";
?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">

<div class="container">
<br>
	<div class="row-fluid">
		<div class="span12">

	<!-- 	///////////////////////////// CITAS EN ESPERA /////////////////////// -->
			<div class="widget">
				<div class="widget-header">
				      <i class="icon-group"></i>
				      <h3>Pacientes en espera</h3>
				</div>
				<div class="widget-content">
					<table class="display table table-condensed table-hover">
						<thead>
						  <tr>
						    <th>Orden</th>
						    <th>Nombre</th>
						    <th>NºH</th>
						    <th>Remitido</th>
						    <th>Motivo</th>
						    <th>Estado</th>
						    <th>Hora</th>
						    <th>Acciones</th>
						  </tr>
						</thead>
						<tbody id="resultado-esperas">
						<?php 
						$n1 = 1;
						$citas_espera = mysql_query("SELECT citas.*, pacientes.id As id_pac,pacientes.nombre_completo 
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$hoy}' AND (status = 2 OR status = 100) 
                                ORDER BY updated_at ASC");

							while ($esperas = mysql_fetch_assoc($citas_espera)) { ?>
							<tr>
								<td><?php echo $n1; $n1++; ?> </td>
								<td><?php echo $esperas['nombre_completo']; ?> </td>
								<td><?php echo $esperas['nro_historia']; ?> </td>
								<td><?php echo $esperas['remitido']; ?> </td>
								<td><?php echo $esperas['tipo']; ?> </td>
								<td>
									<?php if($esperas['status'] == 100) { ?>
										<div class="parpadea text ausente">Ausente</div> 
									<?php } elseif($esperas['status'] == 2){ ?> 
										<div class="parpadea text">En espera</div> 
									<?php } ?>
								</td>
								<td>
									<?php $hora = explode(" ", $esperas['updated_at']);
                						$hora_llegada= $hora[1];
                						echo $hora_llegada; 
                					?> 
								</td>
								<td>
									<?php if($esperas['tipo'] == "Nuevo" OR $esperas['tipo'] == "Control" OR $esperas['tipo'] == "Emergencia"){ 
									        if($esperas['status_pago'] == 1){ ?>
									          <span class="label label-success font14 labels"><i class="icon-ok"></i> Pagado</span>
									<?php } else{ ?>
									        <a href="pagar.php?cita=<?php echo $esperas['id']; ?>" class="btn btn-info btn-small"><i class="icon-credit-card"></i> Pagar</a>
									<?php } 
									} else {?>
										<!--  boton de paquete - -->
										<button onclick="verProcedimientos('<?php echo $esperas['paquete_ap_id']; ?>');" type="button" data-toggle="tooltip" title="Ver Procedimientos del Paquete" class="btn btn-inverse btn-small"><i class="icon-asterisk"></i> Paquete</button>
									<?php } ?>
									<?php if($esperas['status'] == 100) { ?>
										 <!--  boton de cambiar status presente - -->
										 <button onclick="cambiarStatus('<?php echo $esperas['id']; ?>','2');" type="button" data-toggle="tooltip" title="Pasar a estado Presente" class="btn btn-default btn-small" style="background: rgb(40, 165, 20); color: white;"><i class="icon-map-marker" ></i></button>
									<?php } elseif($esperas['status'] == 2){ ?> 
										<!--  boton de cambiar status a ausente - -->
										<button onclick="cambiarStatus('<?php echo $esperas['id']; ?>','100');" type="button" data-toggle="tooltip" style="background: orange; color: white;" title="Pasar a estado Ausente" class="btn btn-default btn-small"><i class="icon-signout"></i></button> 
									<?php } ?>
									
									<!--   boton de diferir cita - -->
									<button onclick="diferirFecha('<?php echo $esperas['id']; ?>', '<?php echo $esperas['fecha']; ?>');" type="button" data-toggle="tooltip" title="Diferir fecha de cita" class="btn btn-default btn-small"><i class="icon-calendar"></i></button>
									<!--   boton de cancelar cita - -->
									<button onclick="cancelarCita('<?php echo $esperas['id']; ?>', '<?php echo $esperas['nombre_completo']; ?>');" type="button" data-toggle="tooltip" title="Cancelar cita" class="btn btn-danger btn-small"><i class="icon-remove"></i></button>
								</td>
							</tr>
						<?php	}
						?>
						</tbody>
					</table>
				</div>
			</div>

	<!-- 	///////////////////////////// CITAS DE HOY  /////////////////////// -->
			<div class="widget">
				<div class="widget-header">
				    <i class="icon-calendar"></i>
				    <h3>Citas para hoy</h3>
				</div>
				<div class="widget-content">
					<table class="table table-condensed table-hover" id="dataTables-example">
						<thead>
			              	<tr>
				                <th>Nombre</th>
				                <th>NºH</th>
				                <th width="150px">Nro de Móvil</th>
				                <th>Motivo</th>
				                <th>Dirigido A:</th>
				                <th width="80px">Estado</th>
				                <th>Acciones</th>
			              	</tr>
			            </thead>
						<tbody>
						<?php 
							$n2 = 1;
							$citas_hoy = mysql_query("SELECT citas.*, pacientes.id As id_pac,pacientes.nombre_completo, pacientes.telefono 
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$hoy}' AND (status = 0 OR status = 1) 
                                ORDER BY updated_at ASC");
							while ($today = mysql_fetch_assoc($citas_hoy)) {
						?>
							<tr>
								<td><?php echo $today['nombre_completo']; ?> </td>
								<td><?php echo $today['nro_historia']; ?> </td>
								<td><?php echo $today['telefono']; ?> </td>
								<td><?php echo $today['tipo']; ?> </td>
								<td><?php echo $today['remitido']; ?> </td>
								<td>
									<?php if($today['status']==0) {  ?>
								  		<div class="confirmar segunda font-normal">Por Confirmar</div>
								  	<?php } elseif ($today['status']==1) {  ?>
								  		<div class="confirmada segunda font-normal">Confirmada</div>	
								  	<?php } ?>
								</td>
								<td>
									<!--  boton paquete de procedimientos - -->
									<?php if($today['remitido'] == 'Cabina' ){ ?>
									    <button onclick="verProcedimientos('<?php echo $today['paquete_ap_id']; ?>');" type="button" data-toggle="tooltip" title="Ver Procedimientos del Paquete" class="btn btn-inverse btn-small"><i class="icon-asterisk"></i> Paquete</button>
									<?php  } ?>
									<!--  boton pago de citas- -->
									<?php if($today['tipo'] == "Nuevo" OR $today['tipo'] == "Control" OR $today['tipo'] == "Emergencia"){ 
									    if($datos['status_pago'] == 1){ ?>
									    <span class="label label-success font14 labels"><i class="icon-ok"></i> Pagado</span>
									<?php } else { ?>
									          <a href="pagar.php?cita=<?php echo $today['id']; ?>" class="btn btn-info btn-small"><i class="icon-credit-card"></i> Pagar</a>
									<?php } 
									} ?>
									<!--  boton confirmar - -->
								    <?php if($today['status'] == 0){ ?>	
								    	<button onclick="cambiarStatus('<?php echo $today['id']; ?>','1');" type="button" data-toggle="tooltip" title="Confirmar Cita" class="btn btn-default btn-small"><i class="icon-ok"></i></button>
								    <?php }
								    elseif($today['status'] == 1) { ?>
								    	<!--  boton pasar a presente - -->
								    	<button onclick="cambiarStatus('<?php echo $today['id']; ?>','2');" type="button" data-toggle="tooltip" title="Pasar a estado Presente" class="btn btn-default btn-small" style="background: rgb(40, 165, 20); color: white;"><i class="icon-map-marker" ></i></button>
								    <?php } ?>
								    <!--   boton de diferir cita - -->
									<button onclick="diferirFecha('<?php echo $today['id']; ?>', '<?php echo $today['fecha']; ?>');" type="button" data-toggle="tooltip" title="Diferir fecha de cita" class="btn btn-default btn-small"><i class="icon-calendar"></i></button>
									<!--   boton de cancelar cita - -->
									<button onclick="cancelarCita('<?php echo $today['id']; ?>', '<?php echo $today['nombre_completo']; ?>');" type="button" data-toggle="tooltip" title="Cancelar cita" class="btn btn-danger btn-small"><i class="icon-remove"></i></button>
									
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
	<!-- 	///////////////////////////// CITAS DE MA#ANA  /////////////////////// -->
		<div class="widget">
			<div class="widget-header">
				<i class="icon-calendar"></i>
				<?php 
				$dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
				$fecha_dia = $dias[date('N', strtotime($hoy))];?>
				<h3>
				<?php if ($fecha_dia=='Sabado') { 
					$fecha_next = date("2016-01-22", strtotime("+2 day"));
				?>
					Citas para el Lunes <?php echo $fecha_next; ?>
				<?php } else { 
					$fecha_next = date("2016-01-22", strtotime("+1 day"));
					?>
				Citas para mañana <?php echo $fecha_next; ?> 
				<?php } ?>
				</h3>
			</div>
			<div class="widget-content">
				<table class="table table-condensed table-hover" id="dataTables-example">
					<thead>
						<tr>
						    <th>Nombre</th>
						    <th width="150px">Nro de Móvil</th>
						    <th>NºH</th>						    
						    <th>Motivo</th>
						    <th>Dirijido A</th>
						    <th width="80px">Estado</th>
						    <th>Acciones</th>
						  </tr>
					</thead>
					<tbody>
					<?php $citas_manana = mysql_query("SELECT citas.*, pacientes.id As id_pac,pacientes.nombre_completo, pacientes.telefono 
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$fecha_next}' AND (status = 0 OR status = 1) 
                                ORDER BY updated_at ASC"); 

						while ($manana = mysql_fetch_assoc($citas_manana)) { ?>
							<tr>
								<td><?php echo $manana['nombre_completo']; ?></td>
								<td><?php echo $manana['telefono']; ?></td>
								<td><?php echo $manana['nro_historia']; ?></td>
								<td><?php echo $manana['tipo']; ?></td>
								<td><?php echo $manana['remitido']; ?></td>
								<td>
									<?php if($manana['status']==0) {  ?>
								  		<div class="confirmar segunda font-normal">Por Confirmar</div>
								  	<?php } elseif ($manana['status']==1) {  ?>
								  		<div class="confirmada segunda font-normal">Confirmada</div>	
								  	<?php } ?>
								</td>
								<td>
									<?php if($manana['status'] == 0){ ?>
								    	<!--  boton confirmar - -->
								    	<button onclick="cambiarStatus('<?php echo $manana['id']; ?>','1');" type="button" data-toggle="tooltip" title="Confirmar Cita" class="btn btn-default btn-small"><i class="icon-ok"></i></button>
								    <?php } ?>
								    <!--   boton de diferir cita  -->
									<button onclick="diferirFecha('<?php echo $manana['id']; ?>', '<?php echo $manana['fecha']; ?>');" type="button" data-toggle="tooltip" title="Diferir fecha de cita" class="btn btn-default btn-small"><i class="icon-calendar"></i></button>
									<!--   boton de cancelar cita - -->
									<button onclick="cancelarCita('<?php echo $manana['id']; ?>', '<?php echo $manana['nombre_completo']; ?>');" type="button" data-toggle="tooltip" title="Cancelar cita" class="btn btn-danger btn-small"><i class="icon-remove"></i></button>
								</td>
							</tr>
					<?	}
                    ?>
						
					</tbody>
				</table>
			</div>
		</div>
	<!-- 	///////////////////////////// CITAS POR FECHA  /////////////////////// -->

		<div class="widget">
			<div class="widget-header ">
				<i class="icon-star"></i>
				<h3>Citas medicas por fecha</h3>
			</div> <!-- /widget-header -->
			<div class="widget-content">		
				<form class="form-inline"  id="formulario" method="post" action="./buscar_cita_fecha.php">
					<center>
						<p class="texto"><strong>Introduzca la fecha a buscar</strong></p>

						<div class="input-append">
						  <input class="span2" id="fecha" name="fecha" type="date">
						  <button class="btn btn" type="submit" name="aceptar">Buscar</button>
						</div>
						<br> <br> <br>
					</center>
				</form> 
			</div> <!-- /widget-content -->
		</div> <!-- /widget -->		


		</div> <!-- span12 -->
	</div>  <!-- row -->
</div> <!-- container -->

<?php include('modals_inicio.php'); ?>

<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script src="inicioRecepcion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#dataTables-example, #dataTables-example_2 ').DataTable( {
	        dom: 'T<"clear">lfrtip'
	    } );
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>