<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
?>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="widget">
				<div class="widget-header">
					<i class="icon user"></i>
					<h3> Paquete de tratamientos del Paciente:  </h3>
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
<!-- /////////////////////////////////////Detalles del paquete////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
				
	<h3> Procedimientos a Pagar: </h3>

	<div class="table-responsive">
		<table class="table">
			<tbody>
				<form>
					<?php 
						if (isset($_POST['pagar'])) {
							$ids = $_POST['id_procts'];
							$monto = $_POST['monto'];
							$total = 0;
							for ($i = 1; $i<count($ids); $i++)
							{ 
								$sql = mysql_query("SELECT * FROM tratamientos WHERE id = '{$ids[$i]}' LIMIT 1");
								$procts = mysql_fetch_assoc($sql);
								?>
								<tr>
									<td><strong> <?php echo $procts['nombre']; ?> </strong></td>
									<td>
										<input type="number" name="cant" min="1" max="<?php echo $procts['cantidad']; ?>" value="<?php echo $procts['cantidad']; ?>" >
									</td>
									<td>
										<strong> <?php echo $monto[$i]; ?> </strong>
									</td>
									<td>
										<strong> <?php echo $total_u = $procts['cantidad'] * $monto[$i]; ?> </strong>
									</td>
								</tr>
						<?php	}							
						}
					 ?>
				</form>
			</tbody>
		</table>
	</div>



				</div>

			</div>
		</div>
	</div>
</div>