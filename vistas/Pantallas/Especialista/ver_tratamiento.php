<?php
$id = $_GET['paciente'];

$header=1;
$activo=2;
require('../../header.php');
include("../../PHP/enfermera/consultas.php");
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$id}' LIMIT 1 ");
$paciente = mysql_fetch_assoc($tabla_pacientes);

?>

<div class="main">
	<div class="main-inner">
		<div class="container">

			<div class="widget">
				<div class="widget-header">
					<i class="icon-user"></i>
					<h3>Tratamientos del Paciente</h3>
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
		<br>
<div class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">x</button>
<center>Alertas del Paciente</center>

            <?php 
            $tabla_alertas = mysql_query("SELECT * FROM alertas WHERE id_paciente = '".$paciente['id']."'");
?>
							
					
							<?php while($alertas = mysql_fetch_assoc($tabla_alertas)){ ?>
								<?php if ($alertas['contenido']=='') {
								
								}else { ?>
									<strong><?php echo $alertas['contenido']; ?></strong><br>
							<?php }} ?>
							
						
						



	
		




	
	<a href="#myModalalertas" role="button" data-toggle="modal" class="btn btn-default alertas"><i class="icon-plus"></i>Nueva alerta</a>
							

                <div id="myModalalertas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h3 id="myModalLabel"><i class="icon-plus"></i> Agregar nueva alerta para el paciente <?php echo $paciente['nombre_completo']; ?> </h3>
                  	</div>
                  	<div class="modal-body">
                    	
                  		<form role="form" method="POST" action="../../PHP/especialista/registrar_alertas.php?paciente=<?php echo $paciente['id']; ?>">
                  			          	

                  		<div class="control-group">											
                  			<label class="control-label" for="">Observacion</label>
                  			<div class="controls">
                  				<textarea type='text' name="alerta" class="form-control alerta"></textarea>
                  			</div> <!-- /controls -->				
                  		</div>
                  		
                  		


                  	</div>
                  	<div class="modal-footer">
                    	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    	<button name="modal" type="submit" class="btn btn-primary">Guardar</button>
                  	</div>
                  	</form>
                </div>

		





</div>



		
		
					<hr>

<!-- //////////////////////// mostrar tratamiento //////////////////////////////// -->
<h3>Detalles del procedimiento aplicado:</h3>
<?php $tratamiento_data = mysql_fetch_assoc($tratamiento); ?>

<strong>Fue asignado en la fecha: <?php echo $tratamiento_data['created_at']; ?> </strong> <br>
<strong>Cantidad de sesiones: </strong> <?php echo $tratamiento_data['cantidad']; ?>
<br>
<div class="row-fluid">
	
	<div class="span4">
		<strong>Nombre del procedimiento:</strong> <p><?php echo $tratamiento_data['nombre']; ?> </p>
	</div>	
	<div class="span4">
		<strong>Frecuencia del procedimiento:</strong> <p><?php echo $tratamiento_data['frecuencia']; ?> </p>
	</div>
	<div class="span4">
		<strong>Parametros del procedimiento:</strong> <p><?php echo $tratamiento_data['parametros']; ?> </p>
	</div>
</div>
<hr>

<!--////////////////////////// DATOS DE CADA SESION APLICADA //////////////////////////////////////////////////////// -->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php 
$sesiones = mysql_query("SELECT * FROM sesiones_procedimientos WHERE tratamiento_id = '{$tratamiento_id}' ");
while ($data_sesion = mysql_fetch_assoc($sesiones)) 
{ 
	$sesion_id = $data_sesion['id'];
	$fecha = $data_sesion['created_at'];
	$fec = explode(" ", $fecha);
?>
	<div class="row-fluid">	
		<h3>Sesion # <?php echo $data_sesion['nro'] ?> </h3>
		
		<h3>Aplicada el dia: <?php echo $fec[0]; ?> a las <?php echo $fec[1]; ?> </h3>
	</div>

	<h4>Resultados de preguntas de evaluación:</h4>
	<?php 
		// consultas para la evaluacion en esta sesion
		$evaluacion_actual = mysql_query("SELECT * FROM control_tratamientos WHERE tratamiento_id = '{$tratamiento_id}' AND sesion_id = '{$sesion_id}'");
		$evaluacion_data = mysql_fetch_assoc($evaluacion_actual); 
	?>
	<div class="row-fluid">
		<div class="span4">
		<STRONG>Pregunta #1: </STRONG>
			<?php if($evaluacion_data['tratamiento_casa']== 'si'){ ?>
				<p>El paciente cumplio con su tratamiento en casa.</p>
			<?php }
				else{
			 ?>
				<p>El paciente no cumplio su tratamiento en casa, debido a:</p><br>
				<p><?php echo $evaluacion_data['tratamiento_casa_xq']; ?> </p>
			<?php } ?> <br>
		</div>
		<div class="span4">
			<strong>Pregunta #2: </strong>
			<?php if($evaluacion_data['vio_mejoria']== 'si'){ ?>
				<p>El paciente ha notado mejorias con el tratamiento. </p>
			<?php }
				else{
			 ?>
				<p>El paciente no ha visto mejorias con el tratamiento, debido a:</p><br>
				<p><?php echo $evaluacion_data['vio_mejoria_xq']; ?> </p>
			<?php } ?> <br>
		</div>
		<div class="span4">
			<strong>Pregunta #3: </strong>
			<?php if($evaluacion_data['complicacion']== 'No'){ ?>
				<p>El paciente no ha notado complicaciones . </p>
			<?php }
				else{
			 ?>
				<p>El paciente ha presentado complicaciones con el tratamiento, debido a:</p><br>
				<p><?php echo $evaluacion_data['complicacion_xq']; ?> </p>
			<?php } ?> <br>
		</div>
	</div> <!-- /////////////// FIN DIV EVALUACION /////////////////// -->

	<h4>Observaciones del Procedimiento:</h4>
	<?php 
	$obs_actual = mysql_query("SELECT * FROM observaciones_tratamiento WHERE tratamiento_id = '{$tratamiento_id}' AND sesion_id = '{$sesion_id}'"); 
	$ver_observacion = mysql_fetch_assoc($obs_actual);
	$usuario = mysql_query("SELECT * FROM usuarios WHERE id='{$ver_observacion['usuario']}' ");
	if($usuario){ $user = mysql_fetch_assoc($usuario);}
	?>
	<div class="row-fluid">
		<div class="form-group">
			<strong>Observacion echa por:</strong> <?php echo $user['nombre']." ".$user['apellido']; ?>
			<br>
			<label>Observacion:</label>
			<textarea class="span5" readonly><?php echo $ver_observacion['observacion']; ?></textarea>
		</div>
	</div> <!-- /////////////// FIN DIV OBSERVACIONES /////////////////// -->

	
	<?php 
	//foto pre
	$foto_pre = mysql_query("SELECT * FROM fotos_tratamientos WHERE tratamiento_id = '{$tratamiento_id}' AND sesion_id = '{$sesion_id}' AND tipo = 'pre' ");
	//foto_post
	$foto_post = mysql_query("SELECT * FROM fotos_tratamientos WHERE tratamiento_id = '{$tratamiento_id}' AND sesion_id = '{$sesion_id}' AND tipo = 'post' "); 
	$filas_pre = mysql_num_rows($foto_pre);
	$filas_post = mysql_num_rows($foto_post);
	?>

	<div class="row-fluid">
		<div class="span6">
			<h4>Fotos antes del procedimiento:</h4>
			<br>
			<?php if($filas_pre > 0)
			{ ?>
				<center>
					<?php while($ver_fotos_pre = mysql_fetch_assoc($foto_pre))
					{ ?>
						<img class="" src="../../../img/procedimientos/<?php echo $ver_fotos_pre['foto']; ?> " title="Foto antes del tratamiento">
						<br>
					<?php 
					} 
					?>	
				</center>
			<?php 
			}
			else 
			{ ?>
				<center>
					<strong>No se encuentran fotos registradas antes del procedimiento.</strong> 
				</center>
			<?php 
			} 
			?>
		</div>

		<div class="span6">
			<h4>Fotos despues del procedimiento:</h4>
			<br>
			<?php if($filas_post > 0)
			{ ?>
				<center>
					<?php while($ver_fotos_post = mysql_fetch_assoc($foto_post))
					{ ?>
						<img class="" src="../../../img/procedimientos/<?php echo $ver_fotos_post['foto']; ?> " title="Foto antes del tratamiento">
						<br>
					<?php 
					} 
					?>	
				</center>
			<?php 
			}
			else 
			{ ?>
				<center>
					<strong>No se registraron fotos despues del tratamiento.</strong> 
				</center>
			<?php 
			} 
			?>
		</div>
	</div>
	<hr>
<?php } ?>






<!-- ////////////////// fin mostrar tratamiento //////////////////////////////// -->
				</div> <!-- fin widget content -->
			</div><!-- fin widget -->
		</div><!-- fin container -->
	</div><!-- fin main-inner -->
</div><!-- fin main -->
