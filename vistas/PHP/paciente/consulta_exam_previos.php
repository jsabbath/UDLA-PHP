<?php 

$consulta = mysql_query("SELECT * FROM examenes WHERE paciente_id = '{$paciente_id}' ");

if(mysql_num_rows($consulta) > 0 )
{ ?>
	<h4>Examenes registrados:</h4>
	<small>Puede ingresar mas de un examen, repita los mismo pasos.</small> <br>
	<?php
	while ($ant = mysql_fetch_assoc($consulta)) { ?>
		
		<ul>
			<li> <?php echo $ant['examen'] ?>, lo realizo hace: <?php echo $ant['hace_cuanto']; ?>. </li>
		</ul>

<?php }
}
else
{
	echo "Aun no has realizado ningun registro.";
}
?>