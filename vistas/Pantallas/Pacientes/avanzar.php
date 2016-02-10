<?php $id = $_GET['paciente']; ?>
<?php require("../../header2.php"); ?>
<div class="container">

	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Queremos conocer tu salud para ayudarte mejor.</small>
	</h1>

	<div class="panel-default panel">
		<div class="panel-heading">
			<h4><i class="fa fa-user "></i> Registro de Pacientes</h4>
		</div>

		<div class="panel-body">
			<div class="text-center">
				<i class="fa  fa-thumbs-o-up fa-5x"></i>
				<h3>Gracias por registrarte.</h3>
				<p>Presiona en <strong>continuar</strong> si deseas llenar tus datos medicos ahora o <strong>Continuar luego</strong> si deseas hacerlo en otro momento.</p> 
				<br>
				<a class="btn btn-default btn-lg" href="index.php">Continuar luego</a>
				<a class="btn btn-success btn-lg" href="antecedente_personales.php?paciente=<?php echo $id; ?>">Continuar</a>
			</div>
		</div>

		<div class="panel-footer">
			<div class="">
				
			</div>
		</div>

	</div>
</div>
</body>
</html>