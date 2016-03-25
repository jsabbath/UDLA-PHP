<link rel="stylesheet" type="text/css" href="../../../css/chosen.css">
<link type="text/css" rel="stylesheet" href="../../../css/autocomplete.css"></link>
<?php
if(!isset($_SESSION['id_nivel']))
{
	session_start();
}

if ($_SESSION['id_nivel']==1) {

$header=4;
$activo=2;
}else{
$header=10;
$activo=4;
}
$paquete_id = isset($_GET['paquete'])?$_GET['paquete']:"";
require('../../header.php'); 
include("../../PHP/paciente/consultas_historia.php");
include("../../PHP/funciones.php");

?>


<!-- ///////////////////////////Datos del paciente////////////////////////////// -->


<div class="container">
<br>
<div class="widget">
	<div class="widget-header"> 
		<i class="icon-user"></i>
		<strong> Historial del Paciente:  </strong>
	</div>

	<div class="widget-content">

	<?php include("cabezera2.php"); ?>

<div class="tabbable">
	<ul class="nav nav-tabs">
		<?php $act = isset($_GET['act'])?$_GET['act']:""; ?>
	<?php if ($_SESSION['id_nivel']==1) { ?>
			<li class="">
			<a href="../Enfermera/tratamientos_paciente.php?paciente=<?php echo $paciente['id']; ?>" class="perfil" >Aplicar Tratamientos</a>
		</li>
<?php } ?>

		<li class="<?php if($act == ""){ echo "active";} ?>">
			<a href="#formcontrols" class="perfil" data-toggle="tab">Diagnosticos</a>
		</li>
		<li class="<?php if($act == "procedimientos"){ echo "active";} ?>">
			<a href="#jscontrols" class="perfil" data-toggle="tab">Procedimientos de Cabina</a>
		</li>
		<li class="<?php if($act == "cas"){ echo "active";} ?>">
			<a href="#jsrecipe" class="perfil" data-toggle="tab">Tratamientos</a>
		</li>
		<li class="<?php if($act == "exam"){ echo "active";} ?>">
			<a href="#formexamenes" class="perfil" data-toggle="tab">Ordenes de Laboratorio</a>
		</li>
		<li>
			<a href="#jshistorial" class="perfil" data-toggle="tab">Historial</a>
		</li>
	</ul>

	<div class="tab-content">

<!-- /////////////////////////////////////Diagnosticos del paciente////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<div class="tab-pane <?php if($act == ""){ echo "active";} ?> " id="formcontrols">
			<?php if (isset($_GET['status_patologia'])) { ?>
			<?php $c=0; ?>
	<div class="row-fluid">
<div class="patologias">
<tr>
<form name="form_diagnostico" method="POST" action="../../PHP/especialista/register_diagnosticos.php">
<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
<?php while ($patologias_1 = mysql_fetch_assoc($patologias_0)) { ?>
<input type="hidden" name="id[]" value="<?php echo $patologias_1['id'];?> ">
<input type="hidden" name="contador" value="<?php echo $patologias_1['id'];?> ">

<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th class="nombre_patologia"><?php echo ($patologias_1['diagnostico']); ?></th>
      <th class="detalle_patologia"><label class="control-label" for="">Detalles:</label>
       <textarea type="text"  name="detalles[]" class="form-control detalles" ></textarea></th>
    </tr>
  </thead>

</table>

<?php  $c++; } ?>
		<div class="form-actions">
		<button type"submit" =class="btn btn-primary" name="patologias_detalles">Guardar</button>

		</div>
		<input type="hidden" name="contador" value="<?php echo $c;?> ">
		</form>
</div></div><tr>



 <?php  }else{  ?>

			<h3>Diagnosticos registrados:</h3>
				<div id="respuesta">
					<?php include("../../PHP/especialista/consulta_diagnostico.php"); ?>
				</div>
                <hr>

			<h3>Nuevo Diagnostico:</h3>
			<form name="form_diagnostico" method="POST" action="../../PHP/especialista/register_diagnosticos.php">
				<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
				<?php
				$patologias = mysql_query("SELECT * FROM patologias ORDER BY patologias ASC");
				?>
			<div class="container-fluid">
			<div class="row-fluid">

				<div class="control-group patologias">
					<label class="control-label">Patologia Encontrada:</label>
					<ul>
					<?php while($pat = mysql_fetch_assoc($patologias))
						{ ?>
						<li>
		              		<label>
					  			<input type="checkbox" class="check" name="item[]" value="<?php echo utf8_encode($pat['patologias']); ?>">
		               				<span class="label-text">
		              					<?php echo utf8_encode($pat['patologias']); ?>
		              				</span>
		              		</label>
						</li>
						<?php } ?>
                 		<li class="otra_patologia"><a class="btn-small btn-success"role="button" data-toggle="modal" href="#myModalpatologia_2">Agregar otra</a></li>
					</ul>
				</div>	

				<div class="form-actions">
					<button class="btn btn-primary">Guardar</button> 
					<button class="btn">Cancelar</button>
				</div>
			</form>
		</div>
		</div>


			<div id="myModalpatologia_2" name="motivo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"><i class="icon-plus"></i> Agregar nueva patologia</h3>
			</div>
			<div class="modal-body">
			<form role="form" method="POST" action="../../PHP/especialista/nueva_patplogia.php">

			<div class="control-group">
			<label class="control-label" for="">Escriba el nombre de la nueva patologia a listar</label>
			<div class="controls">
		     <input class="patologia" type="text" name="patologia_2">
		     <input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
			</div> <!-- /controls -->
			</div>
			</div>
			
			<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			<button  type="submit" class="btn btn-primary">Guardar</button>
			</form>
			</div>

			</div>


<hr>

<?php } ?>
		</div>
<!-- /////////////////////////////////////////Procedimientos de cabina///////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<div class="tab-pane <?php if($act == "procedimientos"){ echo "active";} ?>" id="jscontrols">

		<?php if(isset($_GET['paquete']))
		{ ?>
				
		<div class="span11" id="resp_procedimientos">
			<h3>Lista de procedimentos Registrados:</h3>				
			<?php include("../../PHP/especialista/consulta_procedimientos.php"); ?>
			<hr>
		</div>
		
		<div class="row-fluid">
		<div class="Container-fluid">
		<h3>Asignacón de procedimientos:</h3>

		<div class="span10">
		
		<?php 
		if (isset($_GET['error'])){ ?>
			<div class="alert">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Ha ocurrido un problema!</strong> <?php echo $_GET['error']; ?>.
			</div>
		<?php } ?>	
		</div>
			
			<form method="POST"  action="../../PHP/especialista/register_tratamientos2.php">
				<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
				<input type="hidden" name="paquete_id" value="<?php echo $_GET['paquete'];?> ">	

				<div class="span6">
					<div class="control-group">
						<label>¿Desea asignar obsequios al paquete?</label>
						<label class="radio">
		                    <input type="radio" name="date" id="date1" value="hoy" onchange="javascript:showRegalo()" checked> NO
		                </label>
		                <label class="radio">
		                    <input type="radio" name="date" id="date2" value="periodo" onchange="javascript:showRegalo()"> SI
		                </label>
					</div>
				</div>	
				<div class="span6">
					<div class="control-group" id="content2" style="display: none;">
						<label><strong>Obsequios para el paquete:</strong></label>
						
						<select multiple="multiple"  class="form-control span6 chosen" id="obsequio" name="obsequio[]" title="No ha indicado ningun obsequio, desmarque la opcion si no desea enviarlo.">
							<option value=""></option>
							<?php $li = mysql_query("SELECT * FROM lista_tratamientos ORDER BY nombre ASC "); ?>
							<?php while ($lis = mysql_fetch_assoc($li)) { ?>
							 <option><?php echo $lis['nombre']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

			<table class="table ">
				<thead>
					<tr>
						<th width="">Procedimiento</th>
						<th width="">Area</th>
						<th width="" align="center">Cantidad</th>
						<th width="">Frecuencia</th>
						<th width="">Parametros</th>
					</tr>
				</thead> 
				<tbody id="contenedor">
				
      			<?php for($i = 0; $i < 10; $i++) { ?>
					<tr>
						<td width="">
							<div class="control-group">							
								<div class="">
									<select  class="chosen" name="nombre[]">
										<option value=""></option>
										<?php $listas = mysql_query("SELECT * FROM lista_tratamientos ORDER BY nombre ASC "); ?>
										<?php while ($lista = mysql_fetch_assoc($listas)) { ?>
										 <option><?php echo $lista['nombre']; ?></option>
										<?php } ?>
									</select>
								</div> <!-- /controls -->
							</div>
						</td>

						<td width="">
								<div class="cuerpo">
								<select name="parte[]" class="form-control partes">
									<option value=""> </option>
									<?php 
										$part = mysql_query("SELECT * FROM ajustes_partescuerpo ORDER BY parte ASC");
										while ($par = mysql_fetch_assoc($part)) { ?>
												<option><?php echo $par['parte']; ?></option>
										<?php } ?>
								</select>
								</div>
						</td>

						<td width="" align="center">
							<div class="control-group">
								<div class="controls">
									<input type="number" min="1" max="100" value="1" name="cantidad[]" class="form-control seciones" required>
								</div> <!-- /controls -->
							</div>
						</td>

						<td width="" align="center">
							<div class="control-group">
								<div class="controls">
									<select name="frecuencia[]" class="form-control" >
										<option value="" selected>Seleccione</option>
										<option value="1">Unica</option>
										<option value="3">3 Dias</option>
										<option value="5">5 Dias</option>
										<option value="7">7 dias</option>
										<option value="8">8 Dias</option>
										<option value="10">10 Dias</option>
										<option value="12">12 Dias</option> 
										<option value="15">15 Dias</option> 
										<option value="21">21 Dias</option>
										<option value="30">Mensualmente</option>
									</select>
								</div> <!-- /controls -->
							</div>
						</td>

						<td width="">
							<div class=" autocomplete">
								<input name="parametros[]" class="" data-source="search.php?search=" >
							</div>
						</td>
					</tr>
				<?php } ?> 
      	     
      		</tbody>
      	</table>
      	<div class="control-group">
      		<button class="btn btn-primary" type="submit" >Registrar</button> 
      		</form>
      	</div>			
		</div>		
	</div>

		<?php }
		else
		{ ?>
			<h3>Paquetes que posee el paciente:</h3>
			<form action="../../PHP/especialista/nuevo_paquete.php" method="get" class="form-horizontal" accept-charset="utf-8">
				<input type="hidden" name="on" value="create">
				<input type="hidden" name="paciente" value="<?php echo $id; ?>">
				<div class="input-append">
					<input type="text" name="nombre" class="span3" placeholder="Nombre del Paquete" required title="Ingrese un nombre para el paquete">
					<button type="submit" class="btn">Agregar nuevo paquete</button>
				</div>				
			</form>
			
			<?php
			$paquetes_paciente = mysql_query("SELECT * FROM paquetes WHERE  paciente_id ='{$id}' ORDER BY created_at DESC");
			$filas_paq = mysql_num_rows($paquetes_paciente);
			if($filas_paq > 0)
			{ ?>
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>Nro</th>
								<th>Revision</th>
								<th>Estado</th>
								<th>Monto</th>
								<th>Procedimientos</th>
								<th>Nombre Del Paquete</th>						
								<th>Creado</th>
								<th>Actualizado</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
				<?php
			$i=1;
				while($lista_paq = mysql_fetch_assoc($paquetes_paciente))
				{ 
					$ap = mysql_query("SELECT id, total, status FROM paquete_aprobado WHERE paquete_id = '{$lista_paq['id']}' LIMIT 1 ");
					?>

						<tr>
                            <td><?php  if ($i==1 ) {
								echo "Reciente";
								$i++;
	                            }else{ echo $i;
	                            $i++; } ?>
                            </td>
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
			
							<td><a href="detalle_paquete.php?id=<?php echo $lista_paq['id'];?>&paciente=<?php echo $id;?>" class="btn btn-default"><i class="icon-eye-open"></i> Ver</a></td>
						</tr>
			<?php } ?>
			</tbody>				
			</table>
			</div>
	<?php }
			else
			{
				echo "<h3> El paciente aun no posee paquetes de procedimientos.</h3>";
			}
			?>
			
			<?php
		}
		?>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

			<div class="tab-pane <?php if($act == "cas"){ echo "active";} ?>" id="jsrecipe">
			<h3>Tratamientos:</h3>
			<?php if (isset($_GET['msg'])) {
			$msg= $_GET['msg']; ?>
			<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong><?php echo "Lo, sentimos ocurrio un problema al guardar." ?> </strong>
			</div>
			<?php } ?>
			<form role="form" method="POST" action="../../PHP/especialista/register_tratamientos_modal.php">
						<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
						<div class="span12 recipes">
							<ul>
							<li class="control-group ">
							<label class="control-label" for="email">Recipe Medico </label>
							<textarea  class="span5 form-control" id="area1"  name="recipe"></textarea>
							</li> <!-- /controls -->
							<li class="control-group ">
							<label class="control-label" for="email">Tratamientos</label>
							<textarea  class="span5 form-control" id="area2" name="explicacion"></textarea>
							</textarea>
							</li> <!-- /controls -->

							</ul>

							</div>
							<div class="form-actions">
					<button name="trat_casa" type="submit" class="btn btn-primary">Guardar</button> 
				</div>
			</form><br><br>

			<div class="span12 imprecion">
					<h3>Lista de Tratamientos:</h3>
					<?php $i=0; ?>
					<?php while ($lista_casa = mysql_fetch_assoc($tratamientos_casa)) { ?>
 
<li> <div class="fecha_trat"><?php echo $lista_casa['created_at']; ?> </div>
<div class="nombre_trat">

<a href="<?php echo "#myModalrecipe".$i; ?>" role="button" data-toggle="modal" class="btn btn-default alertas">Ver Recipe</a>
		<div id="<?php echo "myModalrecipe".$i; ?>" name="motivo" class="modal hide fade tratamientos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"> Tratamientos del paciente <?php echo $paciente['nombre_completo']; ?> </h3>
			</div>

			<div class="modal-body">
			<div class="control-group">
              <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Recipe</th>
                      <th>Tratamiento</th>
                    </tr>
                  </thead>
                  <tbody>
                       <tr class="odd gradeX">
                        <td><?php  echo $lista_casa['recipe_1']; ?></td>
                         <td><?php  echo $lista_casa['recipe_2']; ?></td>
                      </tr>
                   
                  </tbody>
                </table>

			<div class="controls">
			</div> <!-- /controls -->
			</div>
			</div>

			<div class="modal-footer">
			<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Salir</button>

</div>

			</div><hr>
	

</div></li>
<?php  $i++; } ?>
</div></div>



<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<div class="tab-pane <?php if($act == "exam"){ echo "active";} ?>" id="formexamenes">
			<h3>Lista de Examenes:</h3>
			<form role="form" method="POST" action="../../PHP/especialista/register_examenes.php">
				<input type="hidden" name="paciente_id" value="<?php echo $id;?> ">
				<div class="row-fluid">
				<div class="checkbox">
					<div class="span6">
						<div class="row-fluid">
							<div class="span6 examenes">
							<ul>
								<li>
								<input type="checkbox" name="item[]" value="Perfil, curva y Tiroides">
								Perfil, curva y Tiroides
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Perfil 20">
								Perfil 20
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Curva de insulina">
								Curva de insulina
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Curva de tolerancia glucosada con 75gr de glucosa. Toma cada 30 minutos por 120 minutos.">
								Curva de tolerancia glucosada con 75gr de glucosa. Toma cada 30 minutos por 120 minutos.
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Perfil tiroideo">
								Perfil tiroideo
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Anticuerpo antitiroideo">
								Anticuerpo antitiroideo
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Hormonas sexuales femeninas">
								Hormonas sexuales femeninas
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Hormonas sexuales masculinas">
								Hormonas sexuales masculinas
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Hematologia completa">
								hematologia completa
								</li> <br>

								<li>
								<input type="checkbox" name="item[]" value="Examen simple de orina">
								Examen simple de orina
								</li> <br>
								</ul>
							</div>



							<div class="span6 examenes">
								<ul>
								<li>
								<input type="checkbox" name="item[]" value="Examen simple de heces">
								Examen simple de heces
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="antigeno Prostatico">
								Antigeno Prostatico
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Hemoglobina glicosilada">
								Hemoglobina glicosilada
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Hemoglobina glicosilada">
								Anticuerpo antinuclear
								</li> <br>


								<li>
								<input type="checkbox" name="item[]" value="Ecografía de partes blandas: Zona anatómica">
								Ecografía de partes blandas: Zona anatómica
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Ecografía Doppler arterial y venosa: Zona anatómica">
								Ecografía Doppler arterial y venosa: Zona anatómica
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Radiografía: Zona anatómica">
								Radiografía: Zona anatómica
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Tomografía: Zona anatómica">
								Tomografía: Zona anatómica
								</li> <br>
								<li>
								<input type="checkbox" name="item[]" value="Resonancia Magnética: Zona anatómica">
								Resonancia Magnética: Zona anatómica
								</li> <br>
								<li>
								<input type="checkbox" name="item" id="otro" onchange="javascript:showContent()">
								Otro
								</li><br>
								</ul>
								
							</div>
						</div>
						<div class="">
							<div class="control-group" id="content" style="display: none;">
								<label class="control-label" for="">Otro Examen:</label>
								<div class="controls">
									<input type="text" name="item[]" class="form-control">
								</div> <!-- /controls -->
							</div>
							<br>
						</div>
					</div>
				</div>
			<div class="span5">
				<h3>Examenes solicitados:</h3>
				<?php include("../../PHP/recepcion/consulta_examenes_solicitados.php"); ?>
			</div>
		</div>


	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Actualizar</button>
		<button class="btn">Cancelar</button>
	</div>
</form>

		</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
					<!-- //////TAG HISTORIAL/////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="tab-pane" id="jshistorial">
			<h3>Historial del Paciente:</h3> <hr>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<div class="row-fluid">
		<center></center>

		<div class="span6">
			<h2>Antecedentes Personales:</h2>		
			<?php if(mysql_num_rows($tabla_antecedente_pers) > 0)
			{?>			
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Nº</th>
								<th>Enfermedad</th>
								<th>Hace Cuanto</th>
							</tr>
						</thead>
						<?php
							$nro_ap = 0;
							while($antec = mysql_fetch_assoc($tabla_antecedente_pers))
							{ $nro_ap++; ?>
								<tr>
									<td><?php echo $nro_ap; ?></td>
									<td>
										<?php 								
										if ($antec['enfermedad']=='Enfermedades Dermatologicas')
										{
											echo $antec['enfermedad'].": ". $antec['cual_derma'];
										}
										else
										{
											echo $antec['enfermedad'];
										} ?>
									</td>
									<td><?php echo $antec['hace_cuanto'];?></td>
								</tr>
								
							<?php
							}
							?>
					</table>
				</div>
			<?php
			}
			else
			{ ?>
				<li><p><i>El paciente no ha registrado o no posee ningun antecedente personal.</i></p></li>
			<?php } ?>
		</div> <!-- fin de antecedentes personales -->
		
		<div class="span5">
			<h2>Antecedentes Familiares:</h2>
			<?php 
			if(mysql_num_rows($tabla_antecedentes_familiares) > 0 ) 
			{?>			
				<div class="table-responsive">
					<table class="table table-hover ">
						<thead>
							<tr>
								<th>Nº</th>
								<th>Enfermedad</th>
								<th>Parentesco</th>
								<th>Hace Cuanto</th>
							</tr>
						</thead>
						<?php
						$nro_af = 0;
						while($date = mysql_fetch_assoc($tabla_antecedentes_familiares))
						{ $nro_af++; ?>
							<tbody>
								<tr>
									<td><?php echo $nro_af; ?></td>
									<td>
										<?php 								
										if ($date['enfermedad']=='Enfermedades Dermatologicas')
										{
											echo $date['enfermedad'].": ". $date['extra'];
										}
										else
										{
											echo $date['enfermedad'];
										} ?>
									</td>
									<td><?php echo $date['parentesco']; ?></td>
									<td><?php echo $date['hace_cuanto']; ?></td>
								</tr>
							</tbody>
						<?php
						} ?>
					</table>
				</div>
			<?php 
			} 
			else
			{ ?>
				<li><p><i>El paciente no ha registrado o sus familiares no poseen ningun antecedente.</i></p></li>
			<?php 
			} ?>

		</div>

    </div>
             <hr>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			
	<div class="row-fluid">
		<h2>Tratamientos Anteriores:</h2>
		<div class="span12">
			<div class="container-fluid">
		<?php if(mysql_num_rows($tabla_trat_previos) > 0 )
		{ ?>
			<div class="table-responsive">
				<table class="table table-hover ">
					<thead>
						<tr>
							<th>Nº</th>
							<th>Tratamiento</th>
							<th>Medicamento</th>
							<th>Motivo</th>
							<th>Hace Cuanto</th>
							<th>Continua</th>
						</tr>
					</thead>
					<?php
					$num_tr = 0; 
					while($trat = mysql_fetch_assoc($tabla_trat_previos))
					{ $num_tr++; ?>
						<tbody>
							<tr>
								<td><?php echo $num_tr; ?></td>
								<td><?php echo $trat['tratamientos']; ?></td>
								<td><?php echo $trat['cual']; ?></td>
								<td><?php echo $trat['motivo']; ?></td>
								<td><?php echo $trat['desde_cuando']; ?></td>
								<td><?php echo $trat['actualmente']; ?></td>
							</tr>
						</tbody>								
					<?php } ?>
				</table>
			</div>
		<?php 
		} 
		else
		{ ?>
			<li><p><i>El paciente no ha registrado o no ha tomado ningun tratamiento anteriormente.</i></p></li>
		<?php 
		} 
		?>
		</div>
	</div>
</div>
<hr>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    
        <?php 
        if(mysql_num_rows($tabla_alergias) > 0)
        {
        	$alergias = mysql_fetch_assoc($tabla_alergias);
        ?>
            <div class="row-fluid">			
				<div class="span6">
					<h2>Alergias a medicamentos:</h2>
					<?php if($alergias['si_med']== 'si'){ ?>
						<li>
							<strong>Alergico a : </strong> 
								<?php echo $alergias['medicamento']; ?> 
						</li>
					<?php }
					else
					{ ?>
						<li><i>No es alergico a medicamentos.</i></li>
					<?php } ?>
				</div>
				<div class="span6">
					<h2>Alergias a alimentos:</h2>
					<?php if($alergias['si_alim']== 'si'){ ?>
						<li>
							<strong>Alergico a:</strong> 
								<?php echo $alergias['alimento']; ?> 
						</li>
					<?php }
					else
					{ ?>
						<li><i>No es alergico a alimentos.</i></li>
					<?php } ?>
				</div>
			</div>
		<?php 
			
		}
		else
		{ ?>
			<li><i>No posee alergias registradas.</i></li>
		<?php } ?>
		<hr>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<div class="row-fluid">
		<div class="span6">
			<h2>Operaciones Realizadas:</h2>			
			<?php 
			if(mysql_num_rows($tabla_operaciones) > 0)
			{
				while($operaciones = mysql_fetch_assoc($tabla_operaciones))
				{
				 ?>
					<li><strong><?php echo $operaciones['de_que']; ?> : </strong>
					<?php echo  calcular_fechas($operaciones['fecha']); ?>	</li>
			<?php } 
			}
			else
			{ ?>
				<li><i>No posee operaciones registradas.</i></li>
			<?php 
			}
			?>
		</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

		<div class="span6">
			<h2>Examenes que se ha realizado:</h2>
			<?php if(mysql_num_rows($tabla_examenes) > 0 )
			{ 
				while($examenes = mysql_fetch_assoc($tabla_examenes)) 
				{ ?>
					<li> <strong><?php echo $examenes['examen']; ?> :</strong>  
					<?php echo $examenes['hace_cuanto']; ?> </li>
				<?php
				}
			} 
			else
			{ ?>
				<li><i>No posee examenes registrados.</i></li>
			<?php 
			}
			?>
		</div>
	</div>
	<hr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
				
    <div class="row-fluid">
   		<h2>Uso cremas, shampo y Jabones</h2>
			<?php if(mysql_num_rows($tabla_cremas) > 0)
			{ ?>
		
				<div class="span6">
					<li>
						<strong> Protector Solar: </strong> 
						<?php 
							if ($cremas['protector_solar'] == "no - ") { echo "Ninguno"; }
							else
							{ $ps = explode("-",$cremas['protector_solar']);
								echo $ps[1];
							}					 
						?>
					</li>
					<li>
						<strong> Crema para la cara de noche:</strong> 
						<?php 
							if ($cremas['crema_cara_noche'] == "no - ") {
								echo "Ninguno";
							}
							else
							{
								$cn = explode("-",$cremas['crema_cara_noche']);
								echo $cn[1];
							}					 
						?>

					</li>
					<li>
						<strong> Crema para la cara de dia:</strong> 
						<?php 
							if ($cremas['crema_cara_dia'] == "no - ") {
								echo "Ninguno";
							}
							else
							{
								$cd = explode("-",$cremas['crema_cara_dia']);
								echo $cd[1];
							}						 
						?>
					</li>

				</div>
				<div class="span5">
					<li>
						<strong> Shampo para el lavado del cabello:</strong> <?php echo $cremas['champu_cabello']; ?>
					</li>
					<li>
						<strong> Jabon para el lavado de la cara:</strong> <?php echo $cremas['javon_cara']; ?>
					</li>
					<li>
						<strong> Jabon para baño diario:</strong> <?php echo $cremas['javon_diario']; ?>
					</li>
				</div>
			
			<?php } ?>															
		</div>
	<hr>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="row-fluid">
		<div class="span6">
			<h2>Habitos Psicobiologicos</h2>
			<?php if(mysql_num_rows($tabla_habitos)>0) 
			{ ?>
			<ul>
					
		<?php if($habitos['fuma']== 'si')
		{ ?>
			<li><strong>Es fumador: </strong> Si,  <?php echo $habitos['fuma_frecuencia']; ?>.</li>
		<?php }
		 ?>
		<?php if($habitos['ejercicios']== 'si')
		{ ?>
			<li><strong>Hace ejercicios o va al Gymnasio: </strong> Si,  <?php echo $habitos['ejerc_frecuencia']; ?>.</li>
		<?php }
		 ?>
		<?php if($habitos['alcohol']== 'si')
		{ ?>
			<li><strong>Bebe Alcohol: </strong> Si,  <?php echo $habitos['alcohol_frec']; ?>.</li>
		<?php }
		 ?>
		<li><strong>Trabaja: </strong>  <?php echo $habitos['trabajo']; ?>.</li>
		<?php if($habitos['deporte']== 'si')
		{ ?>
			<li><strong>Practica algun deporte: </strong> Si,  <?php echo $habitos['deport_frecuencia']; ?>.</li>
		<?php }
		 ?>
		</ul>
		<?php } ?>
	</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<div class="span6">
	<h2>Preguntas según sexo</h2>
	<?php if($paciente['sexo']== 'Femenino')
	{
		if(mysql_num_rows($tabla_preg_mujer)>0)							
		{ ?>
	
		<li><strong> Ha tenido Ovarios poliquísticos o multifoliculares : </strong>   <?php echo $preg_sexo['ovarios_poli']; ?>.</li>
		<li><strong> Ha tenido trastornos menstruales: </strong>   <?php echo $preg_sexo['trastornos_menst']; ?>.
		<li><strong> Toma Anticonceptivos: </strong>   <?php echo $preg_sexo['toma_anticonceptivos']; ?>.</li>
		<li><strong> Cuales: </strong>   <?php echo $preg_sexo['cuales']; ?>.</li>
		<li><strong> Toma Hormonas: </strong>   <?php echo $preg_sexo['toma_hormonas']; ?>.</li>
		<li><strong> Tiene Sospecha de embarazo: </strong>   <?php echo $preg_sexo['embarazo']; ?>.</li>
		<li><strong> su ultima mestruación: </strong>   <?php echo calcular_fechas($preg_sexo['ult_mestruacion']); ?></li>
	
	<?php }
	}
	if($paciente['sexo']== 'Masculino')
	{ 
		if(mysql_num_rows($tabla_preg_hombre)>0)
		{	
		?>

		<li><strong> Tiene Pareja estable: </strong>   <?php echo $preg_sexo['tiene_pareja']; ?>. </li>
		<li><strong> Usa preservatico: </strong>   <?php echo $preg_sexo['usa_condon']; ?>.</li>
	    <li><strong> Ha realizado Antigeno prostatico: </strong>   <?php echo $preg_sexo['antigeno']; ?>.</li>
	    <?php 
	    	if ($preg_sexo['antigeno']=='si') 
	    	{?>
	    		<li><strong> Cuando: </strong>   <?php echo $preg_sexo['fecha']; ?>.</li>
	    		<li><strong> Resultado: </strong>   <?php echo $preg_sexo['antigeno_result']; ?>.</li>
	   <?php 
	    	}
	   	} 	
	} ?>	
	</div>
</div>
					


<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	</div> <!-- FIN DE tab-content -->

</div> <!-- FIN DE .TABBABLE -->


</div><!-- fin de widget-content -->

</div> <!-- fin de widget-content -->

</div> <!-- FIN DE .CONTAINER -->
<?php include("modal_edit_paciente.php"); ?>
<script type="text/javascript" src="ajax.js"></script>


<script type="text/javascript" src="../../../js/chosen.jquery.js"></script>

	<script type="text/javascript">

	jQuery(document).ready(function(){
		jQuery(".chosen").chosen();
		jQuery(".chosen").data("placeholder","Seleccione los procedimientos que indicara al paciente.").chosen();
	});

	
</script>




<script type="text/javascript">
	$(document).ready(function(){
		$('.tip-diag').tooltip();
		$('.tip').tooltip();
	});
</script>

<script src="nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		new nicEditor({fullPanel : true, maxHeight : 400}).panelInstance('area1');
		new nicEditor({fullPanel : true, maxHeight : 400}).panelInstance('area2');
	});
</script>

<script type="text/javascript">
  $(function(){
  $("#productos").change(function() {
    $("#checkthis").toggleClass("complete", this.checked)
  }).change();
})
	
</script>

<script type="text/javascript">
$(document).ready(function(){	
	$('.delete-proc').click(function(){
        //Recogemos la id del contenedor padre
        var parent = $(this).parent().attr('id');
        //Recogemos el valor del servicio
        var service = $(this).parent().attr('data');

        var dataString = 'id='+service;

        $.ajax({
            type: "POST",
            url: "../../PHP/especialista/delete-proc.php",
            data: dataString,
            success: function() {            
                $('#delete-proc-ok').empty();
                $('#delete-proc-ok').append('<div> <span class="label label-danger" >Se ha eliminado correctamente el procedimiento con id='+service+'.</span></div>').fadeIn("slow");
                $('#'+parent).remove();
            }
        });
    });
}); 
</script>
<script src="../../../js/autocomplete.jquery.js"></script>
        
<script>
    $(document).ready(function(){
        /* Una vez que se cargo la pagina , llamo a todos los autocompletes y
         * los inicializo */
        $('.autocomplete').autocomplete();
    });
</script>

<script type="text/javascript">
 function showRegalo() {
     element = document.getElementById("content2");
     obsequio = document.getElementById("obsequio");
     check = document.getElementById("date2");
     if (check.checked) {
         element.style.display='block';
         obsequio.setAttribute('required','required'); //atributo y valor
        }
     else {
         element.style.display='none';
         obsequio.removeAttribute('required');
     }
 }
 </script>