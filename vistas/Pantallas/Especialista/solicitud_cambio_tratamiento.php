<?php
$id = $_GET['paciente'];
$tratamiento_id = $_GET['id'];
$header=1;
$activo=2;
require('../../header.php');
include("../../PHP/enfermera/consultas.php");
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$id}' LIMIT 1 ");
$paciente = mysql_fetch_assoc($tabla_pacientes);

?>
<?php $tratamiento_data = mysql_fetch_assoc($tratamiento); ?>

		<div class="main">
		<div class="main-inner">
		<div class="container">
					<?php
	if(isset($_GET['msg_existe'])){
	echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Ya ha Realizado una solicitud con este Tratamiento espere por su respuesta</center>';
	}elseif (isset($_GET['msg_llenar'])) {
    echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Seleccione si aprueba o deniega la solicitud</center>';
	}elseif (isset($_GET['msg_guardo'])) {
    echo '<center class="alert alert-success paciente"><button type="button" class="close" data-dismiss="alert">×</button>La solicitud se realizo con exito Espere por su respuesta</center>';
	}elseif (isset($_GET['msg_llenar'])) {
   echo '<center class="alert alert-success paciente"><button type="button" class="close" data-dismiss="alert">×</button>Hubo un problema de conexcion intente denuevo</center>';
	}
	?>
		<div class="widget">

		<div class="widget-header">
		<i class="icon-user"></i>
		<h3>Tratamientos para el Paciente</h3>
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


		<div class="row">
		<div class="span3">

		<div class="widget">
		<div class="widget-header">
		<i class="icon-star"></i>
		<h3>Tratamiento Actual</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content inicio_tratamiento">
		<div class="posicion">
		<div class="row tratamientos">
		<ul>
		<li class="span4">
		<strong>Nombre del tratamiento:</strong>
		<p><?php echo $tratamiento_data['nombre']; ?> </p>
		</li>

		<li class="span4">
		<strong>Frecuencia del tratamiento:</strong>
		<p><?php echo $tratamiento_data['frecuencia']; ?> </p>
		</li>

		<li class="span4">
		<strong>Parametros del tratamiento:</strong>
		<p><?php echo $tratamiento_data['parametros']; ?> </p>
		</li>
		</ul>

		</div>

		<hr>

		</div>
		</div> <!-- /widget-content -->
		</div>
		</div>

		<div class="span8">

		<div class="widget">

		<div class="widget-header">
		<i class="icon-user"></i>
		<h3>Cambio solicitado</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content inicio_tratamiento">

		<div class="solicitud">
		<form method="POST" action="../../PHP/especialista/solicitud_tratamiento.php?id_tratamiento=<?php echo $tratamiento_id; ?>&paciente=<?php echo $paciente['id']; ?>" class="form" role="form">

<?php
$consulta_cambio_tratamientos = mysql_query("SELECT * FROM cambio_tratamiento WHERE tratamiento_id=$tratamiento_id");

			$filas = mysql_num_rows($consulta_cambio_tratamientos);
			if($filas > 0) {
			while ($diagnostico=mysql_fetch_assoc($consulta_cambio_tratamientos)) { 
					$fre=$diagnostico['frecuencia'];
					$parametro=$diagnostico['parametro'];
					$fre_obser=$diagnostico['frecuencia_obser'];
					$parametro_obser=$diagnostico['parametro_obser'];


                ?>
                   <ul class="listas_negras">
						<li>
							<strong>¿Nueva Frecuencia?</strong><br>
							<input type="text" class="disabled" name="frecuenbcia" value="<?php echo $fre; ?>" disabled><br>
							<strong>¿Especifique por que el cambio?</strong><br>
							<textarea type="text" class="disabled" name="frecuencia_obser" disabled><?php echo $fre_obser; ?></textarea>
						</li>
						<li class="segunda_lista">
							<strong>¿Nuevo Parametro?</strong><br>
							<input type="text" class="disabled" name="parametro" value="<?php echo $parametro; ?>" disabled><br>
							<strong>¿Especifique por que el cambio?</strong><br>
							<textarea type="text" class="disabled" name="parametro_obser" disabled><?php echo $parametro_obser; ?></textarea>
						</li>
					</ul>
				</div>



			<?php }	} ?>

				</div>

						</div> <!-- /widget-content -->

						</div> <!-- /widget -->

                    <div class="span11">
		<h3>Diagnosticos Anteriores:</h3>
			<?php
			$filas = mysql_num_rows($tabla_diagnosticos);
			if($filas > 0) {
			while ($diagnostico=mysql_fetch_assoc($tabla_diagnosticos)) { ?>
				<div class="control-group">
					<label class="control-label_fecha_de_creacion" for="">Fecha: <?php echo $diagnostico['created_at']; ?> </label>
					<div class="controls">
						<textarea class="span11 form-control" disabled> <?php echo $diagnostico['diagnostico']; ?> </textarea>
					</div> <!-- /controls -->
				</div> <hr>

						<div class="control-group">
			<strong>¿Que desea desea hacer con la solicitud?</strong><br>

						<div class="controls">
                           <label class="radio inline">
									<input type="radio" name="aprobar" onchange="javascript:showContent()" value="Aprobar">Aprobar
								</label>
									<label class="radio inline">
									<input type="radio" name="denegar"  onchange="javascript:showContent()" value="Denegar">Denegar
								</label>


						</div> <!-- /controls -->
						</div> 






			<?php } }
			else { ?>
			<strong> No Existen diagnosticos anteriores para este paciente.</strong>
			
				<div class="control-group">
			<strong>¿Que desea desea hacer con la solicitud?</strong><br>

						<div class="controls">
                           <label class="radio inline">
									<input type="radio" name="aprobar" onchange="javascript:showContent()" value="Aprobar">Aprobar
								</label>
									<label class="radio inline">
									<input type="radio" name="denegar"  onchange="javascript:showContent()" value="Denegar">Denegar
								</label>


						</div> <!-- /controls -->
						</div> 

			<?php } ?>


				<div class="botonera">

				<button type="submit" class="btn btn-primary">Procesar</button>
				</div>
                    </div>
				</div>
			</div>
			</form>







<!-- ////////////////// END TAGS //////////////////////////////// -->
				</div> <!-- fin widget content -->
			</div><!-- fin widget -->
		</div><!-- fin container -->
	</div><!-- fin main-inner -->
</div><!-- fin main -->
</div>
