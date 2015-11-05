<?php require("../../header2.php"); ?>
<div class="container">

	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Queremos conocer tu salud para ayudarte mejor.</small>
	</h1>

	<div class="panel-default panel">
		<div class="panel-heading sombra">
			<h4><i class="fa fa-search-plus"></i> Verificación de Paciente Nuevo</h4>
		</div>

		<div class="panel-body">
			<div class="row center-block">
				<div class="col-lg-5 center ">
					<form method="POST" id="default-behavior" action="../../PHP/paciente/verificar.php" class="form-inline">
						<div class="form-group">
						    <label for="cedula" class="sr-only">Cedula</label>
						    <select name="ci" class="form-control" maxlength="3" required>
						    	<option>V</option>
						    	<option>E</option>
						    	<option>P</option>
						    </select>
						    <input type="text" class="form-control" name="cedula" placeholder="Cedula" autofocus pattern="^[0-9.-]{7,10}$" title="Debe ingresar mas de 7 numeros" required>
						</div>
						  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Buscar</button>
						  <span id="helpBlock" class="help-block">Ingrese su numero de cedula para verificar si ya esta registrado.</span>
						  <p>Recuerde si usted es un paciente menor de edad y aun no posee cedula debe ingresar la cedula de su representante seguida de un guion y un numero correspondiente a la cantidad de representados por dicha persona.
						  Ejemplo: V-16123456-1
						  </p>
					</form>
					<?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> <?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
				</div>
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
<script type="text/javascript">
	$('#default-behavior').ketchup();
</script>