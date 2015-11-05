<?php
session_start();

  if ($_SESSION['id_nivel']==1) { 
               
$header=4;
$activo=2; 
}else{ 
$header=1;
$activo=4;
}
require('../../header.php');
include("../../PHP/paciente/consultas_historia.php");
include("../../PHP/funciones.php");
?>
<link rel="stylesheet" type="text/css" href="../../../css/chosen.css">
		<div class="container">
		<br>
			<div class="widget">
				<div class="widget-header">
					<i class="icon user"></i>
					<h3> Paquete de procedimientos del Paciente:  </h3>
				</div>

				<div class="widget-content">

					<?php include("cabezera2.php"); ?>
					<hr>
<!-- /////////////////////////////////////Detalles del paquete////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="tabbable">
	<ul class="nav nav-tabs">
		<?php $act = isset($_GET['act'])?$_GET['act']:""; ?>
		<li class="<?php if($act == ""){ echo "active";} ?>">
			<a href="#formcontrols" class="perfil" data-toggle="tab">Detalles del Paquete</a>
		</li>
		<li class="<?php if($act == "procedimientos"){ echo "active";} ?>">
			<a href="ver_historial.php?paciente=<?php echo $_GET['paciente']; ?>&act=procedimientos" class="perfil" >Procedimientos de Cabina</a>
		</li>
	
	</ul>

	<div class="tab-content">
					<div class="row-fluid">
						<h3>Datos del paquete:</h3>
						<?php 
						$paquete_id = $_GET['id'];
						$detalle_paq = mysql_query("SELECT * FROM paquetes WHERE  id ='{$paquete_id}'");
						$filas_paq = mysql_num_rows($detalle_paq);
						if($filas_paq >0)
						{?>
								<div class="table-responsive">
									<table class="table">
									<tr>
										<th>Estado</th>
										<th>Abonado</th>
										<th>Restante</th>
										<th>Total</th>
										<th>Creado</th>
										<th>Ultimo Pago</th>
										<th>Acción</th>
									</tr>
							<?php
							while($lista_paq = mysql_fetch_assoc($detalle_paq))
							{ ?>		
									<tr> 
										<td><?php if($lista_paq['status']== 0) { echo "Activo";} else { echo "Terminado";} ?></td>
										<td><?php echo $lista_paq['monto_abonado']; ?> Bs.</td>
										<td><?php echo $lista_paq['monto_deudor']; ?> Bs.</td>
										<td><?php echo $lista_paq['monto_total']; ?> Bs.</td>
										<td><?php echo $lista_paq['created_at']; ?></td>
										<td><?php echo $lista_paq['update_at']; ?></td>
										<td>
											<a href="#myModalNew" role="button" data-toggle="modal" class="btn btn-default"><i class="icon-plus"></i> Tratamiento</a>
											<a href="../../PHP/especialista/eliminar_paquete.php?paquete=<?php echo $lista_paq['id'];?>&paciente=<?php echo $id; ?>" class="btn btn-default"><i class="icon-trash"></i> Eliminar Paquete</a>
										</td>
									</tr>
						<?php } ?>
							</table>
							</div>
						<?php 	} ?>
						<?php if (isset($_GET['msg'])) {
						    $msg= $_GET['msg']; ?>
						    <div class="alert alert-danger">
						        <button type="button" class="close" data-dismiss="alert">&times;</button>
						        <strong><?php echo $msg; ?> </strong>
						    </div>
						<?php } ?>
						<h3>Procedimientos del paquete:</h3>

						<?php 
						$paquete_id = $_GET['id'];
						$detalle_trat = mysql_query("SELECT * FROM tratamientos WHERE paciente_id ='{$id}' AND  paquete_id ='{$paquete_id}'");
						$filas_trat = mysql_num_rows($detalle_trat);
						if($filas_trat >0)
						{?>
								<div class="table-responsive">
									<table class="table">
									<tr>
										<th>Procedimiento</th>
										<th>Lugar</th>
										<th>Sesiones</th>
										<th>Frecuencia</th>
										<th>Parametros</th>
										<th>Estado</th>
										<th>Actualizado</th>
										<th>Acción</th>
									</tr>
							<?php
							$i=0;
							$n=0;
							while($lista_trat = mysql_fetch_assoc($detalle_trat))
							{ 
								$i++;
								$n++;
								?>
									
									<tr> 
										<td><?php echo $lista_trat['nombre']; ?></td>
										<td><?php echo $lista_trat['parte']; ?> </td>
										<td><?php echo $lista_trat['cantidad']; ?> </td>
										<td><?php echo $lista_trat['frecuencia']; ?> </td>
										<td><?php echo $lista_trat['parametros']; ?></td>
										<td><?php 
											if($lista_trat['status']== 0) { echo "En Espera";} 
											elseif($lista_trat['status']== 1) { echo "En Proceso";}
											else{ echo "Aplicado";} 
											?>
										</td>
										<td><?php echo $lista_trat['updated_at']; ?></td>
										<td>
											<?php if($lista_trat['status']== 2) {?>  
												<a href="ver_tratamiento.php?paciente=<?php echo $lista_trat['paciente_id'];?>&id=<?php echo $lista_trat['id'];?>" class="btn btn-default"><i class="icon-eye-open"></i> Ver Resultados</a>

											<?php } else { ?>
												<a href="<?php echo "#myModalEdit".$n; ?>" role="button" data-toggle="modal" class="btn btn-default"><i class="icon-edit"></i> Editar</a>
												<a href="<?php echo "#myModalDelete".$n; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-default"><i class="icon-trash"></i> Eliminar</a>
											<?php } ?>
										</td>
									</tr>
                <!-- ////////// Modal Editar/////////////////-->
                <div id="<?php echo "myModalEdit".$n; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h3 id="myModalLabel"><i class="icon-edit"></i> Edite el Procedimiento</h3>
                  	</div>
                  	<div class="modal-body">
                    	<form method="POST" action="../../PHP/especialista/eliminar_tratamiento.php">

                    	<input type="hidden" name="tratamiento_id" value="<?php echo $lista_trat['id'];?>"> 
                    	<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
                    	<input type="hidden" name="paquete_id" value="<?php echo $_GET['id'];?> ">
                    
                <div class="row-fluid">
                    	
                    <div class="span6">
                    		
                    	
                  		<div class="control-group">											
                  			<label class="control-label" for="">Nombre del procedimiento:</label>
                  			<div class="controls">
                  				<select required class="chosen form-control" name="nombre">
                  					<option><?php echo $lista_trat['nombre']; ?></option>
                  					<?php 
                  						$lista_procd2 = mysql_query("SELECT * FROM lista_tratamientos ORDER BY nombre ASC ");
                  						while ($lista = mysql_fetch_assoc($lista_procd2)) { ?>
                  						<option><?php echo $lista['nombre']; ?> </option>	
                  					<?php } ?>
                  				</select>
                  			</div> <!-- /controls -->				
                  		</div>

                    	<div class="control-group">											
                  			<label class="control-label" for="">Parte del Cuerpo:</label>
                  			<select name="parte" class="form-control" required>
                  				<option><?php echo $lista_trat['parte']; ?></option>
                  				<option>Area del bikini</option>
							<option>Cuero cabelludo</option>
							<option>Axilas</option>
							<option>Cara</option>
							<option>Cara y Cuello</option>
							<option>Pecho</option>
							<option>Espalda</option>
							<option>Brazos</option>
							<option>Gluteos</option>
							<option>Muslos</option>
							<option>Piernas</option>
							<option>Cicatriz</option>
							<option>Cicatrices</option>
							<option>Manos</option>
							<option>Parpados</option>
							<option>Boso</option>
							<option>Papada</option>
							<option>Revolvera</option>
							<option>Abdomen</option>
							<option>Abdomen y Cintura</option>
							<option>Cintura</option>
							<option>Cara Femenina</option>
							<option>Cara y Cuello Femenina</option>
							<option>Cara Masculina</option>
							<option>Cara y cuello masculina</option>
                  			</select>				
                  		</div>
                  	</div>

                  	<div class="span6">		

                  		<div class="control-group">											
                  			<label class="control-label" for="">Cantidad de Sesiones:</label>
                  			<div class="controls">
                  				<input type="number" min="1" max="100" name="cantidad" value="<?php echo $lista_trat['cantidad']; ?>" class="form-control">
                  			</div> <!-- /controls -->				
                  		</div>

                  		<div class="control-group">											
                  			<label class="control-label" for="">Frecuencia del procedimiento:</label>
                  			<div class="controls">
                  				<select name="frecuencia" class="form-control" required>
								<option selected><?php echo $lista_trat['frecuencia']; ?></option>
								<option>Unica</option>
								<option>3 Dias</option>
								<option>5 Dias</option>
								<option>8 Dias</option>
								<option>10 Dias</option>
								<option>15 Dias</option>
								<option>Mensualmente</option>
							</select>
                  			</div> <!-- /controls -->				
                  		</div>
                  	</div>
                  	<div class="">
                  		<div class="control-group ">											
                  			<label class="control-label" for="">Parametros del Procedimiento:</label>
                  			<div class="controls">
                  				<input type="text" name="parametros" class="form-control" value="<?php echo $lista_trat['parametros']; ?>">
                  			</div> <!-- /controls -->				
                  		</div>
                  	</div>
                </div>

                  	</div>
                  	<div class="modal-footer">
                    	<button  class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    	<button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                  	</div>
                </div>

                <!-- ////////// Modal Eliminar /////////////////-->
                <div id="<?php echo "myModalDelete".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h3 id="myModalLabel"><i class="icon-trash"></i> ¿Esta seguro que desea eliminar el procedimiento?</h3>
                  	</div>
                  	<div class="modal-body">
                  		<form method="POST" action="../../PHP/especialista/eliminar_tratamiento.php">
                  		<center>
                  			<input type="hidden" name="tratamiento_id" value="<?php echo $lista_trat['id'];?>"> 
                  			<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
                  			<input type="hidden" name="paquete_id" value="<?php echo $_GET['id'];?> ">
	                    	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
	                    	<button name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
                    	</center>
                    	</form>
                  	</div>
                  	<div class="modal-footer">
                    	
                  	</div>
                </div>




						<?php } 
	                        

						?>
							</table>
							</div>
						<?php 	} ?>


						
					</div>

				</div> <!-- ////// fin widget-content /////// -->

				


               <!-- ////////// Modal Nuevo tratamiento/////////////////-->
                <div id="myModalNew" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h3 id="myModalLabel"><i class="icon-plus"></i> Agregar nuevo procedimiento.</h3>
                  	</div>
                  	<div class="modal-body">
                    	
                  		<form role="form" method="POST" action="../../PHP/especialista/register_tratamientos_modal.php">
                  			<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
                  			<input type="hidden" name="paquete_id" value="<?php echo $_GET['id'];?> ">
                  			<input type="hidden" name="tipo" value="cabina">
                  		<div class="control-group">											
                  			<label class="control-label" for="">Nombre del procedimiento:</label>
                  			<div class="controls">
                  				<select required class="chosen form-control" name="nombre_proc">
                  					<option>---------</option>
                  					<?php 
                  						$lista_procd = mysql_query("SELECT * FROM lista_tratamientos ORDER BY nombre ASC ");
                  						while ($lista2 = mysql_fetch_assoc($lista_procd)) { ?>
                  						<option value="<?php echo $lista2['nombre']; ?> "><?php echo $lista2['nombre']; ?> </option>	
                  					<?php } ?>
                  				</select>
                  			</div> <!-- /controls -->				
                  		</div>

                  		<div class="control-group">											
                  			<label class="control-label" for="">Parte del Cuerpo:</label>
                  			<select name="parte" class="form-control">
                  				<option value=""></option>
                  				<option>Area del bikini</option>
							<option>Cuero cabelludo</option>
							<option>Axilas</option>
							<option>Cara</option>
							<option>Cara y Cuello</option>
							<option>Pecho</option>
							<option>Espalda</option>
							<option>Brazos</option>
							<option>Gluteos</option>
							<option>Muslos</option>
							<option>Piernas</option>
							<option>Cicatriz</option>
							<option>Cicatrices</option>
							<option>Manos</option>
							<option>Parpados</option>
							<option>Boso</option>
							<option>Papada</option>
							<option>Revolvera</option>
							<option>Abdomen</option>
							<option>Abdomen y Cintura</option>
							<option>Cintura</option>
							<option>Cara Femenina</option>
							<option>Cara y Cuello Femenina</option>
							<option>Cara Masculina</option>
							<option>Cara y cuello masculina</option>
                  			</select>				
                  		</div>

                  		<div class="control-group">											
                  			<label class="control-label" for="">Cantidad de Sesiones:</label>
                  			<div class="controls">
                  				<input type="number" min="1" max="100" name="cantidad" value="1" class="form-control">
                  			</div> <!-- /controls -->				
                  		</div>

                  		<div class="control-group">											
                  			<label class="control-label" for="">Frecuencia del procedimiento:</label>
                  			<div class="controls">
                  				<select name="frecuencia" class="form-control" required>
								<option value="" selected>Seleccione</option>
								<option>Unica</option>
								<option>3 Dias</option>
								<option>5 Dias</option>
								<option>8 Dias</option>
								<option>10 Dias</option>
								<option>15 Dias</option>
								<option>Mensualmente</option>
							</select>
                  			</div> <!-- /controls -->				
                  		</div>
                  		
                  		<div class="control-group">											
                  			<label class="control-label" for="">Parametros del procedimiento:</label>
                  			<div class="controls">
                  				<input type="text" name="parametros" class="form-control">
                  			</div> <!-- /controls -->				
                  		</div>


                  	</div>
                  	<div class="modal-footer">
                    	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    	<button name="modal" type="submit" class="btn btn-primary">Guardar</button>
                  	</div>
                </div>

			</div>
		</div>
	</div>
</div>

<?php include("modal_edit_paciente.php"); ?>

<script type="text/javascript" src="../../../js/chosen.jquery.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".chosen").chosen();
		jQuery(".chosen").data("placeholder","Seleccione los procedimientos que indicara al paciente.").chosen();
	});	
</script>