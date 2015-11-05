<?php 
require("../../header2.php");
$paciente_id = $_GET['paciente'];
?>

<div class="container">
	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Queremos conocer tu salud para ayudarte mejor.</small>
	</h1>

	<div class="panel panel-default">
		<div class="panel-heading">
		    <h3 class="text-center">Operaciones Realizadas:</h3>
		    <div class="progress ">
		      <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
		        30%
		      </div>
		    </div>
		</div>

		<div class="panel-body">
			<div class="row">
				<h3 class="text-center"></h3>
				<?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['reanuda'])) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sus datos personales ya estan registrados. Por favor ingrese los datos medicos faltantes en su registro. </strong>
                    </div>
                <?php } ?>
				<form  role="form" class="form" action="../../PHP/paciente/registra_operaciones.php" method="POST">
					<input type="hidden" name="paciente_id" value="<?php echo $paciente_id;?> ">
				<div class="col-xs-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="ayuda text-danger col-lg-12">
							<p style="padding-left:12px"><i class="fa fa-info-circle"></i>
								Llene los datos de las operaciones que se ha realizado, de no haberse realizado ninguna puede omitir este paso. 
							</p><hr>
						</div>

						<div id="contenedor" class="">
							<div class="form-group col-xs-12 col-md-6 col-lg-4" id="content">
							    <label> ¿De que ha sido Operado?</label>
							    <input class="form-control input-lg" type="text" name="de-que[]" required placeholder="Operacion 1">					    
							</div>

							<div class="form-group col-xs-12 col-md-6 col-lg-4">
								<label> ¿En que fecha fue Operado?</label>
								<input class="form-control input-lg" type="date" id="datepicker" name="fecha[]" required>
							</div>
							<div class="form-group col-xs-12 col-md-6 col-lg-4">
								<label></label>
								<a href="#" id="agregarCampo" class="btn btn-lg"><i class="fa fa-plus"></i> Agregar Mas</a>
								<br>
							</div>
						</div>

						
					</div>
				</div>

			</div>
		</div>

		<div class="panel-footer">
			<a href="antec-familiar.php?paciente=<?php echo $paciente_id; ?>" class="btn btn-default btn-lg">Omitir</a>
			<button type="submit" class="btn btn-success btn-lg">Guardar y Continuar</button>
		</div>
	</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	
	$(document).ready(function() {

	    var MaxInputs       = 10; //Número Maximo de Campos
	    var contenedor       = $("#contenedor"); //ID del contenedor
	    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

	    //var x = número de campos existentes en el contenedor
	    var x = $("#contenedor div").length + 1 - 2;
	    var FieldCount = x-1; //para el seguimiento de los campos

	    $(AddButton).click(function (e) {
	        if(x <= MaxInputs) //max input box allowed
	        {
	            FieldCount++;
	            //agregar campo
	            $(contenedor).append('<div class="col-lg-12"><div class="form-group col-xs-12 col-md-6 col-lg-4"><input class="form-control input-lg" type="text" name="de-que[]" required placeholder="Operacion '+ FieldCount +'"></div><div class="form-group col-xs-12 col-md-6 col-lg-4"><input class="form-control input-lg" id="datepicker" type="date" name="fecha[]" required></div><a href="#" class="eliminar btn-lg"><i class="fa fa-times"></i></a></div><hr>');
	            x++; //text box increment
	        }
	        return false;
	    });

	    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
	        if( x > 1 ) {
	            $(this).parent('div').remove(); //eliminar el campo
	            x--;
	        }
	        return false;
	    });
	});
</script>