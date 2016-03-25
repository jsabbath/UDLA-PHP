<?php 
	$consulta_parte = mysql_query("SELECT * FROM ajustes_partescuerpo ORDER BY parte ASC");
	$n = 1;
	while ($parte = mysql_fetch_assoc($consulta_parte)) { ?>
		
		<tr>
			<td><?php echo $n; $n++; ?></td>
			<td><?php echo $parte['parte']; ?></td>
			<td>
				<button class="btn btn-danger btn-small" onclick="deleteParte('<?php echo $parte['id']; ?>');">Eliminar</button>
			</td>
		</tr>
	

	<?php } ?>