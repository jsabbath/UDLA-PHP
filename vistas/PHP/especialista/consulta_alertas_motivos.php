	<br>
		<div class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">x</button>
		  <?php 
        	$tabla_alertas = mysql_query("SELECT * FROM alertas WHERE id_paciente = '".$paciente['id']."'");
		?>
										
		<?php while($alertas = mysql_fetch_assoc($tabla_alertas)){ ?>
			<?php if ($alertas['contenido']=='') {
			
			}else { ?>
				<strong><?php echo  $alertas['fecha'].": ".$alertas['contenido']; ?></strong><br>
		<?php }
			} ?>
	
	<a href="#myModalalertas" role="button" data-toggle="modal" class="btn btn-default alertas"><i class="icon-plus"></i>Nueva alerta</a>
							

    <div id="myModalalertas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<h3 id="myModalLabel"><i class="icon-plus"></i> Agregar nueva alerta para el paciente <?php echo $paciente['nombre_completo']; ?> </h3>
      	</div>
      	<div class="modal-body">	
      		<form role="form" method="POST" action="registrar_alertas.php?paciente=<?php echo $paciente['id']; ?>">

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

</div>
<hr>
		


<div class="alert alert-success paciente"><button type="button" class="close" data-dismiss="alert">x</button>
		 <?php 
        	$tabla_motivo = mysql_query("SELECT * FROM consulta_motivo WHERE paciente_id = '".$paciente['id']."'");
		?>
										
		<?php while($motivo_c = mysql_fetch_assoc($tabla_motivo)){ ?>
			<?php if ($motivo_c['contenido']=='') {
			
			}else { ?>
				<strong><?php echo $motivo_c['fecha'].":  ".$motivo_c['contenido']; ?></strong><br>
		<?php }
			} ?>
	
	<a href="#myModalmotivo" role="button" data-toggle="modal" class="btn btn-default alertas"><i class="icon-plus"></i>Motivo de consulta</a>
							

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

</div>
<hr>