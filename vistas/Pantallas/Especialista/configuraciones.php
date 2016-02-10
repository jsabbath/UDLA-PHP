<?php 
$header=1;
$activo=10;
require('../../header.php');?>


<div class="container">
	<div class="row">
		<div class="span12">
			<center> <br> <h2>Ajustes del Sistema </h2>
			<small>Maneje aqui informacion de importancia para el uso del sistema.</small>
			 <br> <br>
			 </center>
		</div>
	<!-- 	//////////////// PANEL DATOS DE PERSONAL //////////////////////////// -->
		<div class="span6">
			<div class="widget">
				<div class="widget-header">
					<i class="icon-group"></i> <h3>Datos de Personal</h3>
					<button type="button" onclick="Nuevo();" class="btn btn-inverse centrar-btn pull-right">Nuevo Registro</button>
				</div>
				<div class="widget-content">
					<?php
						//consultamos la tabla para listar el personal registrado
						$personal = mysql_query("SELECT * FROM porcentaje"); 
						$nro = 1;
					?>
					<table class="table table-hover table-condensed datatables" id="datatables1">
						<thead>
							<tr>
								<th>N°</th>
								<th>Nombre</th>
								<th>Porcentaje</th>
								<th>Estado</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								// recorremos el array con resultados de la consulta
								while ($pers = mysql_fetch_assoc($personal)) { ?>
									<tr>
										<td><?php echo $nro; $nro++; ?></td>
										<td><?php echo $pers['nombre']; ?></td>
										<td><center> <?php echo $pers['dividendo']; ?></center></td>
										<td>
										<?php 
											if($pers['status'] == "Activo"){ ?>
												<span class="label label-success">Activo</span>
											<?php }
											else if($pers['status'] == "Inactivo")
											{ ?>		
												<span class="label label-default">Inactivo</span>
											<?php } ?>											
										</td>
										<td>
											<div class="btn-group">
											  <button class="btn btn-info dropdown-toggle btn-small" data-toggle="dropdown">
											    Selecciona
											    <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu">
											  	<li><a onclick="Editar('<?php echo $pers['id']; ?>', '<?php echo $pers['nombre']; ?>', '<?php echo $pers['dividendo']; ?>', '<?php echo $pers['status']; ?>');" title="" class="font-normal">Editar</a></li>
											    <li><a onclick="Eliminar('<?php echo $pers['id']; ?>');" title="" class="font-normal">Eliminar</a></li>
											   </ul>
											</div>
										</td>
									</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- 	//////////////// PANEL ARTES DEL CUERPO //////////////////////////// -->
		<div class="span6">
			<div class="widget">
				<div class="widget-header">
					<i class="icon-group"></i> <h3>Partes del Cuerpo</h3>
				</div>
				<div class="widget-content">
					
					<form action="" role="form" name="fmPartes" onsubmit="addPartes(); return false" accept-charset="utf-8" class="form-horizontal">
						<div class="input-append">
						  <input class="span3" name="parte" type="text">
						  <button class="btn" type="submit">Registrar</button>
						</div>					
					</form>
					<hr>
					<table class="table table-hover table-condensed datatables">
						<thead>
							<tr>
								<th>#</th>
								<th>Parte del cuerpo</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody id="resultado-partes">
							<?php include("../../PHP/especialista/consulta_partes.php"); ?>
						</tbody>
					</table>
				</div>
				<div class="widget-footer">
					
				</div>
			</div>
		</div>
	<!-- 	//////////////// PANEL DATOS DE PROCEDIMIENTOS //////////////////////////// -->
		<div class="span12">
			<?php include("procedimientos.php"); ?>
		</div>


	</div> <!-- CIERRA ROW -->
</div> <!-- CIERRA CONTAINER -->


 
<!-- /////////////////////// Modal Personal ///////////////////////////////////////////-->
<div id="modalPersonal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Registro de Personal</h3>
  </div>
  <div class="modal-body">
    <form role="form" action="" name="fmPerso" onsubmit="Registrar(idp, accion); return false" accept-charset="utf-8">
    	<div class="form-group">
    		<label>Nombre:</label>
    		<input type="text" name="nombre" placeholder="" required>
    	</div>

    	<div class="form-group">
    		<label>Porcentaje:</label>
    		<input type="text" name="porcentaje" placeholder="" required>
    	</div>

    	<div class="form-group">
    		<label>Estado</label>
    		<select name="stado" class="form-control" required>
    			<option value="">Seleccione</option>
    			<option value="Activo">Activo</option>
    			<option value="Inactivo">Inactivo</option>
    		</select>
    	</div>
   
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
  </div>
</div>



<script src="../../../datatables/jquery.dataTables.js"></script>
<script src="../../../js/ajaxPersonal.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
  		$('.datatables').dataTable();
	});

	function modalAdd(){
		$('#myModalAdd').modal('show');
	}

</script>