<?php 

$consulta = mysql_query("SELECT * FROM tratamientos_previos WHERE paciente_id = '{$paciente_id}' ");

if(mysql_num_rows($consulta) > 0 )
{ ?>
	<h4>Tratamientos registrados:</h4>
	<small>Puede ingresar mas de un tratamiento, repita los mismo pasos.</small> <br>
	<?php
	while ($ant = mysql_fetch_assoc($consulta)) { ?>
		
		<ul>
			<li> <?php echo $ant['tratamientos'] ?>, motivo: <?php echo $ant['motivo']; ?>. </li>
		</ul>

<?php }
}
else
{
	echo "Aun no has realizado ningun registro.";
}
?>