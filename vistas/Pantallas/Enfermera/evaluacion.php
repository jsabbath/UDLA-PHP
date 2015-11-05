<?php 
$id = $_GET['id'];
$paciente_id = $_GET['paciente'];
$sesion_id = $_GET['sesion'];
$header=2;
$activo=2;
require('../../header.php');
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$paciente_id}' LIMIT 1 ");
$paciente = mysql_fetch_assoc($tabla_pacientes);
?>
<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("cumple");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent2() {
        element = document.getElementById("content2");
        check = document.getElementById("mejoria");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent3() {
        element = document.getElementById("content3");
        check = document.getElementById("complicacion");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>
<div class="main">
	<div class="main-inner">
		<div class="container">

			<div class="widget">
				<div class="widget-header">
					<i class="icon-user"></i>
					<h3>Evaluacion del Paciente:</h3>
				</div>

				<div class="widget-content">
					<h3>Evaluacion Previa:</h3>
					<form method="POST" action="../../PHP/enfermera/registrar_evaluacion.php?cita=<?php echo $_GET['cita']; ?>" class="form" role="form">
						<input type="hidden" name="id" value="<?php echo $id;?> ">
						<input type="hidden" name="paciente" value="<?php echo $paciente_id;?> ">
						<input type="hidden" name="sesion_id" value="<?php echo $sesion_id;?> ">
						<div class="rows-fluid">
							<?php if (isset($_GET['msg'])) {
			                    $msg= $_GET['msg']; ?>
			                    <div class="alert alert-danger">
			                        <button type="button" class="close" data-dismiss="alert">&times;</button>
			                        <strong><?php echo $msg; ?> </strong>
			                    </div>
			                <?php } ?>
							<div class="">
								<strong>¿Cumple usted con el tratamiento indicado en casa ?</strong><br>
								<label class="radio inline">
									<input type="radio" name="cumple" onchange="javascript:showContent()" value="si"> Si
								</label>
								<label class="radio inline">
									<input type="radio" name="cumple" id="cumple" onchange="javascript:showContent()" value="No"> No
								</label>
								<div id="content" style="display:none;" class="control-group">
									<label> ¿Por qué?</label>
									<textarea class="" type="text" name="cumple_xq"> </textarea>
								</div>
							</div> <hr>

							<div class="">
								<strong>¿Ha visto alguna mejoria con el tratamiento ?</strong><br>
								<label class="radio inline">
									<input type="radio" name="mejoria" onchange="javascript:showContent2()" value="si"> Si
								</label>
								<label class="radio inline">
									<input type="radio" name="mejoria" id="mejoria" onchange="javascript:showContent2()" value="No"> No
								</label>
								<div id="content2" style="display:none;" class="control-group">
									<label> ¿Por qué?</label>
									<textarea class="" type="text" name="mejoria_xq"> </textarea>
								</div>
							</div> <hr>

							<div class="">
								<strong>¿Tuvo alguna complicación con el tratamiento de cabina anterior ?</strong><br>
								<label class="radio inline">
									<input type="radio" name="complicacion" id="complicacion" onchange="javascript:showContent3()" value="si"> Si
								</label>
								<label class="radio inline">
									<input type="radio" name="complicacion" onchange="javascript:showContent3()" value="No"> No
								</label>
								<div id="content3" style="display:none;" class="control-group">
									<label> ¿Por qué?</label>
									<textarea class="" type="text" name="complicacion_xq"> </textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Continuar</button> 
								<button class="btn">Cancelar</button>
							</div>
						</div>

					</form>
				</div>
			</div>	
		</div>
	</div>
</div>