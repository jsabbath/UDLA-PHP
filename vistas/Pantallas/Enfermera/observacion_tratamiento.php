<?php 
$id = $_POST['tratamiento_id'];
$paciente = $_POST['paciente'];
$sesion_id=$_POST['sesion_id'];
$header=2;
$activo=2;
require('../../header.php');
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$paciente}' LIMIT 1 ");
$paciente_data = mysql_fetch_assoc($tabla_pacientes);
?>


<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span6">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>Agregando Observaciones al tratamiento:</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content ">
							<div class="posicion">			
								<form method="POST" action="../../PHP/enfermera/guardar_observacion.php?cita=<?php echo $_GET['cita']; ?>">
									<input type="hidden" name="paciente" value="<?php echo $paciente;?>">
									<input type="hidden" name="tratamiento" value="<?php echo $id;?>">
									<input type="hidden" name="sesion_id" value="<?php echo $sesion_id;?>">
									<input type="hidden" name="usuario" value="<?php echo $_SESSION['id_usuario'];?>">
									<div class="control-group">
										<label>Indique la Observación:</label>
										<textarea class="span5" name="observacion"> </textarea>
									</div>

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