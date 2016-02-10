
<?php if (isset($_GET['msg'])) 
	{
        $msg= $_GET['msg']; ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo $msg; ?> </strong>
        </div>
<?php 
	} ?>


<?php
	$tab_diagnosticos = mysql_query("SELECT created_at FROM diagnosticos GROUP BY created_at, paciente_id HAVING paciente_id = '{$id}' ") ;
	$filas = mysql_num_rows($tab_diagnosticos);
	if($filas > 0) 
	{ ?>
		<ul> 
		<?php
		while ($diagnostico=mysql_fetch_assoc($tab_diagnosticos)) 
		{ ?>		
			<div class="diagnostico fecha">
				
					<li class="fecha"><strong>Fecha: </strong> <?php echo $diagnostico['created_at']; ?></li> 
					<?php
					$diag = mysql_query("SELECT * FROM diagnosticos WHERE created_at = '{$diagnostico['created_at']}' AND paciente_id = '{$id}' ");
					?>
                	<div class="box-diagnosticos">											
				
						<?php
						while ($diag_data = mysql_fetch_assoc($diag)) 
						{ ?>				
						    <a href="#" class="tip-diag link-tip btn btn-mini" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $diag_data['detalle']; ?>"><?php echo $diag_data['diagnostico']; ?> </a>
						 	
						<?php 
						} ?>
										
					</div> 
			 	 
			</div>
		<?php 
		} ?>
		</ul>	
	<?php } 
	else 
	{ ?>
		<strong> No Existen diagnosticos anteriores para este paciente.</strong>
	<?php 
	} ?>


							

   



