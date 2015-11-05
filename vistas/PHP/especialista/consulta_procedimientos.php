<div id="delete-proc-ok"></div>
<?php 
	$proc_cabina = mysql_query("SELECT * FROM tratamientos 
		WHERE paciente_id = '{$id}' AND paquete_id = '{$paquete_id}' AND tipo = 'cabina' ");

	while ($lista_cabina = mysql_fetch_assoc($proc_cabina)) { ?>
	
		<div class="list-alert box-alertas" id="<?php echo  $lista_cabina['id']; ?>" data="<?php echo  $lista_cabina['id']; ?>">
			 <?php echo $lista_cabina['nombre']; ?> 
			<a href="#" class="delete-proc btn btn-default pull-right" title="Eliminar Procedimiento" id="<?php echo  $lista_cabina['id']; ?>"><i class="icon-remove"></i></a>
			
		</div>

<?php } ?>
<br>
<?php 
	if(mysql_num_rows($proc_cabina) > 0){ ?>
	
	<a href="../../PHP/especialista/nuevo_paquete.php?on=update&paciente=<?php echo $id;?>&paquete=<?php echo $paquete_id?>" class="btn btn-success">Cerrar Paquete</a>

<?php } ?>
