<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
	$id = $_POST['id_procts'];
	$precio = $_POST['monto'];
?>


<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="widget">
			<div class="widget-header">
				<strong>Pagos Registrados</strong>
			</div>
			<div class="widget-content">
				
			</div>
			</div>
		</div>
	</div>
</div>