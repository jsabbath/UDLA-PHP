<?php 
$id = $_GET['id'];
$paciente = $_GET['paciente'];
$sesion_id = $_GET['sesion'];
$header=2;
$activo=2;
require('../../header.php');
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$paciente}' LIMIT 1 ");
$paciente_data = mysql_fetch_assoc($tabla_pacientes);

$tratamiento = mysql_query("SELECT * FROM tratamientos WHERE id = '$id' LIMIT 1 ");
$datos_tratamiento = mysql_fetch_assoc($tratamiento);

$sesion_nro = mysql_query("SELECT * FROM sesiones_procedimientos WHERE id ='{$sesion_id}' AND tratamiento_id = '{$id}' LIMIT 1 ");
$nro = mysql_fetch_assoc($sesion_nro);
?>


<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span8">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-play"></i>
							<h3>Aplicando Procedimiento:</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content ">
							<div class="posicion">		
								<center>
								<h3 class="texto">Aplique el procedimiento, al terminar continue con el proceso. </h3>
								<table class="table">
									<thead>
										<tr>
											<th>Procedimiento</th>
											<th>Parte del cuerpo</th>
											<th>Parametros</th>
											<th>Sesiones</th>
											<th>Sesion Actual</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td> <?php echo $datos_tratamiento['nombre']; ?> </td>
											<td> <?php echo $datos_tratamiento['parte']; ?> </td>
											<td> <?php echo $datos_tratamiento['parametros']; ?> </td>
											<td> <?php echo $datos_tratamiento['cantidad']; ?> </td>
											<td>#<?php echo $nro['nro']; ?> </td>
										</tr>
									</tbody>
								</table>
								<a href="#myModal" role="button" data-toggle="modal" class="btn btn-default"><i class="icon-camera"></i> Añadir Fotografias</a>
								</center>
								<?php if (isset($_GET['msg'])) {
								    $msg= $_GET['msg']; 
								    if ($msg == 'ok') { ?>
								    	<div class="alert alert-success">
								        	<button type="button" class="close" data-dismiss="alert">&times;</button>
								        	<strong>Foto cargada con exito.! </strong>
								        </div>
								    </div>
								   <?php }
								   elseif ($msg == 'no') { ?>
								   	<div class="alert alert-danger">
								        <button type="button" class="close" data-dismiss="alert">&times;</button>
								        <strong>Lo sentimos, la foto no pudo ser cargada.! </strong>
								    </div>
								   <?php }								    
								 	} ?>
								
								<form method="POST" action="observacion_tratamiento.php?cita=<?php echo $_GET['cita']; ?>">
									<input type="hidden" name="paciente" value="<?php echo $paciente;?>">
									<input type="hidden" name="tratamiento_id" value="<?php echo $id;?>">
									<input type="hidden" name="sesion_id" value="<?php echo $sesion_id;?>">
									<div class="form-actions">
										<button type="submit" class="btn btn-primary btn-large">Continuar</button> 
										
									</div>
								</form>
		                    </div>
						</div> <!-- /widget-content -->		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
       	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       	<h3 id="myModalLabel"><i class="icon-camera"></i> Suba las fotos correspondientes al procedimiento:</h3>
    </div>
    <div class="modal-body">
	       	<form action="../../PHP/enfermera/upload_foto.php" class="form-control form" method="POST" enctype="multipart/form-data">
	       	Seleccione el archivo: <br>
	       	<input type="file" name="foto" required><br>
	       	<label class="radio inline">
	       		<input required type="radio" name="tipo" value="pre"> Pre-Procedimiento
	       	</label>
	       	<label class="radio inline">
	       		<input required type="radio" name="tipo" value="post"> Post-Procedimiento
	       	</label>
	       	<input type="hidden" name="paciente" value="<?php echo $paciente;?>">
			<input type="hidden" name="tratamiento_id" value="<?php echo $id;?>">
			<input type="hidden" name="sesion_id" value="<?php echo $sesion_id;?>">
    </div>
     <div class="modal-footer">
       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
       <button type="submit" class="btn btn-primary"><i class="icon-upload"></i> Subir</button>
       </form>
     </div>
 </div>
