<?php
$id = $_GET['paciente'];
$header=2;
$activo=2;
require('../../header.php');
include("../../PHP/enfermera/consultas.php");
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$id}' LIMIT 1 ");
$paciente = mysql_fetch_assoc($tabla_pacientes);
?>
<div class="container">
<br>
			<div class="widget">
				<div class="widget-header">
					<i class="icon-user"></i>
					<h3>Tratamientos para el Paciente</h3>
					<?php if (isset($_GET['cita'])) { ?>
						<a href="../../PHP/enfermera/despachar.php?cita=<?php echo $_GET['cita']; ?>" class="btn btn-danger despachar btn-small">Despachar Paciente</a>	
				   <?php } ?>
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

				</div> <hr>
<!-- //////////////////////// TAGS //////////////////////////////// -->
		<div class="tabbable">

			<ul class="nav nav-tabs">
				<?php $act = isset($_GET['act'])?$_GET['act']:""; ?>
				<?php if ($_SESSION['id_nivel']==2) { ?>
						<li class="<?php if($act == ""){ echo "active";}?>">
					<a href="#jsdiagnosticos" class="perfil" data-toggle="tab">Diagnosticos</a>
				</li>
				<li class="<?php if($act == "procedimientos"){ echo "active";} ?>">
					<a href="#jscabina" class="perfil" data-toggle="tab">Aplicar Tratamientos</a>
				</li>
				<li>
					<a href="#jscasa" class="perfil" data-toggle="tab">Tratamientos</a>
				</li>
				<li>
					<a href="#jsexamenes" class="perfil" data-toggle="tab">Examenes Solicitados</a>
				</li>
				<?php }else {  ?>
			
				<?php if ($_SESSION['id_nivel']==1) { ?>
					<li class="<?php if($act == "procedimientos" OR $act == "" ){ echo "active";} ?>">
					<a href="#jscabina" class="perfil" data-toggle="tab">Aplicar Tratamientos</a>
				</li>
					<li>
					<a href="../Especialista/ver_historial.php?paciente=<?php echo $paciente['id']; ?>" class="perfil">Control</a>
				    </li>
				 <?php } } ?>
			</ul>

			<div class="tab-content">
			<?php if ($_SESSION['id_nivel']==2) { ?>
				<div class="tab-pane <?php if($act == ""){ echo "active";}?> " id="jsdiagnosticos">

					<h3>Diagnosticos Anteriores:</h3>
					<div class="respuesta">
						<?php include("../../PHP/especialista/consulta_diagnostico.php") ?>
					</div>
					<br>
					
				</div>
				<?php } ?>

<!-- ////////////// //////////////////////////////////////////// -->
				<div class="tab-pane <?php if($act == "procedimientos" OR $_SESSION['id_nivel']==1 ){ echo "active";} ?>" id="jscabina">
				<?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
               
				<?php if(mysql_num_rows($tratamiento_marcha) > 0){?>
				 <h3>Procedimiento en marcha:</h3> <hr>
						<div class="table-responsive ">
							<table class="table table-hover table-bordered table-condensed">
								<thead>
									<tr>
										<th>Tratamiento</th>
										<th>Frecuencia</th>
										<th>Parametros</th>
										<th>Sesiones</th>
										<th width="15%">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									while($tratamiento_actual = mysql_fetch_assoc($tratamiento_marcha)){ ?>
										<tr>
											<td><?php echo $tratamiento_actual['nombre']; ?> </td>
											<td><?php echo $tratamiento_actual['frecuencia']; ?> </td>
											<td><?php echo $tratamiento_actual['parametros']; ?> </td>
											<?php 
												$trat_id = $tratamiento_actual['id'];
												$nro_sesiones = mysql_query("SELECT * FROM sesiones_procedimientos WHERE tratamiento_id = '{$trat_id}' "); 
												$nro = mysql_num_rows($nro_sesiones);
											?>
											<td><?php echo $nro; ?> de <?php echo $tratamiento_actual['cantidad']; ?> </td>

								    <?php 	$cita=isset($_GET['cita'])?$_GET['cita']:""; ?>										
											<td> 
											<?php if (isset($_GET['cita'])){ ?>			
											<a href="../../PHP/enfermera/cambiar_status.php?cita=<?php echo $cita;?>&paciente=<?php echo $tratamiento_actual['paciente_id'];?>&id=<?php echo $tratamiento_actual['id'];?>" class="btn btn-default"><i class="icon-play"></i> Continuar</a> 
											<?php } ?>
											</td>							
									<?php } ?>
									</tr>
								</tbody>
							</table>
						</div>
						<?php } ?>
					<h3>Procedimientos de cabina pendientes por aplicar:</h3> <hr>
					<?php if(mysql_num_rows($lista_tratamientos) > 0){?>	
					

					<div class="table-responsive ">
						<table class="table table-condensed table-hover table-bordered">
							<thead>
								<tr>
									<th>Tratamiento</th>
									<th>Parte del cuerpo</th>
									<th>Sesiones</th>
									<th>Frecuencia</th>
									<th>Parametros</th>
									<th width="15%">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php while($tratamiento = mysql_fetch_assoc($lista_tratamientos)){ ?>
									<tr>
										<td><?php echo $tratamiento['nombre']; ?> </td>
										<td><?php echo $tratamiento['parte']; ?> </td>
										<td><?php echo $tratamiento['cantidad']; ?> </td>
										<td><?php echo $tratamiento['frecuencia']; ?> </td>
										<td><?php echo $tratamiento['parametros']; ?> </td>
										<td>
										  <?php  
										  	if(isset($_GET['cita'])){	
										  		//$cita= $_GET['cita']; 
										  	?>
											 <a href="../../PHP/enfermera/cambiar_status.php?cita=<?php echo $cita;?>&paciente=<?php echo $tratamiento['paciente_id'];?>&id=<?php echo $tratamiento['id'];?>" class="btn btn-default"><i class="icon-play"></i> Aplicar</a> 
											<?php } ?>										
										
                                         <?php  if ($_SESSION['id_nivel']==1) { ?>
                                         <?php
											$consulta_cambio = mysql_query("SELECT * FROM cambio_tratamiento WHERE tratamiento_id='".$tratamiento['id']."'");
											$cambio_tratamiento=mysql_fetch_assoc($consulta_cambio);

											if (mysql_num_rows($consulta_cambio)>0 AND $cambio_tratamiento['status']== 0) { ?>
											<span class="procesando_tercera">Procesando cambio</span>
											<?php }elseif (mysql_num_rows($consulta_cambio)>0 AND $cambio_tratamiento['status']== 1) { ?>
												<span class="confirmada_tercera">Aprobado</span>
											<?php }elseif (mysql_num_rows($consulta_cambio)>0 AND $cambio_tratamiento['status']== 2) { ?>
                                            <span class="cancelada_tercera">Denegado</span>
											<?php }else{  ?>
                                       		<a href="../../Pantallas/Enfermera/cambiar_tratamiento.php?paciente=<?php echo $tratamiento['paciente_id'];?>&id=<?php echo $tratamiento['id'];?>" class="btn btn-default"> <i class="icon-edit"></i> Solicitar cambio</a>
                                         <?php }}
                                           ?>

										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<?php }
					else { ?>
					<strong>El paciente aun no posee ningún procedimiento de cabina asignado.</strong> <br>
					<?php } ?>

					<?php if(mysql_num_rows($tratamiento_culminado) > 0){?>
					<h3>Procedimientos Completados:</h3>

						<div class="table-responsive ">
							<table class="table table-condensed table-hover table-bordered">
								<thead>
									<tr>
										<th>Tratamiento</th>
										<th>Frecuencia</th>
										<th>Parametros</th>
										<th>Fecha</th>
										<th width="15%">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php while($tratamiento_culm = mysql_fetch_assoc($tratamiento_culminado)){ ?>
										<tr>
											<td><?php echo $tratamiento_culm['nombre']; ?> </td>
											<td><?php echo $tratamiento_culm['frecuencia']; ?> </td>
											<td><?php echo $tratamiento_culm['parametros']; ?> </td>
											<td><?php echo $tratamiento_culm['updated_at']; ?> </td>
											<td> <a href="../../Pantallas/Enfermera/ver_tratamiento.php?paciente=<?php echo $tratamiento_culm['paciente_id'];?>&id=<?php echo $tratamiento_culm['id'];?>" class="btn btn-default"> <i class="icon-eye-open"></i> Ver Detalles</a>  </td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?php } ?>
				</div>
<!-- ////////////// //////////////////////////////////////////// -->
				<div class="tab-pane" id="jscasa">
					<h3>Tratamientos del Paciente para aplicar en casa:</h3>

					<?php if(mysql_num_rows($tratamientos_casa) > 0){?>
					<div class="table-responsive ">
						<table class="table table-condensed table-hover table-bordered">
							<thead>
								<tr>
									<th>Tratamiento</th>
									<th>Frecuencia</th>
									<th>Parametros</th>
								</tr>
							</thead>
							<tbody>
								<?php while($trat_casa = mysql_fetch_assoc($tratamientos_casa)){ ?>
									<tr>
										<td><?php echo $trat_casa['nombre']; ?> </td>
										<td><?php echo $trat_casa['frecuencia']; ?> </td>
										<td><?php echo $trat_casa['parametros']; ?> </td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<?php }
					else{ ?>
						<strong>
							El paciente no posee tratamientos asignados aun.
						</strong>
					<?php } ?>
				</div>
<!-- ////////////// //////////////////////////////////////////// -->
				<div class="tab-pane" id="jsexamenes">
					<h3>Examenes Solicitados:</h3>
					<?php include("../../PHP/recepcion/consulta_examenes_solicitados.php"); ?>
				</div>
<!-- ////////////// //////////////////////////////////////////// -->
			</div>
		</div>
<!-- ////////////////// END TAGS //////////////////////////////// -->
				</div> <!-- fin widget content -->
			</div><!-- fin widget -->
		</div><!-- fin container -->

