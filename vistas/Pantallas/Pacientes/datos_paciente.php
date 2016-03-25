<?php require("../../header2.php"); ?>
<?php
include "../../config/datos.php";
$header = 5;
//require('../../header.php');
$ced = isset($_GET['ced'])?$_GET['ced']: ""; 
?>

<div class="container">

	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Ingresa tus datos para conocer mas de Ti.</small>
	</h1>
	<div class="panel panel-default">
		<div class="panel-heading">
				<h4 class="text-center">Informaciòn Personal</h4>
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
                <?php if (isset($_GET['reanuda'])) {
                    $id= $_GET['paciente']; 
                    $sql = mysql_query("SELECT * FROM pacientes WHERE id ='{$id}'  LIMIT 1 ");
                    $datos = mysql_fetch_array($sql);
                 
                ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Por favor ingrese los datos faltantes en su registro. </strong>
                    </div>
                <?php } ?>
				<form role="form" class="form" action="../../PHP/paciente/registra_paciente.php" method="POST">
                <h3 class="text-center"></h3>

                <div class="col-xs-12 col-md-6 col-lg-5"> <!--INICIA COLUMNA IZQUIERDAA -->
                <?php if (isset($_GET['reanuda'])){ ?>
                        <input type="hidden" name="paciente_id" value="<?php echo $datos['id'];?>" >
                        <div class="input-group margin-bottom-sm form-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control input-lg" type="text" name="nombre_completo" placeholder="Nombres" <?php if (isset($_GET['reanuda'])){echo 'value="'.$datos['nombre_completo'].'"'. ' readonly';} ?> required>
                        </div>
                   <?php } else{ ?>
                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                	  <input class="form-control input-lg" type="text" name="nombre_completo" placeholder="Nombres" required>
                	</div>

                    <div class="input-group margin-bottom-sm form-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input class="form-control input-lg" type="text" name="apellidos" placeholder="Apellidos" required>
                    </div>
                    <?php } ?>
                	<div class="input-group margin-bottom-sm form-group">
                	  
                	  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                	  <input class="form-control input-lg" type="text" name="cedula" value="<?php if (isset($_GET['reanuda'])){echo $datos['cedula'];}else{echo $ced;} ?>" readonly>
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                	  <input class="form-control input-lg" type="text" name="email" placeholder="Correo Electronico">
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-calendar"> Fecha de N.</i></span>
                	  <input class="form-control input-lg" type="text" id="datepicker" name="fecha_nacimiento" placeholder="Fecha Nacimiento" required>
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                	  <select class="form-control input-lg" name="sexo" required>
                	  	<option value="" selected>Sexo</option>
                	  	<option>Masculino</option>
                	  	<option>Femenino</option>
                	  </select>
                	</div>

                    <div class="input-group margin-bottom-sm form-group">
                      <span class="input-group-addon"><i class="fa fa-male"></i><i class="fa fa-female"></i></span>
                      <select class="form-control input-lg" name="estado_civil" >
                        <option value="" selected>Estado Civil</option>
                        <option>Soltero(a)</option>
                        <option>Casado(a)</option>
                        <option>Divorciado(a)</option>
                        <option>Viudo(a)</option>
                      </select> 
                    </div>
                </div> <!--FIN COLUMNA IZQUIERDA -->

                <div class="col-xs-hidden col-md-6 col-lg-2"> 
                </div>

                <div class="col-xs12 col-md-6 col-lg-5"> <!--INICIA COLUMNA DERECHAA -->
                	
                    <div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></i></span>
                	  <input class="form-control input-lg" type="text" name="ocupacion" placeholder="Ocupacion" >
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                	  <input class="form-control input-lg" type="text" name="telefono" pattern="^[0-9]{11}$" title="Debe agregar solo numeros de 11 digitos" placeholder="Numero de Telefono" <?php if (isset($_GET['reanuda'])){echo 'value="'.$datos['telefono'].'"'. ' readonly';} ?> required>
                	</div>

                    <div class="input-group margin-bottom-sm form-group">
                      <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
                      <select class="form-control input-lg" name="estado" required>
                        <option value="" selected>Estado</option>
                        <option>Amazonas</option><option>Anzoátegui</option><option>Apure</option>
                        <option>Aragua</option> <option>Barinas</option><option>Bolívar</option>
                        <option>Carabobo</option><option>Cojedes</option><option>Delta Amacuro</option>
                        <option>Distrito Federal</option> <option>Falcón</option><option>Guárico</option> 
                        <option>Lara</option><option>Mérida</option><option>Miranda</option>
                        <option>Monagas</option><option>Nueva Esparta</option><option>Portuguesa</option>
                        <option>Sucre</option><option>Táchira</option><option>Vargas</option>
                        <option>Yaracuy</option><option>Zulia</option>
                      </select>
                    </div>

                    <div class="input-group margin-bottom-sm form-group">
                      <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></i></span>
                      <input class="form-control input-lg" type="text" name="ciudad" placeholder="Ciudad" >
                    </div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                	  <textarea class="form-control input-lg" type="text" name="direccion" placeholder="Direccion" ></textarea>
                	</div>

                	<div class="input-group margin-bottom-sm form-group">
                	  <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
                	  <select class="form-control input-lg" name="remitido">
                	  	<option value="" selected>¿Como nos Encontro?</option>
                	  	<option>Boca a boca</option>
                	  	<option>Internet</option>
                	  	<option>Radio</option>
                	  	<option>Televisiòn</option>
                	  	<option>Prensa</option>
                        <option>Referencia Medica</option>
                	  	<option>Otro</option>
                	  </select>
                	</div>		
                </div> <!--FIN COLUMNA DERECHAA -->

			</div>	
		</div>

		<div class="panel-footer">
			<div class="">
					<button class="btn btn-default btn-lg" >Regresar</button>
					<button class="btn btn-success btn-lg" name="perfil" type="submit">Continuar</button>
			</div>
		</div>
	</div>
</div>


</body>
</html>
<script type="text/javascript">
    $('#default-behavior').ketchup();
</script>