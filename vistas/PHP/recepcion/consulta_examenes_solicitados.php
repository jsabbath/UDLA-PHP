<?php
	$tab_examenes = mysql_query("SELECT created_at FROM examenes_solicitados GROUP BY created_at, paciente_id HAVING paciente_id = '{$id}' ORDER BY created_at DESC ") ;
	$filas = mysql_num_rows($tab_examenes);
	if($filas > 0) 
	{
		while ($examenes=mysql_fetch_assoc($tab_examenes)) 
		{ ?>		
			<div class="diagnostico fecha">
				<ul> 
				<li class="fecha"><strong>Fecha: </strong> <?php echo $examenes['created_at']; ?></li> 
				<?php
				$exam = mysql_query("SELECT * FROM examenes_solicitados WHERE created_at = '{$examenes['created_at']}' AND paciente_id = '{$id}' ");
				?>
                <div class="box-diagnosticos">											
					<ul>
					<?php
					while ($exam_data = mysql_fetch_assoc($exam)) 
					{ ?>					
							<?php if ($exam_data['examenes'] != "") { ?>
								<li> <p> <?php echo $exam_data['examenes']; ?> </p></li>
							<?php } ?>															 	
					<?php 
					} 
					?>
					</ul>
				</div>
				</ul>
			</div>
	<?php 
		}
	} 
	else 
	{ ?>
	<strong> No Existen diagnosticos anteriores para este paciente.</strong>
	<?php 
	} 
	?>
