<?php 

$consulta = mysql_query("SELECT * FROM antecedentes_personales WHERE paciente_id = '{$paciente_id}' ");

if(mysql_num_rows($consulta) > 0 )
{ ?>
<hr>
	<h4>Antecedentes registrados:</h4>
	
	<?php
	while ($ant = mysql_fetch_assoc($consulta)) { ?>
		
		<ul>
			<li> <p> <?php echo $ant['enfermedad']; ?> <?php if($ant['cual_derma'] != "") { echo ": ".$ant['cual_derma'];} ?>   , padecido hace: <?php echo $ant['hace_cuanto']; ?> </p></li>
		</ul>

<?php }
}
