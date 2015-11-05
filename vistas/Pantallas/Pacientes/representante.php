<?php 
require("../../header2.php");
include "../../config/datos.php";
$paciente_id = $_GET['paciente'];
$header = 5;
//require('../../header.php');
?>

<div class="container">

	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Ingresa tus datos para conocer mas de Ti.</small>
	</h1>
	<div class="panel panel-default">
		<div class="panel-heading">
				<h4 class="text-center">Progreso</h4>
				<div class="progress ">
				  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
				    0%
				  </div>
				</div>
		</div>

		<div class="panel-body">
			<div class="row">
                <?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
                
				<form role="form" class="form" action="../../PHP/paciente/registra_representante.php" method="POST">
                <h3 class="text-center">Datos del Representante</h3>

                <div class="col-xs-12 col-md-6 col-lg-5"> <!--INICIA COLUMNA IZQUIERDAA -->
                <input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                	  <input class="form-control input-lg" type="text" name="nombre" placeholder="Nombre" required>
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  
                	  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                	  <input class="form-control input-lg" type="text" name="cedula" pattern="^[0-9.-]{7,10}$" title="Debe ingresar mas de 7 numeros" required placeholder="Cedula">
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                	  <input class="form-control input-lg" type="email" name="email" placeholder="Correo Electronico">
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                	  <select class="form-control input-lg" name="parentesco" required>
                	  	<option value="" selected>Parentesco</option>
                	  	<option>Padre</option>
                        <option>Madre</option>
                        <option>Hermano(a)</option>
                        <option>Tio(a)</option>
                        <option>Abuelo(a)</option>
                        <option>Primo(a)</option>
                	  </select>
                	</div>
                    

                    
                </div> <!--FIN COLUMNA IZQUIERDA -->

                <div class="col-xs-hidden col-md-6 col-lg-2"> 
                </div>

                <div class="col-xs12 col-md-6 col-lg-5"> <!--INICIA COLUMNA DERECHAA -->

                                	
                    <div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></i></span>
                	  <input class="form-control input-lg" type="text" name="ocupacion" placeholder="Ocupacion">
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                	  <input class="form-control input-lg" type="text" name="telefono" placeholder="Numero de Telefono">
                	</div>

                
                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                	  <textarea class="form-control input-lg" type="text" name="direccion" placeholder="Direccion"></textarea>
                	</div>
		
                </div> <!--FIN COLUMNA DERECHAA -->

			</div>	
		</div>

		<div class="panel-footer">
			<div class="">
					<button class="btn btn-success btn-lg" name="perfil" type="submit">Continuar</button>
			</div>
		</div>
	</div>
</div>


</body>
</html>
