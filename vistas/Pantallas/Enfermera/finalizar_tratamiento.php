<?php 
$id = isset($_GET['id'])?$_GET['id']: "" ;
$paciente = $_GET['paciente'];
$sesion_id = $_GET['sesion'];
$header=2;
$activo=2;
require('../../header.php');
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$paciente}' LIMIT 1 ");
$paciente_data = mysql_fetch_assoc($tabla_pacientes);
$tabla_usuario = mysql_query("SELECT * FROM porcentaje WHERE status = 'Activo' ");
?>
 <script>
$(document).ready(function() { $("#usuario").select2(
{
	placeholder: "Selecciones quien aplico el tratamiento",
    allowClear: true,}	); 
});
</script>


<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span6">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>Aplicando tratamiento:</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content ">
							<div class="posicion">		
								<center>
								<h3 class="texto">Si ha finalizado correctamente la aplicación del tratamiento. 
                                , Por favor Seleccione su nombre</h3>
								</center>
								
								<form method="POST" action="../../PHP/enfermera/finalizar_tratamiento.php?cita=<?php echo $_GET['cita']; ?>">
									<input type="hidden" name="paciente" value="<?php echo $paciente;?>">
									<input type="hidden" name="tratamiento" value="<?php echo $id;?>">
									<input type="hidden" name="sesion_id" value="<?php echo $sesion_id;?>"><br>
									<center><select required class="form-control parametro" name="nombre" id="usuario">
								<option></option>
								<?php while ($lista = mysql_fetch_assoc($tabla_usuario)) { ?>
									<option value="<?php echo $lista['id']; ?>"><?php echo $lista['nombre']; ?></option>	
								<?php } ?>
							</select></center>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary btn-large">Finalizar</button> 
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