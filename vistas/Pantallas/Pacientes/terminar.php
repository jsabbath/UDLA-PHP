<?php session_start();
include("../../header2.php");
 ?>

<div class="container">
	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Queremos conocer tu salud para ayudarte mejor.</small>
	</h1>

	<div class="panel-default panel">
		<div class="panel-heading sombra">
			<h4 class="text-center">Progreso</h4>
			<div class="progress ">
			  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
			    100%
			  </div>
			</div>
		</div>

		<div class="panel-body">
			<div class="text-center">
				<i class="fa fa-check-square-o fa-5x"></i>
				<h1>Recaudación Completa.! Gracias por su Tiempo.</h1>

			</div>
		</div>

		<div class="panel-footer">
			<div class="">
			<?php if(isset($_SESSION['id_nivel']))
			{
				if ($_SESSION['id_nivel']==3) 
				{
					header("Location: ../../Pantallas/Recepcion/inicio.php");
				}	
			}
			else
			{?>
				<a class="btn btn-success btn-lg" href="index.php">Finalizar</a>
			<?php } ?>
			
			</div>
		</div>

	</div>
</div>
</body>
</html>