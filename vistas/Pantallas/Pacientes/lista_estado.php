<?php 
require("../../header2.php");
include "../../config/datos.php";
$consulta = mysql_query("SELECT * 
FROM  pacientes
WHERE ciudad LIKE  '%Leche%' ");

?>
<div class="container">
<h1>Listado pacientes del estado Anzoátegui.</h1>
<table class="table">
		<tr>
			<th>Nro</th>
			<th>Nombre y Apellido</th>
			<th>Cedula</th>
			<th>Telefono</th>
			<th>Ciudad</th>
			<th>Direccion</th>
		</tr>
<?php 
$nro = 0;
while ($list = mysql_fetch_assoc($consulta)) { $nro++; ?>

		<tr>
		<td><?php echo $nro; ?></td>
			<td><?php echo $list['nombre_completo']; ?></td>
			<td><?php echo $list['cedula']; ?></td>
			<td><?php echo $list['telefono']; ?></td>
			<td><?php echo $list['ciudad']; ?></td>
			<td><?php echo $list['direccion']; ?></td>
		</tr>

<?php } ?>

</table>
</div>