<?php
$id = $_GET['paciente'];
$tratamiento_id = $_GET['id'];
$header=2;
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
    echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Debe llenar algun campo para poder solicitar el cambio de tratamiento</center>';
	}elseif (isset($_GET['msg_guardo'])) {
    echo '<center class="alert alert-success paciente"><button type="button" class="close" data-dismiss="alert">×</button>La solicitud se realizo con exito Espere por su respuesta</center>';
	}elseif (isset($_GET['msg_error'])) {
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
		<h3>Solicitar Cambio</h3>
		</div> <!-- /widget-header -->

		<div class="widget-content inicio_tratamiento">

		<div class="solicitud">
		<form method="POST" action="../../PHP/enfermera/registrar_solicitud_tratamiento.php?paciente=<?php echo $paciente['id']; ?>&id_tratamiento=<?php echo $tratamiento_id; ?>&usuario=<?php echo $_SESSION['id_usuario']; ?> " class="form" role="form">


				<div class="span8 calse_lista"></div>
                    <ul class="listas_negras">
						<li>
							<strong>¿Nueva Frecuencia?</strong><br>
							<input type="text" name="frecuencia"><br>
							<strong>¿Especifique por que el cambio?</strong><br>
							<textarea type="text" name="frecuencia_obser"></textarea>
						</li>
						<li class="segunda_lista">
							<strong>¿Nuevo Parametro?</strong><br>
							<input type="text" name="parametro"><br>
							<strong>¿Especifique por que el cambio?</strong><br>
							<textarea type="text" name="parametro_obser"></textarea>
						</li>
					</ul>
				</div>

								<div class="botonera">
								<ul class="botonera_lista">
								<li>
								<button type="submit" class="btn btn-primary">Continuar</button>
								<li>
						</form>
						<form method="POST" action="./tratamientos_paciente.php?paciente=<?php echo $paciente['id']; ?>" class="form" role="form">
						<li class="cancelar">
						<button class="btn">Cancelar</button>
						<li>
							</form>
							</div>
						</div> <!-- /widget-content -->

						</div> <!-- /widget -->

						</div>

						</div>



<!-- ////////////////// END TAGS //////////////////////////////// -->
				</div> <!-- fin widget content -->
			</div><!-- fin widget -->
		</div><!-- fin container -->
	</div><!-- fin main-inner -->
</div><!-- fin main -->
</div>
