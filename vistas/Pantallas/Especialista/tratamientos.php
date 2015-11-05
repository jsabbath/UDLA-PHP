<?php 
$header=1;
$activo=2;
require('../../header.php');
include("../../PHP/paciente/consultas_historia.php");
include("../../PHP/funciones.php");
?>
<div class="container">
<br>
<div class="widget">
	<div class="widget-header"> <i class="icon user"></i>
		<h3> Historial del Paciente:  </h3>
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
		
	
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////Datos del paciente////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#formcontrols" class="perfil" data-toggle="tab">Tratamientos aplicados</a>
		</li>
		<li>
			<a href="#jscontrols" class="perfil" data-toggle="tab">Tratamientos Pendientes</a>
		</li>
		<li>
			<a href="#jsrecipe" class="perfil" data-toggle="tab">Tratamiento en Proceso</a>
		</li>
		
	</ul>

	<div class="tab-content">

		<div class="tab-pane active" id="formcontrols">
			<h3>Diagnosticos Anteriores:</h3>
			<?php
			$filas = mysql_num_rows($tabla_diagnosticos);
			if($filas > 0) { 
			while ($diagnostico=mysql_fetch_assoc($tabla_diagnosticos)) { ?>		
				<div class="control-group">											
					<label class="control-label" for="">Fecha: <?php echo calcular_fechas($diagnostico['created_at'])." dias"; ?> </label>
					<div class="controls">
						<textarea class="span8 form-control" disabled> <?php echo $diagnostico['diagnostico']; ?> </textarea>
					</div> <!-- /controls -->				
				</div> <hr>
			<?php } }
			else { ?>
			<strong> No Existen diagnosticos anteriores para este paciente.</strong>
			<?php } ?>

			<?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
			<h3>Nuevo Diagnostico:</h3>
			<form role="form" class="" method="POST" action="../../PHP/especialista/register_diagnosticos.php">
				<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
				<div class="control-group">											
					<label class="control-label" for="email">Detalles del Diagnostico</label>
					<div class="controls">
						<textarea class="span8 form-control" name="diagnostico"> </textarea>
					</div> <!-- /controls -->				
				</div> 

				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Guardar</button> 
					<button class="btn">Cancelar</button>
				</div>
			</form>
		</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<div class="tab-pane" id="jscontrols">
			<h3>Asignacón de Tratamientos</h3>
			<div class="row-fluid">
				<div class="span4">
					<form role="form" method="POST" action="../../PHP/especialista/register_tratamientos.php">
						<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
						<input type="hidden" name="cita_id" value="<?php echo $cita_id;?> ">
						<input type="hidden" name="tipo" value="cabina">
					<div class="control-group">											
						<label class="control-label" for="">Nombre del Tratamiento:</label>
						<div class="controls">
							<select class="form-control" name="nombre">
								<option>---------</option>
								<?php while ($lista = mysql_fetch_assoc($lista_tratamientos)) { ?>
									<option><?php echo $lista['nombre']; ?> </option>	
								<?php } ?>
							</select>
						</div> <!-- /controls -->				
					</div>
				</div>

				<div class="span4">
					<div class="control-group">											
						<label class="control-label" for="">Frecuencia del Tratamiento:</label>
						<div class="controls">
							<input type="text" name="frecuencia" class="form-control">
						</div> <!-- /controls -->				
					</div>
				
					<div class="control-group">											
						<label class="control-label" for="">Parametros del Tratamiento:</label>
						<div class="controls">
							<input type="text" name="parametros" class="form-control">
						</div> <!-- /controls -->				
					</div>
				</div>

				<div class="span4">
					<h3>Lista de Tratamientos:</h3>
					<?php while ($lista_cabina = mysql_fetch_assoc($tratamientos_cabina)) { ?>
						<li> <?php echo $lista_cabina['nombre']; ?> </li>
					<?php } ?>
				</div>
			</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Actualizar</button> 
					<button class="btn">Cancelar</button>
				</div>
			</form>
			
		</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

		<div class="tab-pane" id="jsrecipe">
			<h3>Tratamientos:</h3>
			<div class="row-fluid">
				<div class="span4">
					<form role="form" method="POST" action="../../PHP/especialista/register_tratamientos.php">
						<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
						<input type="hidden" name="cita_id" value="<?php echo $cita_id;?> ">
						<input type="hidden" name="tipo" value="casa">
					<div class="control-group">											
						<label class="control-label" for="">Nombre del Tratamiento:</label>
						<div class="controls">
							<textarea name="nombre" class="form-control"> </textarea>
						</div> <!-- /controls -->				
					</div>
				</div>

				<div class="span4">
					<div class="control-group">											
						<label class="control-label" for="">Parametros del Tratamiento:</label>
						<div class="controls">
							<input type="text" name="parametros" class="form-control">
						</div> <!-- /controls -->				
					</div>
				
					<div class="control-group">											
						<label class="control-label" for="">Frecuencia del Tratamiento:</label>
						<div class="controls">
							<input type="text" name="frecuencia" class="form-control">
						</div> <!-- /controls -->				
					</div>
				</div>

				<div class="span4">
					<h3>Lista de Tratamientos:</h3>
					<?php while ($lista_casa = mysql_fetch_assoc($tratamientos_casa)) { ?>
						<li> <?php echo $lista_casa['nombre']; ?> </li>
					<?php } ?>
				</div>
			</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Actualizar</button> 
					<button class="btn">Cancelar</button>
				</div>
			</form>
			
		</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	
		

<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	</div> <!-- FIN DE tab-content -->

</div> <!-- FIN DE .TABBABLE -->


</div><!-- fin de widget-content -->

</div> <!-- fin de widget-content -->






</div> <!-- FIN DE .CONTAINER -->