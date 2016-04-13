	<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	                    $id=$_SESSION['id'];
						$nombre           =$_SESSION['nombre_completo'];
						$email            = $_SESSION['email'];
						$fecha_nacimiento = $_SESSION['fecha_nacimiento'];
						$cedula           = $_SESSION['cedula'];
						$telefono         = $_SESSION['telefono'];
						$direccion        =$_SESSION['direccion'];
						$sexo             =$_SESSION['sexo'];
						$estado_civil     =$_SESSION['estado_civil'];
						$ocupacion        =$_SESSION['ocupacion'];
		?>

	<div class="main">
		<div class="main-inner">
		    <div class="container">
		      <div class="row">		      	
		      	<div class="span12">		      		
		      		<div class="widget ">		      			
		      			<div class="widget-header">
		      				<i class="icon-user"></i>
		      				<h3>Paciente <?php echo $nombre; ?></h3>
		  				</div> <!-- /widget-header -->
						
						<div class="widget-content">
							<?php $act = isset($_GET['act'])?$_GET['act']:""; ?>					
						<div class="tabbable">
							<ul class="nav nav-tabs">
							  <li class="<?php if ($act == "") {echo "active";}?>">
							    <a class="perfil" href="#formcontrols" data-toggle="tab">Perfil</a>
							  </li>
							  <li class="<?php if ($act == "asign") {echo "active";}?>"><a class="perfil" href="#jscontrols" data-toggle="tab">Asignar Cita</a></li>
							  <li class="<?php if ($act == "citas") {echo "active";}?>"><a class="perfil" href="#jsconfirmacion" data-toggle="tab">Citas Medicas Realizadas</a></li>
							  <li><a class="perfil" href="#jsrecipe" data-toggle="tab">Generar Recipe</a></li>
							  <li><a class="perfil" href="#jsexamenes" data-toggle="tab">Examenes Solicitados</a></li>
							  <li><a class="perfil" href="#jspaquetes" data-toggle="tab">Presupuestos</a></li>

							</ul>						
							<br>
	<!-- ///////////////////////////////////////////////////////////////////////////// -->
	<!-- ///////////////////Datos del paciente////////////////////////////////////////// -->
	
							
<div class="tab-content">
	
	<div class="tab-pane <?php if ($act == "") {echo "active";}?>" id="formcontrols">
	<form id="edit-profile" class="form-horizontal" method="post" action="../../PHP/recepcion/actualizar_paciente.php">
		<fieldset>
			<?php 
            if(isset($_GET['guardado'])){ ?>           	
        		<div class="alert alert-success">
            		<button type="button" class="close" data-dismiss="alert">×</button>
                 	<center><strong><?php echo $_GET['guardado']; ?></strong></center>
                 </div>
            <?php  }
            else if(isset($_GET['error'])){ ?>
            	<div class="alert alert-error">
            		<button type="button" class="close" data-dismiss="alert">×</button>
                 	<center><strong><?php echo $_GET['error']; ?></strong></center>
                 </div>
             <?php } ?>
			<div class="control-group">											
				<label class="control-label" for="nombre">Nombre</label>
				<div class="controls">
					<input type="text" class="span6 disabled" name="nombre" value="<?php echo $nombre; ?>" >
					</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			
			
	               <div class="control-group">											
				<label class="control-label" for="cedula">Cedula</label>
				<div class="controls">
					<input type="text" class="span6 disabled" name="cedula"value="<?php echo $cedula; ?>" >
					</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			
			
			<div class="control-group">											
				<label class="control-label" for="email">Correo Electronico</label>
				<div class="controls">
					<input type="text" class="span4" name="email"value="<?php echo $email; ?>">
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
	
			
			<div class="control-group">											
				<label class="control-label" for="telefono">Telefono</label>
				<div class="controls">
					<input type="text" class="span4" name="telefono" value="<?php echo $telefono; ?>">
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
				<?php if ($sexo=='') { ?>
				<div class="control-group">											
				<label class="control-label" for="sexo">Sexo</label>
				<div class="controls">
					<select name="sexo">
					<option>Masculino</option>
					<option>Femenino</option>
					</select>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
					<?php } ?>
				<?php if ($estado_civil=='') { ?>
			
            		<div class="control-group">											
				<label class="control-label" for="estado_civil">Estado civil</label>
				<div class="controls">
					<select name="estado_civil">
                   <option>Soltero/a</option>
                    <option>Casado/a</option>
                    <option>Divorciado/a</option>
                    <option>Viudo/a</option>

					</select>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
            <?php } ?>
            <div class="control-group">											
				<label class="control-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
				<div class="controls">
					<input type="date" class="span4" id="" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>">
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			  <div class="control-group">											
				<label class="control-label" for="ocupacion">Ocupacion</label>
				<div class="controls">
					<input type="text" class="span4" name="ocupacion" value="<?php echo $ocupacion; ?>">
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->

			 <div class="control-group">											
				<label class="control-label" for="direccion">Direccion</label>
				<div class="controls">
					<textarea rows="3" name="direccion"><?php echo $direccion; ?></textarea>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->

              <div class="control-group">											
				
				<div class="controls">
					<input type="text" style="display:none;" name="id"value="<?php echo $id; ?>">
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
  	 <br />
			<div class="form-actions">       
				<button type="submit" class="btn btn-primary">Actualizar</button> 
				<button class="btn">Cancelar</button>
			</div> <!-- /form-actions -->
		</fieldset>
	</form>
	</div>
									
	<!-- ///////////////////////////////Asignar citas////////////////////////////////////////// -->
	<!-- ////////////////////////////////////////////////////////////////////////////////// -->
		<div class="tab-pane <?php if ($act == "asign") {echo "active";}?>" id="jscontrols">

			<?php 
	        if(isset($_GET['success'])){ ?>           	
	    		<div class="alert alert-success">
	        		<button type="button" class="close" data-dismiss="alert">×</button>
	             	<center><strong><?php echo $_GET['success']; ?></strong></center>
	             </div>
	        <?php  }
	        else if(isset($_GET['error_asign'])){ ?>
	        	<div class="alert alert-error">
	        		<button type="button" class="close" data-dismiss="alert">×</button>
	             	<center><strong><?php echo $_GET['error_asign']; ?></strong></center>
	             </div>
	         <?php } ?>

			<form id="edit-profile" class="form-horizontal" method="POST" action="../../PHP/recepcion/cita_paciente.php">
			<fieldset>              													
				<div class="control-group">											
					<label class="control-label" for="fecha">Seleccione una Fecha</label>
					<div class="controls">
						<input type="date" class="span4" name="fecha" min="<?php echo date('Y-m-d'); ?>">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->			
				<div class="control-group">											
					<label class="control-label">Motivo de la Cita</label>				
            		<div class="controls">
						<label class="radio inline">
							<input type="radio"  name="consulta" value="Control" checked="true">Control
						</label>
						<label class="radio inline">
							<input type="radio" name="consulta" value="Tratamiento">Tratamiento
						</label>

						<label class="radio inline">
							<input type="radio" name="consulta" value="Nuevo">Nuevo
						</label>

						<label class="radio inline">
							<input type="radio" name="consulta" value="Emergencia">Emergencia
						</label>

						<label class="radio inline">
							<input type="radio" name="consulta" value="Masajista">Masajista
						</label>
						<label class="radio inline">
							<input type="radio" name="consulta" value="Cirujia">Cirujia
						</label>
					</div>	<!-- /controls -->			
				</div> <!-- /control-group -->
                
				<div class="control-group">
					<label class="control-label">Nº de Historia Fisica:</label>
					<div class="controls">
						<input type="number" name="nro_historia" class="form-control">
					</div>										
				</div>		
					                                        
				<div class="control-group">											
					<label class="control-label" for="nota">Cita dirigida a</label>
					<div class="controls">
						<select name="remitido">
				    		<option value="Especialista">Medico Especialista</option>
                    		<option value="Cabina">Cabina</option>
                    		<option value="Recidente">Medico Residente</option>
						</select>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

                <div class="control-group">	
					<div class="controls">
						<input type="text" style="display:none;" name="id"value="<?php echo $id; ?>">
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
      	 		<br/>
				<div class="form-actions">	       
					<button type="submit" class="btn btn-primary">Crear Cita</button> 
				</div> <!-- /form-actions -->
			</fieldset>
		</form>
		</div>
<!-- //////////////////////////////Confirmacion///////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////// -->

	<div class="tab-pane  <?php if ($act == "citas") {echo "active";}?>" id="jsconfirmacion">
	
		<center><h3>Citas Medicas</h3></center>
			<?php 
	        if(isset($_GET['msg_cita'])){ ?>           	
	    		<div class="alert alert-success">
	        		<button type="button" class="close" data-dismiss="alert">×</button>
	             	<center><strong><?php echo $_GET['msg_cita']; ?></strong></center>
	             </div>
	        <?php  }
	        else if(isset($_GET['error_cita'])){ ?>
	        	<div class="alert alert-error">
	        		<button type="button" class="close" data-dismiss="alert">×</button>
	             	<center><strong><?php echo $_GET['error_cita']; ?></strong></center>
	             </div>
	         <?php } ?>
	  	<table class="table table-hover "> 
		    <thead>
	    	    <tr>
	    	    	<th>Nro</th>
	    	      <th>Fecha</th>
	    	      <th>Motivo</th>
	    	      <th>Remitido</th>
	    	      <th>Estado</th>
	    	      <th>Acciones</th>	      
	    		</tr> 
		    </thead>
		    <tbody>				
				<?php
				$nro = 1;
				$result = mysql_query("SELECT * FROM citas WHERE paciente_id = '{$id}' ORDER BY fecha DESC");			
				while($row = mysql_fetch_assoc($result))
				{ ?>
					<tr>
						<td><?php echo $nro; $nro++; ?></td>
						<td> <?php echo $row['fecha']; ?> </td>
						<td> <?php echo $row['tipo']; ?> </td>
						<td> <?php echo $row['remitido']; ?> </td>
						<td>
							<?php 
							if ($row['status']== 0) { ?>
								<span class="label label-info span-padd">Por Confirmar</span>
							<?php }
							else if ($row['status']== 1) { ?>
								<span class="label label-success span-padd">Confirmada</span>
							<?php }
							else if ($row['status']== 2) { ?>
								<span class="label span-padd">En Espera</span>
							<?php }
							else if ($row['status']== 3) { ?>
								<span class="label label-warning span-padd">Exitosa</span>
							<?php }
							else if ($row['status']== 15) { ?>
								<span class="label label-important span-padd">En Proceso</span>
							<?php }
							else if ($row['status']== 10) { ?>
								<span class="label label-inverse span-padd">Cancelada</span>
							<?php }
							?>
						</td>
						<td>
							<?php 
							if ($row['status']== 0 OR $row['status']== 1 ) { ?>
								<a href="../../PHP/recepcion/cancelar_cita2.php?cita=<?php echo $row['id'];?>&paciente=<?php echo $row['paciente_id']; ?>" class="btn "><i class="icon-trash" title="Cancelar"> Cancelar</i></a>
							<?php } ?>						
						</td>
					</tr>
	       		<?php  
	       		}  
	       		?> 
       		</tbody>	                      
	  	</table>
	</div>
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////PAQUETES////////////////////////////////////////// -->
	<div class="tab-pane" id="jsrecipe">
		<h3>Creacion de Recipe.</h3>
		<li>No disponible.</li>
	</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////EXAMENES DE LABORATORIO/////////////////////////////// -->
	<div class="tab-pane" id="jsexamenes">
		<h3>Examenes de laboratorio</h3>
		<?php include("../../PHP/recepcion/consulta_examenes_solicitados.php"); ?>
	</div>

	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- /////////////////////////////////////PAQUETES////////////////////////////////////////// -->
	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

		<div class="tab-pane" id="jspaquetes">
			<h3>Paquetes del paciente:</h3>
			<?php 
			$detalle_paq = mysql_query("SELECT * FROM paquetes WHERE  paciente_id ='{$id}' ORDER BY created_at DESC");
			$filas_paq = mysql_num_rows($detalle_paq);
			if($filas_paq >0)
			{?>
					<div class="table-responsive">
						<table class="table">
						<tr>
							<th>Revision</th>
							<th>Estado</th>
							<th>Monto</th>
							<th>Procedimientos</th>
							<th>Nombre Del Paquete</th>						
							<th>Creado</th>
							<th>Actualizado</th>
							<th>Acción</th>
						</tr>
				<?php
				while($lista_paq = mysql_fetch_assoc($detalle_paq))
				{ 
					$ap = mysql_query("SELECT id, total, status FROM paquete_aprobado WHERE paquete_id = '{$lista_paq['id']}' LIMIT 1 ");
					?>		
						<tr> 
							<?php if(mysql_num_rows($ap) == 1){
								$paq_ap = mysql_fetch_assoc($ap); 
								?>
								<td><span class="label label-success">Aprobado</span></td>
								<td><?php echo $paq_ap['status']; ?></td>
								<td> <strong><?php echo $paq_ap['total']; ?> Bs.f</strong> </td>
 						 	<?php }
							else{ ?>
								<td><span class="label">Sin Aprobar</span></td>
								<td>En Espera</td>
								<td></td>
								<?php } ?>
							<?php $cant_prc = mysql_query("SELECT count(id) AS cant FROM tratamientos WHERE paquete_id = '{$lista_paq['id']}' ");
								$cant = mysql_fetch_assoc($cant_prc);
							?>
							<td><center><span class="badge badge-success"> <?php echo $cant['cant']; ?></span></center> </td>
							<td><strong><?php echo $lista_paq['nombre']; ?></strong></td>
							
							<td><i class="icon-calendar"></i> <?php echo $lista_paq['created_at']; ?></td>
							<td><i class="icon-calendar"></i> <?php echo $lista_paq['update_at']; ?></td>
							<td>
								<a href="paquetes.php?paquete=<?php echo $lista_paq['id'];?>&paciente=<?php echo $id;?>" class="btn btn-default"><i class="icon-plus"></i> Ver Detalle</a>
							</td>
						</tr>
			<?php } ?>
				</table>
				</div>
			<?php } 
			else{
				echo "<p>El paciente no posee ningun paquete o tratamiento aun.</p>";
			}
			?>

		</div>

		</div>						  
		</div>			
		</div> <!-- /widget-content -->
		</div> <!-- /widget -->
		      		
			 </div> <!-- /span8 -->  	
		      </div> <!-- /row -->
		
		    </div> <!-- /container -->
		    
		</div> <!-- /main-inner -->
	    
	</div> <!-- /main -->

</body>
</html>

