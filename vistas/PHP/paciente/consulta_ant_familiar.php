<?php 

$consulta = mysql_query("SELECT * FROM antecedentes_familiares WHERE paciente_id = '{$paciente}' ");

if(mysql_num_rows($consulta) > 0 )
{ ?>
	<h4>Antecedentes registrados:</h4>
	<small>Puede ingresar mas de un antecedente, repita los mismo pasos.</small>
	<?php
	while ($ant = mysql_fetch_assoc($consulta)) { ?>
		
		<ul>
			<li> <?php echo $ant['enfermedad'] ?>, padecido por: <?php echo $ant['parentesco']; ?> </li>
		</ul>

<?php }
}
else
{
	echo "Aun no has realizado ningun registro.";
}
?>