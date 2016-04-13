<?php
include "../../config/datos.php"; 
$header=2;
$activo=2;
require('../../header.php');
include('../../PHP/funciones.php');
$fecha = $_POST['fecha'];
$hoy = date('Y-m-d');
?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<div class="">
  <div class="">
    <div class="container">
      <div class="row">
      		<center> <br> <h2>Citas del: <?php echo fecha_total($fecha); ?> </h2> <br> </center>
        <div class="span12">
  
            <div class="widget">
	            <div class="widget-header"> <i class="icon-file"></i>
	              <h3>Citas Regitradas </h3>
	            </div>
            	<!-- /widget-header -->
            	<div class="widget-content">
					<div class="table-responsive">
					<table class="display table table-hover" id="dataTables-example">
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
					<?php $sql = mysql_query("SELECT citas.*, pacientes.id As id_pac,pacientes.nombre_completo, pacientes.telefono 
								FROM citas
								INNER JOIN pacientes ON citas.paciente_id = pacientes.id
								WHERE fecha = '{$fecha}'  
                                ORDER BY updated_at ASC"); 

						while ($citas = mysql_fetch_assoc($sql)) { ?>
							<tr>
								<td><?php echo $citas['nombre_completo']; ?></td>
								<td><?php echo $citas['telefono']; ?></td>
								<td><?php echo $citas['nro_historia']; ?></td>
								<td><?php echo $citas['tipo']; ?></td>
								<td><?php echo $citas['remitido']; ?></td>
								<td>
									<?php 
									if ($citas['status']== 0) { ?>
										<span class="label label-info span-padd">Por Confirmar</span>
									<?php }
									else if ($citas['status']== 1) { ?>
										<span class="label label-success span-padd">Confirmada</span>
									<?php }
									else if ($citas['status']== 2) { ?>
										<span class="label span-padd">En Espera</span>
									<?php }
									else if ($citas['status']== 3) { ?>
										<span class="label label-warning span-padd">Exitosa</span>
									<?php }
									else if ($citas['status']== 15) { ?>
										<span class="label label-important span-padd">En Proceso</span>
									<?php }
									else if ($citas['status']== 10) { ?>
										<span class="label label-inverse span-padd">Cancelada</span>
									<?php }
									else if ($citas['status']== 100) { ?>
										<span class="label label span-padd">Ausente</span>
									<?php }
									?>
								</td>
								<td>
									<?php if($citas['status'] != 15 AND $citas['status'] != 10  AND $citas['status'] != 3){ 
											
											if ($fecha >= $hoy) { ?>
											    <!--   boton de diferir cita  -->
												<button onclick="diferirFecha('<?php echo $citas['id']; ?>', '<?php echo $citas['fecha']; ?>');" type="button" data-toggle="tooltip" title="Diferir fecha de cita" class="btn btn-default btn-small"><i class="icon-calendar"></i></button>
												<!--   boton de cancelar cita - -->
												<button onclick="cancelarCita('<?php echo $citas['id']; ?>', '<?php echo $citas['nombre_completo']; ?>');" type="button" data-toggle="tooltip" title="Cancelar cita" class="btn btn-danger btn-small"><i class="icon-remove"></i></button>
											<?php	} 
												else{ ?>
													<p class="danger">Fecha Vencida</p>
											<?php }	
								    	} 
								    	else
								    	{ ?>
											<p class="danger"></p>
										<?php } ?>
								</td>
							</tr>
							<?php } ?>						
						</tbody>
					</table>				
				</div> 
            </div>  <!-- /widget-content hastaa aqui -->
            <!-- /widget-content --> 
          </div>
          <!-- /widget --> 
        </div>
        <!-- /span6 -->       
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	  $('#dataTables-example').dataTable();
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
<script src="inicioRecepcion.js"></script>
<?php include('modals_inicio.php'); ?>