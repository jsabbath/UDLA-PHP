

		<div class="row-fluid">
		<!-- ////// DATOS PERSONALES DE PACIENTE ///////// -->
			<div class="span1">
				<img src="../../../img/avatar.jpg" class="img-responsive img-circle" width="80px">				
			</div>
			<div class="span4 primera">
				<strong>Nombre y Apellido: </strong> <?php echo $paciente['nombre_completo']; ?> <br>
				<strong>Cedula:</strong> <?php echo $paciente['cedula']; ?> <br>
				<strong>Telefono:</strong> <?php echo $paciente['telefono']; ?> <br>
				<small><strong>Correo:</strong> <?php echo $paciente['email']; ?> </small>

			</div>

			<div class="span3 sengunda">
				<strong>Edad:</strong> <?php echo calculaedad($paciente['fecha_nacimiento']); ?>  <br>
				<strong>Sexo:</strong> <?php echo $paciente['sexo']; ?> <br>
				<strong>Ocupación:</strong> <?php echo $paciente['ocupacion']; ?> <br>
				<strong> Paciente desde: </strong><?php echo calcular_fechas($paciente['created_at']); ?> 
			</div>
			<div class="span4 tercera">
				<strong>Estado Civil: </strong><?php echo $paciente['estado_civil']; ?> <br>
                <strong>Dirección:</strong> <?php echo $paciente['direccion'].", ".$paciente['ciudad'].". ".$paciente['estado']; ?>  <br>
                <strong>Nos conocio a traves de: </strong><?php echo $paciente['remitido']; ?> <br>
                <a href="#edit_paciente" role="button" class="btn-link" data-toggle="modal"><i class="icon-edit"></i> Editar datos</a>
            </div>

		</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<hr>

		<div class="row-fluid">
		<!-- /////////// MUESTRA LAS ALERTAS REGISTRADAS ///////// -->
			<div class="span6">
				<div class="alert alert-error paciente">
					<button type="button" class="close" data-dismiss="alert" title="Cerrar Alertas">x</button>
					<a href="#myModalalertas" role="button" data-toggle="modal" class="btn btn-default alertas"><i class="icon-plus"></i> Nueva alerta</a>					
					<?php
						$tabla_alertas = mysql_query("SELECT * FROM alertas WHERE id_paciente = '".$paciente['id']."'");
					?>
					<div id="delete-ok"></div>
					<?php while($alertas = mysql_fetch_assoc($tabla_alertas)){ ?>
						<?php if ($alertas['contenido']=='') {
						}else { ?>
							<div class="list-alert box-alertas" id="<?php echo  $alertas['id']; ?>" data="<?php echo  $alertas['id']; ?>">
								
								<strong><?php echo  $alertas['fecha'].": ".$alertas['contenido']; ?></strong>
								<a href="" class="delete-alert btn btn-default pull-right" title="Eliminar" id="<?php echo  $alertas['id']; ?>"><i class="icon-remove"></i></a>
							</div>						
					<?php }
						} ?>				
				</div>
			</div>

		<!-- /////////// MUESTRA LOS MOTIVOS REGISTRADOS ///////// -->
			<div class="span6">
				<div class="alert alert-success paciente"><button type="button" class="close" data-dismiss="alert" title="Cerrar Motivos" >x</button>
				<a href="#myModalmotivo" role="button" data-toggle="modal" class="btn btn-default alertas"><i class="icon-plus"></i> Motivo de consulta</a>
					<?php
						$tabla_motivo = mysql_query("SELECT * FROM consulta_motivo WHERE paciente_id = '".$paciente['id']."'");
					?>

					<?php while($motivo_c = mysql_fetch_assoc($tabla_motivo)){ ?>
						<?php if ($motivo_c['contenido']=='') {

						}else { ?>
							<div class="list-alert box-alertas" id="<?php echo $motivo_c['id'];?>" data="<?php echo $motivo_c['id'];?>" >
								<strong><?php echo $motivo_c['fecha'].":  ".$motivo_c['contenido']; ?></strong>
								<a href="" class="delete-motivo btn btn-default pull-right" title="Eliminar" id="<?php echo $motivo_c['id'];?>"><i class="icon-remove"></i></a>
							</div>
							
					<?php }
						} ?>
				</div>
			</div>
		</div> <!-- fin row-fluid -->
		
		<!-- /////////////// observaciones /////////////////////////// -->
		<div class="">
			<div class="row-fluid">
				<div class="span12">
					<form name="form_obs" onsubmit="enviarObs(); return false">
						<input type="hidden" name="paciente_id" value="<?php echo $paciente['id'];?> ">
						<div class="control-group ">
							<label class="control-label" for=""> <strong> Observacion General: </strong></label>
							<div class="controls">
								<textarea name="observacion_general" rows="4" class="form-control span12 obs-width" required></textarea>
							</div> <!-- /controls -->
						</div>
						<button name="add-obs" class="btn btn-default pull-right"><i class="icon-plus"></i> Agregar Observación</button>
					</form>
					<div class="span9" id="respuesta-obs">
						<?php include("../../PHP/especialista/consulta_obs.php"); ?>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<!-- ////// MODAL ALERTASSS ///////// -->
			<div id="myModalalertas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
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
					</form>
				</div>
			</div>

		<!-- ////// MODAL MOTIVO CONSULTA //////// -->
			<div id="myModalmotivo" name="motivo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel"><i class="icon-plus"></i> Agregar nuevo motivo de consulta para el paciente <?php echo $paciente['nombre_completo']; ?> </h3>
				</div>
				<div class="modal-body">
					<form role="form" method="POST" action="../../PHP/especialista/registrar_motivo.php?paciente=<?php echo $paciente['id']; ?>">

					<div class="control-group">
						<label class="control-label" for="">Cual es el Motivo?</label>
						<div class="controls">
							<textarea type='text' name="motivo" class="form-control alerta"></textarea>
						</div> <!-- /controls -->
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
					<button name="modal" type="submit" class="btn btn-primary">Guardar</button>
					</form>
				</div>
			</div>


<!-- /////// Script para eliminar alertass con ajax ////////////-->

<script type="text/javascript">
$(document).ready(function() {

    $('.delete-alert').click(function(){
        //Recogemos la id del contenedor padre
        var parent = $(this).parent().attr('id');
        //Recogemos el valor del servicio
        var service = $(this).parent().attr('data');

        var dataString = 'id='+service;

        $.ajax({
            type: "POST",
            url: "../../PHP/especialista/delete-alert.php",
            data: dataString,
            success: function() {            
                $('#delete-ok').empty();
                $('#delete-ok').append('<div>Se ha eliminado correctamente la alerta con id='+service+'.</div>').fadeIn("slow");
                $('#'+parent).remove();
            }
        });
    });

    $('.delete-motivo').click(function(){
        //Recogemos la id del contenedor padre
        var parent = $(this).parent().attr('id');
        //Recogemos el valor del servicio
        var service = $(this).parent().attr('data');

        var dataString = 'id='+service;

        $.ajax({
            type: "POST",
            url: "../../PHP/especialista/delete-motivo.php",
            data: dataString,
            success: function() {            
                $('#delete-motivo-ok').empty();
                $('#delete-motivo-ok').append('<div>Se ha eliminado correctamente el motivo de cita con id='+service+'.</div>').fadeIn("slow");
                $('#'+parent).remove();
            }
        });
    }); 

                       
});    
</script>